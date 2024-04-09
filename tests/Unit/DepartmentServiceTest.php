<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Department;
use App\Service\DepartmentService;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DepartmentServiceTest extends TestCase
{
   use RefreshDatabase;

    private DepartmentService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new DepartmentService();
    }

    public function test_it_can_create_a_departement(): void
    {
        $request = [
            'name' => 'Maintenance',
            'id' => 888,
            'created_at' => '',
            'updated_at' => '',
        ];
        $result = $this->service->createDepartment($request);

        $this->assertInstanceOf(Department::class, $result);
    }

    public function test_it_throws_validation_exception_when_creating_department_with_invalid_data(): void
    {
        $this->expectException(ValidationException::class);

        $request = ['id' => 475];

        $this->service->createDepartment($request);
    }

         public function test_it_can_update_a_department(): void
    {


        $request = [
            'name' => 'Finance',
            'id' => 18,
            'created_at' => '',
            'updated_at' => '',
        ];

        $created = $this->service->createDepartment($request);

        $this->assertInstanceOf(Department::class, $created);

        $update_request = [
            'name' => 'New Department Name Updated',
            'created_at' => '',
            'updated_at' => '',
            'id'=> $created->id
        ];

        $result = $this->service->updateDepartment($update_request, $created->id);

        $this->assertTrue($result);
        $this->assertDatabaseHas('departments', [
            'id' => $created->id,
            'name' => $update_request['name'],
        ]);
    }

    public function test_it_throws_validation_exception_when_updating_department_with_invalid_data(): void
    {
        $this->expectException(ValidationException::class);

        $unit = Department::factory()->create();
        $request = ['name' => ''];
        $this->service->updateDepartment($request, $unit->id);
    }

    public function test_it_returns_false_when_updating_a_non_existent_department(): void
    {
        $request = [
            'name' => 'Pharmacy',
            'id' => 91,
            'created_at' => '',
            'updated_at' => '',
        ];

        $result = $this->service->updateDepartment($request, 9999);
        $this->assertFalse($result);
    }



    public function test_it_can_delete_a_test_it_can_delete_a_department(): void
    {
        $department = Department::factory()->create();
        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'name' => $department->name,
        ]);
        $result = $this->service->deleteDepartment($department->id);


        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
        $this->assertTrue($result);
    }


    public function test_it_returns_false_when_deleting_a_non_existent_test_it_can_delete_a_department(): void
    {
        $result = $this->service->deleteDepartment(674);

        $this->assertFalse($result);
    }



     public function test_it_can_get_a_single_department(): void
    {
        $department = Department::factory()->create();

        $result = $this->service->getSingleDepartment($department->id);

        $this->assertInstanceOf(Department::class, $result);
        $this->assertEquals($department->id, $result->id);
        $this->assertEquals($department->name, $result->name);
    }

    public function test_it_throws_exception_when_getting_a_non_existent_department(): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->service->getSingleDepartment(9999);
    }
 public function test_it_can_get_all_departments(): void
    {
        Department::factory()->count(5)->create();

        $result = $this->service->getAllDepartments();

        $this->assertCount(5, $result);
        $this->assertInstanceOf(Department::class, $result->first());
    }
}