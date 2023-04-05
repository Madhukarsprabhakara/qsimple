<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\E12h;
use App\Jobs\E12hRunOnly;
use App\Http\Controllers\QueryController;
use App\Models\Query;
class RunQueryE12h extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:RunQueryE12h';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs sql jobs every 12 hours at 1 and 13 UTC';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $queries=array();
        $queries_run=array();
        $queries=Query::where('schedule', 'every_12_hours')->whereNotNull('table_name')->whereNotNull('schema_name')->where('is_active', true)->with('database')->get();
        if (count($queries)>0) {
            foreach ($queries as $query)
            {
                E12h::dispatch($query);
            }
        }
        
        $queries_run=Query::where('schedule', 'every_12_hours')->whereNull('table_name')->whereNull('schema_name')->where('is_active', true)->with('database')->get();
        if (count($queries_run)>0)
        {
            foreach ($queries_run as $query_run)
            {
                E12hRunOnly::dispatch($query_run);
            }
        }
    }
}
