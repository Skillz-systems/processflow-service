<?php

namespace App\Jobs\Unit;

use App\Service\UnitService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UnitDeleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(): void
    {
        try {
            $service = new UnitService();
            $service->deleteUnit($this->id);
        } catch (\Exception $e) {
            Log::error('Error occurred while processing UnitDeleted job: ' . $e->getMessage());
        }
    }
}
