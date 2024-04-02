<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Unit;
use App\Service\UnitService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_for_Unit_service_to_create_unit_correctly(): void
    {
        $request = ['name' => 'Finance and Accounts', 'id' => 888, 'created_at' => '', 'updated_at' => ''];
        $service = new UnitService();
        $result = $service->createUnit($request);
        $this->assertInstanceOf(Unit::class, $result);
    }

    public function test_for_unit_service_return_validation_exception_during_unit_creation(): void
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $request = ['id' => 475];
        $service = new UnitService();
        $service->createUnit($request);
    }
}