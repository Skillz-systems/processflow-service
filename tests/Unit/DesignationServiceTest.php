<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Designation;
use Illuminate\Support\Str;
use App\Service\DesignationService;
use Illuminate\Support\Facades\Queue;
use App\Jobs\Designation\DesignationCreated;
use App\Jobs\Designation\DesignationDeleted;
use App\Jobs\Designation\DesignationUpdated;
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
    }

    public function test_service_to_update_a_designation_successfully(): void
    {
        $request = ['name' => 'Client', 'id' => 75, 'created_at' => '', 'updated_at' => ''];
        $service = new DesignationService();
        $result = $service->createDesignation($request);

        $this->assertInstanceOf(Designation::class, $result);
        $updatedRequest = ['name' => 'Updated Client', 'id' => $result['id'], 'created_at' => '', 'updated_at' => ''];

        $service->updateDesignation($updatedRequest, $result['id']);

        $this->assertDatabaseHas('designations', [
            'name' => $updatedRequest['name']
        ]);
    }
    public function test_service_to_update_a_designation_return_fails_with_invalid_data(): void
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $request = ['created_at' => '', 'updated_at' => ''];
        $service = new DesignationService();
        $result = $service->updateDesignation($request, 9119);
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

    public function test_service_for_getting_all_designations(): void
    {
        $designations = Designation::factory(20)->create();
        $service = new DesignationService();
        $allDesignations = $service->getAllDesignations();

        $this->assertCount(20, $allDesignations);

        foreach ($allDesignations as $designation) {
            $this->assertDatabaseHas('designations', [
                'id' => $designation->id,
                'name' => $designation->name,
                'created_at' => $designation->created_at,
                'updated_at' => $designation->updated_at
            ]);
        }

    }
}
