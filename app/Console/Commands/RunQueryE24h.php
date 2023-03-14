<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\E24h;
use App\Jobs\E24hRunOnly;
use App\Http\Controllers\QueryController;
use App\Models\Query;
class RunQueryE24h extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:RunQueryE24h';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs sql jobs every 24 hours';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $queries=array();
        $queries_run=array();
        $queries=Query::where('schedule', 'every_24_hours')->whereNotNull('table_name')->whereNotNull('schema_name')->with('database')->get();
        if (count($queries)>0) {
            foreach ($queries as $query)
            {
                E24h::dispatch($query);
            }
        }
        
        $queries_run=Query::where('schedule', 'every_24_hours')->whereNull('table_name')->whereNull('schema_name')->with('database')->get();
        if (count($queries_run)>0)
        {
            foreach ($queries_run as $query_run)
            {
                E24hRunOnly::dispatch($query_run);
            }
        }
        
    }
}
