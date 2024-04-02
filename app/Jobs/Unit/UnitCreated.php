<?php

namespace App\Jobs\Unit;

use App\Service\UnitService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UnitCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
         try {
            $service = new UnitService();
            $service->createUnit($this->data);
        } catch (\Exception $e) {
            Log::error('Error occurred while processing UnitCreated job: ' . $e->getMessage());
        }
    }
}