<<<<<<< HEAD
=======
<?php

namespace Tests\Feature;

use App\Models\ProcessFlow;
use App\Models\ProcessFlowStep;
use App\Observers\ProcessFlowObserver;
use App\Service\ProcessflowStepService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessFlowObserverTest extends TestCase
{

    use RefreshDatabase;

    // Use the real ProcessflowStepService

    // Test using real data and database assertions
    public function test_updated_method_updates_steps_in_database()
    {
        $observer = new ProcessFlowObserver(new ProcessflowStepService());
        $processFlowModel = ProcessFlow::factory()->create();
        $step = ProcessFlowStep::factory()->create([
            'process_flow_id' => $processFlowModel->id,
            'name' => 'test name single test',
            'step_route' => 'this should be a route',
            'assignee_user_route' => 1,
            'next_user_designation' => 1,
            'next_user_department' => 1,
            'next_user_unit' => 1,
            'next_user_location' => 1,
            'step_type' => 'create',
            'user_type' => 'customer',
            'status' => 1,
        ]);

        $updatedStep = [
            'id' => $step->id,
            'name' => 'test name single test updated',
            'step_route' => 'this should be a route',
            'assignee_user_route' => 1,
            'next_user_designation' => 1,
            'next_user_department' => 1,
            'next_user_unit' => 1,
            'next_user_location' => 1,
            'step_type' => 'create',
            'user_type' => 'customer',
            'status' => 1,
        ];

        $processFlowModel->steps = collect([$updatedStep]);

        $observer->updated($processFlowModel);

        $this->assertDatabaseHas('process_flow_steps', [
            'id' => $step->id,
            'name' => 'test name single test updated',
        ]);

    }

}
>>>>>>> 5072849 (observer test)
