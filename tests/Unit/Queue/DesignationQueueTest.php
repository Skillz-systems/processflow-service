<?php

namespace Tests\Unit\Queue;

use Tests\TestCase;
use App\Models\Designation;
use Illuminate\Support\Str;
use App\Service\DesignationService;
use Illuminate\Support\Facades\Queue;
use App\Jobs\Designation\DesignationCreated;
use App\Jobs\Designation\DesignationDeleted;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Jobs\Designation\DesignationUpdated;

class DesignationQueueTest extends TestCase
{
     use RefreshDatabase;
     public function test_job_handles_data_correctly()
    {
        Queue::fake();

        $request = [
            'name' => 'supplier',
            'id' => 4567,
            'created_at' => '',
            'updated_at' => ''
        ];

        DesignationCreated::dispatch($request);
        (new DesignationCreated($request))->handle();
        $this->assertDatabaseCount('designations', 1);
        $this->assertDatabaseHas('designations', [
            'name' => $request['name']
        ]);
    }

     public function test_for_job_to_successfully_delete_designation(): void
    {


        Queue::fake();

        $request = [
            'name' => 'supplier',
            'id' => 999,
            'created_at' => '',
            'updated_at' => ''
        ];

        DesignationCreated::dispatch($request);
        (new DesignationCreated($request))->handle();
        $this->assertDatabaseCount('designations', 1);
        $this->assertDatabaseHas('designations', [
            'name' => $request['name']
        ]);


        DesignationDeleted::dispatch($request['id']);
        (new DesignationDeleted($request['id']))->handle();

        $this->assertDatabaseMissing('designations', ['id' => $request['id']]);
    }

     public function test_job_to_update_designation_is_successful(): void
    {

        Queue::fake();

        $request = [
            'name' => 'staff',
            'id' => 329,
            'created_at' => '',
            'updated_at' => ''
        ];

        DesignationCreated::dispatch($request);
        (new DesignationCreated($request))->handle();
        $this->assertDatabaseCount('designations', 1);
        $this->assertDatabaseHas('designations', [
            'name' => $request['name']
        ]);

        $updatedRequest = ['name' => 'Updated staff', 'id' => $request['id'], 'created_at' => '', 'updated_at' => ''];

        DesignationUpdated::dispatch($updatedRequest);
        (new DesignationUpdated($updatedRequest))->handle();

        $this->assertDatabaseHas('designations', ['name' => $updatedRequest['name']]);

    }
}
