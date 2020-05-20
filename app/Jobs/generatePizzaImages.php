<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class generatePizzaImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $materialIds;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($materialIds)
    {
        $this->materialIds = $materialIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        shell_exec('cd ../js/pizzagenerator && node pizzagenerator.js ' .escapeshellarg($this->materialIds) . '');
    }
}
