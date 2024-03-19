<?php

namespace App\Jobs\Designation;

use Illuminate\Bus\Queueable;
use App\Service\DesignationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DesignationUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {

            $service = new DesignationService();
            $service->updateDesignation($this->data, $this->data['id']);
        } catch (\Exception $e) {
            // Log any errors that occur during the processing of the job
            Log::error('Error occurred while processing DesignationUpdated job: ' . $e->getMessage());
        }
    }
}
