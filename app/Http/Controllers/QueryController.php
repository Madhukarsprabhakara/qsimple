<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Models\Database;
use Illuminate\Http\Request;
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
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
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
                        $originalTable=$query->table_name;
                        \DB::connection($query->database->name)->statement("CREATE TABLE $hash_id  AS TABLE $originalTable");
                        //take backup
                        $new_data=\DB::connection($query->database->name)->select($query->query);
                        \DB::connection($query->database->name)->statement("TRUNCATE TABLE $originalTable");
                        $status=\DB::connection($query->database->name)->statement("insert into $originalTable $query->query");
                        if ($status)
                        {
                           \DB::connection($query->database->name)->statement("DROP TABLE $hash_id"); 
                        }
                        return $status;
                }
                $originalTable=$query->table_name;
                $status=\DB::connection($query->database->name)->statement("select * into $originalTable from ($query->query) as mt");
                return $status;

            }
            return $schema_exists;
        }
        catch (\Exception $e)
        {
             return $e->getMessage();
        }
    }
    
    public function databaseConfig()
    {
        try {

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
            $queries=Query::where('team_id', $team_id)->with('database')->get();
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Query $query)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Query $query)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Query $query)
    {
        //
    }
}
