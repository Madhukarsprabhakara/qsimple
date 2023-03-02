<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
class QueryController extends Controller
{
    



    public function executeQuery(String $schedule='manual')
    {
        try {
            $queries=Query::where('schedule', $schedule)->with('database')->get();
            //run a for loop for all the queries
            foreach ($queries as $query)
            {
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
                return  $status;

                //$query->database->makeVisible('password')->password;
            }
            

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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
