<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Designation;
use Illuminate\Support\Str;
use App\Service\DesignationService;
use Illuminate\Support\Facades\Queue;
use App\Jobs\Designation\DesignationCreated;
use App\Jobs\Designation\DesignationDeleted;
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

    public function test_designation_created_validation_exception(): void
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
    public function test_service_to_delete_designation_successfully(): void
    {
        $designation = Designation::factory()->create();
        $service = new DesignationService();

        $this->assertInstanceOf(Designation::class, $designation);
        $result = $service->deleteDesignation($designation->id);

        $this->assertDatabaseMissing('designations', ['id' => $designation->id]);
        $this->assertTrue($result);

    }
    public function test_service_to_delete_designation_not_found(): void
    {
        $service = new DesignationService();
        $result = $service->deleteDesignation(9999);
        $this->assertFalse($result);
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

        // // Create a designation
        // $designation = Designation::factory()->create();

        // // Dispatch the DesignationDeleted job
        // $job = new DesignationDeleted($designation->id);
        // $job->handle();


        // $designation = Designation::factory()->create();

        // $this->assertDatabaseMissing('designations', ['id' => $designation->id]);
    }
}
