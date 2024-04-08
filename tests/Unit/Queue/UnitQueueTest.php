<?php

namespace Tests\Unit\Queue;

use App\Jobs\Unit\UnitCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class UnitQueueTest extends TestCase
{
     use RefreshDatabase;
      public function test_for_unit_job_handles_data_correctly()
    {
        Queue::fake();

        $request = [
            'name' => 'Technology',
            'id' => 56,
            'created_at' => '',
            'updated_at' => ''
        ];
        UnitCreated::dispatch($request);
        (new UnitCreated($request))->handle();
        $this->assertDatabaseCount('units', 1);
        $this->assertDatabaseHas('units', [
            'name' => $request['name']
        ]);
    }
}