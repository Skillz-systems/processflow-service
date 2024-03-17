<?php

namespace App\Jobs\Designation;

use App\Models\Designation;
use Illuminate\Bus\Queueable;
use App\Service\DesignationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class DesignationCreated implements ShouldQueue
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
            $service->createDesignation($this->data);
        } catch (\Exception $e) {
            Log::error('Error occurred while processing DesignationCreated job: ' . $e->getMessage());
        }

    }



}
