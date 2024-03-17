<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DesignationControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_route_to_get_all_designations(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
