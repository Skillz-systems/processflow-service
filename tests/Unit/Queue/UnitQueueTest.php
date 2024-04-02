<?php

namespace Tests\Unit\Queue;

use App\Jobs\Unit\UnitCreated;
use App\Jobs\Unit\UnitDeleted;
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


     public function test_for_job_to_successfully_delete_unit(): void
    {


        Queue::fake();

        $request = [
            'name' => 'Admin',
            'id' => 199,
            'created_at' => '',
            'updated_at' => ''
        ];

        UnitCreated::dispatch($request);
        (new UnitCreated($request))->handle();
        $this->assertDatabaseCount('units', 1);
        $this->assertDatabaseHas('units', [
            'name' => $request['name']
        ]);


        UnitDeleted::dispatch($request['id']);
        (new UnitDeleted($request['id']))->handle();

        $this->assertDatabaseMissing('units', ['id' => $request['id']]);
    }
}
