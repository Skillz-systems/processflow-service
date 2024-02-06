<<<<<<< HEAD
=======
<?php

namespace Tests\Feature;

use App\Models\ProcessFlow;
use App\Observers\ProcessFlowObserver;
use App\Service\ProcessflowStepService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessFlowObserverTest extends TestCase
{

    use RefreshDatabase;

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

    }

}
>>>>>>> 5072849 (observer test)
