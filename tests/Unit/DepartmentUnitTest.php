<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Department;
use App\Service\DepartmentService;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DepartmentUnitTest extends TestCase
{

use RefreshDatabase;
    /**
     * Test creating a new unit associated with a department.
     *
     * @return void
     */
    public function test_it_create_unit_with_department():void
    {
        $department = Department::factory()->create();
        $unit = \App\Models\Unit::factory()->create(['department_id' => $department->id]);

        $this->assertDatabaseHas('units', [
            'name' => $unit->name,
        ]);
    }

    /**
     * Test the relationship between departments and units.
     *
     * @return void
     */
    public function test_it_gets_department_unit_relationship():void
    {
        $department = Department::factory()->create();
        $unit = \App\Models\Unit::factory()->create(['department_id' => $department->id]);

        $this->assertTrue($department->units->contains($unit));
        $this->assertEquals($unit->department->id, $department->id);
    }


}