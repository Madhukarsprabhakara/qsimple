<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Models\Database;
use App\Models\QuerySuccess;
use App\Models\QueryStatus;
use App\Models\QueryError;
use App\Jobs\E24hRunOnly;
use Illuminate\Http\Request;
use App\Jobs\E24h;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;
use App\Http\Controllers\DbOperationsController;
class QueryController extends Controller
{
    



    public function executeQuery(Query $query)
    {
        try {
            $password=Crypt::decryptString($query->database->makeVisible('password')->password);
            \Config::set(['database.connections.'.$query->database->name => [
                    'driver'    => 'pgsql',
                    'host'      => $query->database->host,
                    'port'      => $query->database->port,
                    'database'  => $query->database->name,
                    'username'  => $query->database->username,
                    'password'  => $password,
            ]]);
            $status=\DB::connection($query->database->name)->select($query->query);
            //log the success status here
            //Query ID, original count, new count, status
            $this->LogQueryStatus($query->id, null, null, null, 1, 'Query executed successfully');
        }
        catch (\Exception $e)
        {
            $this->LogQueryStatus($query->id, null,null, $e->getMessage(),0,'Query execution unsuccessful');
            //return $e->getMessage();
        }
    }
    
    public function executeTableQuery(Query $query)
    {
        try {
            $password=Crypt::decryptString($query->database->makeVisible('password')->password);
            \Config::set(['database.connections.'.$query->database->name => [
                    'driver'    => 'pgsql',
                    'host'      => $query->database->host,
                    'port'      => $query->database->port,
                    'database'  => $query->database->name,
                    'username'  => $query->database->username,
                    'password'  => $password,
                    'search_path' => $query->schema_name,
            ]]);
            $db_opr=new DbOperationsController;
            $schema_exists=$db_opr->checkSchemaExistence($query->database->name, $query->schema_name);
            if ($schema_exists[0]->count)
            {
                $table_exists=$db_opr->checkTableInSchemaExistence($query->database->name,  $query->table_name, $query->schema_name);
                if ($table_exists)
                {
                        //return $table_exists;
                        $hash_id=md5($query->id);
                        $hash_id="t_".$hash_id; //tables names should always start with a character
                        $originalTable=$query->table_name;
                        $OriginalTableRecordCount=\DB::connection($query->database->name)->table($originalTable)->count();
                        \DB::connection($query->database->name)->statement("CREATE TABLE $hash_id  AS TABLE $originalTable");
                        //take backup
                        $new_data=\DB::connection($query->database->name)->select($query->query);
                        \DB::connection($query->database->name)->statement("TRUNCATE TABLE $originalTable");
                        $status=\DB::connection($query->database->name)->statement("insert into $originalTable $query->query");
                        if ($status)
                        {
                           $NewTableRecordCount=\DB::connection($query->database->name)->table($originalTable)->count();
                           \DB::connection($query->database->name)->statement("DROP TABLE $hash_id"); 
                           //log the success status here
                           //$this->LogSuccess($query->id, $OriginalTableRecordCount, $NewTableRecordCount, 'Sync Successful');
                           $this->LogQueryStatus($query->id, $OriginalTableRecordCount, $NewTableRecordCount, null, 1, 'Sync Successful');
                        }
                        return $status;
                }
                $originalTable=$query->table_name;
                $status=\DB::connection($query->database->name)->statement("select * into $originalTable from ($query->query) as mt");
                if ($status)
                {
                    $NewTableRecordCount=\DB::connection($query->database->name)->table($originalTable)->count();
                    $this->LogQueryStatus($query->id, null, $NewTableRecordCount, null, 1, 'Sync Successful');
                }
                return $status;

            }
            //log the success status here
            //Query ID, original count, new count, status
            return $schema_exists;
        }
        catch (\Exception $e)
        {
             $this->LogQueryStatus($query->id, null,null,$e->getMessage(),0,'Query execution unsuccessfull');
        }
    }
    
