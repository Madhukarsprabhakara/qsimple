<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\E1h;
use App\Jobs\E1hRunOnly;
use App\Http\Controllers\QueryController;
use App\Models\Query;
class RunQueryE1h extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        $queries=array();
        $queries_run=array();
        $queries=Query::where('schedule', 'every_1_hour')->whereNotNull('table_name')->whereNotNull('schema_name')->where('is_active', true)->with('database')->get();
        if (count($queries)>0) {
            foreach ($queries as $query)
            {
                E1h::dispatch($query);
            }
        }
        
        $queries_run=Query::where('schedule', 'every_1_hour')->whereNull('table_name')->whereNull('schema_name')->where('is_active', true)->with('database')->get();
        if (count($queries_run)>0)
        {
            foreach ($queries_run as $query_run)
            {
                E1hRunOnly::dispatch($query_run);
            }
        }
    }
}
