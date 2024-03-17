<?php
namespace Tests\Unit;

use App\Jobs\Designation\DesignationCreated;
use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Service\DesignationService;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;



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
    public function test_for_service_to_delete_designation_successfully(): void
    {

    }
    public function test_for_service_fail_to_delete_designation_id_is_not_provided(): void
    {

    }
    public function test_for_job_to_successfully_delete_designation(): void
    {

    }
}
