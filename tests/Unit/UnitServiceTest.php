<?php

namespace Tests\Unit;

use App\Models\Unit;
use App\Service\UnitService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class UnitServiceTest extends TestCase
{
    use RefreshDatabase;

    private UnitService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new UnitService();
    }


    public function test_it_can_create_a_unit(): void
    {
        $request = [
            'name' => 'Finance and Accounts',
            'id' => 888,
            'created_at' => '',
            'updated_at' => '',
            'department_id'=>46
        ];

        $result = $this->service->createUnit($request);

        $this->assertInstanceOf(Unit::class, $result);
    }

    public function test_it_throws_validation_exception_when_creating_unit_with_invalid_data(): void
    {
        $this->expectException(ValidationException::class);

        $request = ['id' => 475];

        $this->service->createUnit($request);
    }

    public function test_it_can_delete_a_unit(): void
    {
        $unit = Unit::factory()->create();

        $result = $this->service->deleteUnit($unit->id);

        $this->assertDatabaseMissing('units', ['id' => $unit->id]);
        $this->assertTrue($result);
    }


    public function test_it_returns_false_when_deleting_a_non_existent_unit(): void
    {
        $result = $this->service->deleteUnit(8349);

        $this->assertFalse($result);
    }


     public function test_it_can_update_a_unit(): void
    {


        $request = [
            'name' => 'Finance and Accounts',
            'id' => 888,
            'created_at' => '',
            'updated_at' => '',
            'department_id'=>46
        ];

        $created = $this->service->createUnit($request);

        $this->assertInstanceOf(Unit::class, $created);

        $update_request = [
            'name' => 'New Name Updated',
            'created_at' => '',
            'updated_at' => '',
            'id'=> $created->id,
            'department_id'=>$request['department_id']
        ];

        $result = $this->service->updateUnit($update_request, $created->id);

        $this->assertTrue($result);
        $this->assertDatabaseHas('units', [
            'id' => $created->id,
            'name' => $update_request['name'],
        ]);
    }

    public function test_it_throws_validation_exception_when_updating_unit_with_invalid_data(): void
    {
        $this->expectException(ValidationException::class);

        $unit = Unit::factory()->create();
        $request = ['name' => ''];
        $this->service->updateUnit($request, $unit->id);
    }

    public function test_it_returns_false_when_updating_a_non_existent_unit(): void
    {
        $request = [
            'name' => 'Finance and Accounts',
            'id' => 888,
            'created_at' => '',
            'updated_at' => '',
            'department_id'=>43
        ];

        $result = $this->service->updateUnit($request, 9999);

        $this->assertFalse($result);
    }


    public function test_it_can_get_a_single_unit(): void
    {
        $unit = Unit::factory()->create();

        $result = $this->service->getSingleUnit($unit->id);

        $this->assertInstanceOf(Unit::class, $result);
        $this->assertEquals($unit->id, $result->id);
        $this->assertEquals($unit->name, $result->name);
    }

    public function test_it_throws_exception_when_getting_a_non_existent_unit(): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->service->getSingleUnit(9999);
    }


     public function test_it_can_get_all_units(): void
    {
        Unit::factory()->count(5)->create();

        $result = $this->service->getAllUnits();

        $this->assertCount(5, $result);
        $this->assertInstanceOf(Unit::class, $result->first());
    }
}