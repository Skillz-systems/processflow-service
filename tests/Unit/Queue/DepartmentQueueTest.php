<?php

namespace Tests\Unit\Queue;

use Tests\TestCase;
use App\Service\DepartmentService;
use Illuminate\Support\Facades\Queue;
use App\Jobs\Department\DepartmentCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentQueueTest extends TestCase
{
   use RefreshDatabase;

    private DepartmentService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(DepartmentService::class);
    }

    public function test_it_handles_department_creation_job_correctly(): void
    {
        Queue::fake();

        $request = [
            'name' => 'Staff',
            'id' => 34,
            'created_at' => '',
            'updated_at' => '',
        ];

        $job = new DepartmentCreated($request);
        $job->handle($this->service);

        $this->assertDatabaseCount('departments', 1);
        $this->assertDatabaseHas('departments', [
            'name' => $request['name'],
        ]);
    }
     public function test_it_dispatches_department_creation_job_functionality(): void
    {
        Queue::fake();

        $request = [
            'name' => 'Mercury',
            'id' => 5634,
            'created_at' => '',
            'updated_at' => '',
        ];

        DepartmentCreated::dispatch($request);

        Queue::assertPushed(DepartmentCreated::class, function ($job) use ($request) {
            return $job->getData() == $request;
        });
    }

}
