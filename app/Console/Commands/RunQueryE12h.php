<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\E12h;
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
        //
        E12h::dispatch('every_12_hours');
    }
}
