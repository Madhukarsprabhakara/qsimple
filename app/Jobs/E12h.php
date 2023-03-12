<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\QueryController;
class E12h implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $schedule;
    public function __construct($schedule)
    {
        //
         $this->schedule=$schedule;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $queryExecute=new QueryController;
        $queryExecute->executeQuery($this->schedule);
        $queryExecute->executeTableQuery($this->schedule);
    }
}
