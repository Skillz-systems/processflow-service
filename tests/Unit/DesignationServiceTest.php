<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Designation;
use Illuminate\Support\Str;
use App\Service\DesignationService;
use Illuminate\Support\Facades\Queue;
use App\Jobs\Designation\DesignationCreated;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;



class DesignationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_to_designation_service_processes_data_correctly(): void
    {
        $request = ['name' => 'Manager', 'id' => 12345, 'created_at' => '', 'updated_at' => ''];
        $service = new DesignationService();
        $result = $service->createDesignation($request);
        $this->assertInstanceOf(Designation::class, $result);
    }

    public function test_to_designation_service_to_fail_processes_invalid_data(): void
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $request = ['id' => 2345]; // Missing 'title' key
        $service = new DesignationService();
        $service->createDesignation($request);
    }

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

    //added now
    // ValidationException is thrown when required data is missing
    public function test_designation_created_validation_exception()
    {
        Queue::fake();
        // Arrange
        $data = [
            'id' => 455,
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];

        // Assert
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Act
        $job = new DesignationCreated($data);
        $job->handle();
    }
    // Designation is created successfully with valid data
    public function test_designation_created_successfully()
    {
        Queue::fake();
        // Arrange
        $data = [
            'id' => 40,
            'name' => 'Test Designation A',
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];

        // Act
        $job = new DesignationCreated($data);
        $job->handle();

        // Assert
        $this->assertDatabaseHas('designations', $data);
    }

    // Designation is not created when id is missing
    public function test_designation_not_created_when_id_missing()
    {
        Queue::fake();
        // Arrange
        $data = [
            'name' => 'Test Designation B',
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];

        // Act
        $job = new DesignationCreated($data);
        $job->handle();

        // Assert
        $this->assertDatabaseMissing('designations', $data);
    }

    // ValidationException is thrown when required data is missing
    // public function test_designation_created_validation_exception()
    // {
    //     // Arrange
    //     $data = [
    //         'id' => 1,
    //         'created_at' => '2021-01-01',
    //         'updated_at' => '2021-01-01',
    //     ];

    //     // Assert
    //     $this->expectException(ValidationException::class);

    //     // Act
    //     $job = new DesignationCreated($data);
    //     $job->handle();
    // }

    // Designation is not created when updated_at is not a valid date
    public function test_designation_not_created_invalid_updated_at()
    {
        Queue::fake();
        // Arrange
        $data = [
            'id' => 56,
            'name' => 'Test Designation c',
            'created_at' => '2021-01-01',
            'updated_at' => 'Invalid Date',
        ];

        // Act
        $job = new DesignationCreated($data);
        $job->handle();

        // Assert
        $this->assertDatabaseMissing('designations', $data);
    }
}
