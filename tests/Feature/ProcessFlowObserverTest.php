<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 842bee3 (observer test)
=======
=======
>>>>>>> origin/NGMC-92-Create-a-route-that-would-be-used-to-fetch-all-workflow-history
<?php

namespace Tests\Feature;

use App\Models\ProcessFlow;
<<<<<<< HEAD
<<<<<<< HEAD
=======
use App\Models\ProcessFlowStep;
>>>>>>> 842bee3 (observer test)
=======
>>>>>>> origin/NGMC-92-Create-a-route-that-would-be-used-to-fetch-all-workflow-history
use App\Observers\ProcessFlowObserver;
use App\Service\ProcessflowStepService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessFlowObserverTest extends TestCase
{

    use RefreshDatabase;

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> origin/NGMC-92-Create-a-route-that-would-be-used-to-fetch-all-workflow-history
    //
    public function test_to_see_observer_is_called(): void
    {

        $processFlowData = [
            'name' => 'Test Process Flow',
            'frequency' => 'weekly',
            'status' => true,
            'frequency_for' => 'users',
            'day' => null,
            'week' => 'monday',
            'steps' => [
                [

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
                ],
                [

                    'name' => 'test name single two test',
                    'step_route' => 'this should be a route',
                    'assignee_user_route' => 1,
                    'next_user_designation' => 1,
                    'next_user_department' => 1,
                    'next_user_unit' => 1,
                    'next_user_location' => 1,
                    'step_type' => 'create',
                    'user_type' => 'customer',
                    'status' => 1,
                ],
            ],
        ];
        $stepService = new ProcessflowStepService();
        $processFlow = new ProcessFlow($processFlowData);
        $observer = new ProcessFlowObserver($stepService);
        $observer->updated($processFlow);
        $this->assertNull($observer->updated($processFlow));

    }

    public function test_to_return_null_when_observer_is_called(): void
    {

        $stepService = new ProcessflowStepService();
        $processFlowObserver = new ProcessFlowObserver($stepService);
        $processFlow = new ProcessFlow();
        $processFlowObserver->updated($processFlow);
        $this->assertNull($processFlowObserver->updated($processFlow));

    }

    public function test_observer_was_run_at_least_once(): void
    {
        $stepService = new ProcessflowStepService();
        $processFlowObserver = $this->getMockBuilder(ProcessFlowObserver::class)
            ->setConstructorArgs([$stepService])
            ->getMock();

        $processFlow = new ProcessFlow();
        $processFlowObserver->expects($this->atLeastOnce())
            ->method('updated')
            ->with($processFlow)
            ->willReturn(null);

        $result = $processFlowObserver->updated($processFlow);

        $this->assertNull($result);
    }

    public function test_to_see_observer_is_called_when_deleting(): void
    {

        $processFlowData = [
            'name' => 'Test Process Flow',
            'frequency' => 'weekly',
            'status' => true,
            'frequency_for' => 'users',
            'day' => null,
            'week' => 'monday',
            'steps' => [
                [

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
                ],
                [

                    'name' => 'test name single two test',
                    'step_route' => 'this should be a route',
                    'assignee_user_route' => 1,
                    'next_user_designation' => 1,
                    'next_user_department' => 1,
                    'next_user_unit' => 1,
                    'next_user_location' => 1,
                    'step_type' => 'create',
                    'user_type' => 'customer',
                    'status' => 1,
                ],
            ],
        ];
        $stepService = new ProcessflowStepService();
        $processFlow = new ProcessFlow($processFlowData);
        $observer = new ProcessFlowObserver($stepService);
        $observer->deleting($processFlow);
        $this->assertNull($observer->deleting($processFlow));
<<<<<<< HEAD
<<<<<<< HEAD
=======
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
>>>>>>> 842bee3 (observer test)

    }
    public function test_to_show_observer_executes_to_updates_steps_in_database()
    {

        $processFlowData = [
            'name' => 'Test Process Flow',
            'frequency' => 'weekly',
            'status' => true,
            'frequency_for' => 'users',
            'day' => null,
            'week' => 'monday',
            'steps' => [
                [

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
                ],
                [

                    'name' => 'test name single two test',
                    'step_route' => 'this should be a route',
                    'assignee_user_route' => 1,
                    'next_user_designation' => 1,
                    'next_user_department' => 1,
                    'next_user_unit' => 1,
                    'next_user_location' => 1,
                    'step_type' => 'create',
                    'user_type' => 'customer',
                    'status' => 1,
                ],
            ],
        ];
        $observer = new ProcessFlowObserver(new ProcessflowStepService());
        $processFlowModel = ProcessFlow::factory()->create($processFlowData);
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
=======
>>>>>>> 744c314 (observer code added)
=======
>>>>>>> origin/NGMC-92-Create-a-route-that-would-be-used-to-fetch-all-workflow-history

    }

}
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b292480 (processflow observer test file)
=======
>>>>>>> 5072849 (observer test)
>>>>>>> 842bee3 (observer test)
=======
>>>>>>> 5072849 (observer test)
>>>>>>> origin/NGMC-92-Create-a-route-that-would-be-used-to-fetch-all-workflow-history
