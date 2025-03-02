<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\QueryController;
use App\Models\Query;
class E24h implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $query;
    public function __construct($query)
    {
        //
        $this->query=$query;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        $queryExecute=new QueryController;
        $queryExecute->executeTableQuery($this->query);

    }
}