    public function LogQueryStatus($query_id,$OriginalTableRecordCount,$NewTableRecordCount,$error, $type, $status)
    {
        try {
            QueryStatus::create([

                'query_id'=>$query_id,
                'old_table_record_count'=>$OriginalTableRecordCount,
                'new_table_record_count'=>$NewTableRecordCount,
                'error'=>$error,
                'type'=> $type,
                'status'=>$status,


            ]);
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
    public function LogError($query_id, $error, $status)
    {
        try {
            QueryError::create([

                'query_id'=>$query_id,
                'error'=>$error,
                'status'=>$status,


            ]);
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        //
        try {
            $user=\Auth::user();
            $team_id=$user->currentTeam->id;
            $queries=Query::where('team_id', $team_id)->with('database')->get(['id','user_id','team_id','database_id','query_title','schedule','table_name','schema_name']);
            $databases=Database::where('team_id',$team_id)->where('is_archived','!=', true)->orWhereNull('is_archived')->get();
            return Inertia::render('Queries/Show', [
                'queries' => $queries,
                'databases' => $databases,
            ]); 
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $user=\Auth::user();
            return Inertia::render('Queries/Create', [
                'databases'=>Database::where('team_id', $user->currentTeam->id)->get(['id','display_name']),
            ]);
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $user=\Auth::user();
            $team_id=$user->currentTeam->id;

            $validator= \Validator::make($request->all(),[
                'query_title' => 'required|string',
                'database_id' => 'required|numeric',
                'query' => 'required|string',
                'table_name' => 'nullable|string',
                'schedule' => 'required|string',
                'schema_name' => 'nullable|string',

            ]);

            if ($validator->fails())
            {
                $request->session()->flash('flash.banner', $validator->errors());
                $request->session()->flash('flash.bannerStyle', 'danger');
                return \Redirect::back();
            }
            $data=$request->all();
            $data['user_id']=$user->id;
            $data['team_id']=$team_id;
            $query=Query::create($data);
            //Immediate execution of the query
            if ($query)
            {
                if ($data['table_name'])
                {
                    E24h::dispatch($query);
                    
                }
                else
                {
                    E24hRunOnly::dispatch($query);
                }
                return \Redirect::route('queries.all');
            }
            $request->session()->flash('flash.banner', 'Something went wrong. Please email support@sopact.com');
            $request->session()->flash('flash.bannerStyle', 'danger');
            return \Redirect::back();
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Query $query)
    {
        //
        $query['status']=$query->status;
        $query['database']=$query->database;
        return Inertia::render('Queries/QueryShow', [
                'query' => $query,
                             
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Query $query, Request $request)
    {
        //
        try {
            $user=\Auth::user();
            return Inertia::render('Queries/Edit', [
                'query' => $query,
                'databases'=>Database::where('team_id', $user->currentTeam->id)->get(['id','display_name']),
                'select_stmt'=> $query['table_name']
                ? true
                : false,
            ]);
        }
        catch (\Exception $e)
        {
            $request->session()->flash('flash.banner', $e->getMessage());
            $request->session()->flash('flash.bannerStyle', 'danger');
            return \Redirect::back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Query $query)
    {
        //
        try {
            $user=\Auth::user();
            $team_id=$user->currentTeam->id;

            $validator= \Validator::make($request->all(),[
                'query_title' => 'required|string',
                'database_id' => 'required|numeric',
                'query' => 'required|string',
                'table_name' => 'nullable|string',
                'schema_name' => 'nullable|string',
                'schedule' => 'required|string',

            ]);

            if ($validator->fails())
            {
                $request->session()->flash('flash.banner', $validator->errors());
                $request->session()->flash('flash.bannerStyle', 'danger');
                return \Redirect::back();
            }
            $data=$request->all();
            $query->query_title=$data['query_title'];
            $query->database_id=$data['database_id'];
            $query->query=$data['query'];
            $query->table_name=$data['table_name'];
            $query->schema_name=$data['schema_name'];
            $query->schedule=$data['schedule'];

            $status=$query->save();
            if ($status)
            {
                $request->session()->flash('flash.banner', 'Query Updated');
                $request->session()->flash('flash.bannerStyle', 'success');
                return \Redirect::back();
            }
            
        }
        catch (\Exception $e)
        {
            $request->session()->flash('flash.banner', $e->getMessage());
            $request->session()->flash('flash.bannerStyle', 'danger');
            return \Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Query $query)
    {
        //
    }
}
