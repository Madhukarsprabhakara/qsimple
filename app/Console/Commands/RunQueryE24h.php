<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\E24h;
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
        //
        //dispatch background job every 24 hours from here
        E24h::dispatch('every_24_hours');
    }
}
