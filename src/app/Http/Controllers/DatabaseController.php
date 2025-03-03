<?php

namespace App\Http\Controllers;

use App\Models\Database;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Crypt;
class DatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $user=\Auth::user();
            $team_id=$user->currentTeam->id;
            $databases=Database::where('team_id',$team_id)->where('is_archived','!=', true)->orWhereNull('is_archived')->get();
            
            // $databases=Project::where('team_id',$team_id)->where(function ($query) {
            //     $query->where('is_archived','!=',true)->orWhereNull('is_archived');
            // })->orderByDesc('created_at')->get();
            //dd(\DB::getQueryLog());
            return Inertia::render('Databases/Show', [
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
        //
        try {
            return Inertia::render('Databases/Create', []);
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
                'name' => 'required|string',
                'username' => 'required|string',
                'password' => 'required|string',
                'host' => 'required|string',
                'port' => 'required|numeric',
                'display_name' => 'required|string',
                //'team_id' => 'required|numeric',
                //'user_id' => 'required|numeric',

            ]);
            if ($validator->fails())
            {
                $request->session()->flash('flash.banner', $validator->errors());
                $request->session()->flash('flash.bannerStyle', 'danger');
                return Redirect::back();
            }
            $data=$request->all();
            $data['user_id']=$user->id;
            $data['password']=Crypt::encryptString($data['password']);
            $data['team_id']=$team_id;
            $status=$this->connectCheck($data);
            if ($status)
            {
                $database=Database::create($data);
                $request->session()->flash('flash.banner', 'Connected to the database successfully!');
                $request->session()->flash('flash.bannerStyle', 'success');
                return \Redirect::route('databases.all');
            }
            $request->session()->flash('flash.banner', 'Could not connect to the database');
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
    public function connectCheck($data)
    {
        try {
            \Config::set(['database.connections.'.$data['name'] => [
                'driver'    => 'pgsql',
                'host'      => $data['host'],
                'port'      => $data['port'],
                'database'  => $data['name'],
                'username'  => $data['username'],
                'password'  => Crypt::decryptString($data['password']),
            ]]);
            //\DB::connection('testDB')->table('some_tables');
            
            \DB::connection($data['name'])->getPdo();
            return true;
       
        
        }
        catch (\Exception $e)
        {
            return false;
        }
    }
    public function show(Database $database)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Database $database, Request $request)
    {
        //
        try {
            $user=\Auth::user();
            return Inertia::render('Databases/Edit', [
                'database' => $database,
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
    public function update(Request $request, Database $database)
    {
        //
        try {
            $user=\Auth::user();
            $team_id=$user->currentTeam->id;

            $validator= \Validator::make($request->all(),[
                'name' => 'required|string',
                'username' => 'required|string',
                'password' => 'nullable|string',
                'host' => 'required|string',
                'port' => 'required|numeric',
                'display_name' => 'required|string',
                //'team_id' => 'required|numeric',
                //'user_id' => 'required|numeric',

            ]);

            if ($validator->fails())
            {
                $request->session()->flash('flash.banner', $validator->errors());
                $request->session()->flash('flash.bannerStyle', 'danger');
                return Redirect::back();
            }
            $data=$request->all();
            if (is_null($data['password']))
            {
                unset($data['password']);
                
            }
            else
            {
                $database->password=Crypt::encryptString($data['password']);
            }
            $database->name=$data['name'];
            $database->username=$data['username'];
            //$database->password=$data['query'];
            $database->host=$data['host'];
            $database->port=$data['port'];
            $database->display_name=$data['display_name'];

            $save_status=$database->save();
            $data['password']=$database->password;
            $status=$this->connectCheck($data);
            if ($status)
            {
                $request->session()->flash('flash.banner', 'Database Updated and connetion test has passed');
                $request->session()->flash('flash.bannerStyle', 'success');
                return \Redirect::back();
            }
            else
            {
                $request->session()->flash('flash.banner', 'Database Updated but the connection test did not pass. Can you please check the credentials and if the following IP "54.215.217.48" is allowed in your firewall.');
                $request->session()->flash('flash.bannerStyle', 'danger');
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
    public function destroy(Database $database)
    {
        //
    }
}
