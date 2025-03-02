<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
class DbOperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function checkTableInSchemaExistence($database_connection, $table, $schema_name)
    {
        try {
            if (Schema::connection($database_connection)->hasTable($table)) {
                return 1;
            } else {
                return 0;
            }
            
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
    public function checkSchemaExistence($database_connection, $schema_name)
    {
        try {
            return \DB::connection($database_connection)->select("select count(*) from information_schema.schemata where schema_name='$schema_name'");
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
