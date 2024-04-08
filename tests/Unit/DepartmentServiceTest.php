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
}