<?php

namespace Tests\Unit\Queue;

use App\Jobs\Unit\UnitCreated;
use App\Jobs\Unit\UnitDeleted;
use App\Models\Unit;
use App\Service\UnitService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class UnitQueueTest extends TestCase
{
    use RefreshDatabase;

    private UnitService $unitService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->unitService = $this->app->make(UnitService::class);
    }

//NOTE: TEST QUEUE BEHAVIOUR
    public function test_it_handles_unit_creation_job_correctly(): void
    {
        Queue::fake();

        $request = [
            'name' => 'Technology',
            'id' => 56,
            'created_at' => '',
            'updated_at' => '',
        ];

        $job = new UnitCreated($request);
        $job->handle($this->unitService);

        $this->assertDatabaseCount('units', 1);
        $this->assertDatabaseHas('units', [
            'name' => $request['name'],
        ]);
    }


    public function test_it_handles_unit_deletion_job_correctly(): void
    {
        Queue::fake();

        $request = [
            'name' => 'Admin',
            'id' => 199,
            'created_at' => '',
            'updated_at' => '',
        ];

        $creationJob = new UnitCreated($request);
        $creationJob->handle($this->unitService);

        $this->assertDatabaseCount('units', 1);
        $this->assertDatabaseHas('units', [
            'name' => $request['name'],
        ]);

        $unit = Unit::firstOrFail();
        $deletionJob = new UnitDeleted($unit->id);
        $deletionJob->handle($this->unitService);

        $this->assertDatabaseMissing('units', ['id' => $unit->id]);
    }


    //NOTE: TEST QUEUE FUNCTIONALITY
    public function test_it_dispatches_unit_creation_job_functionality(): void
    {
        Queue::fake();

        $request = [
            'name' => 'Technology',
            'id' => 56,
            'created_at' => '',
            'updated_at' => '',
        ];

        UnitCreated::dispatch($request);

        Queue::assertPushed(UnitCreated::class, function ($job) use ($request) {
            return $job->getData() == $request;
        });
    }

    public function test_it_dispatches_unit_deletion_job_functionality(): void
    {

        Queue::fake();

        $unit = Unit::factory()->create();

        UnitDeleted::dispatch($unit->id);

        Queue::assertPushed(UnitDeleted::class, function ($job) use ($unit) {
            return $job->getId() == $unit->id;
        });
    }
}
