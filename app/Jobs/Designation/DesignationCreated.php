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
    // protected $designationService = DesignationService::class;
    // private $service;
    public function __construct(array $data)
    {
        $this->data = $data;
        // $this->service = new DesignationService();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // $designationService = new DesignationService();
            // $designationService->createDesignation($this->data);
            // $this->service->createDesignation($this->data);

            Designation::create([
                'id' => $this->data['id'],
                'name' => $this->data['name'],
                'created_at' => $this->data['created_at'],
                'updated_at' => $this->data['updated_at'],
            ]);
        } catch (\Exception $e) {
            Log::error('Error occurred while processing DesignationCreated job: ' . $e->getMessage());
        }

    }



}
