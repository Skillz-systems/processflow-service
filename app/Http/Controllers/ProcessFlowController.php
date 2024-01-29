<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessFlowRequest;
use App\Http\Resources\ProcessFlowResource;
use App\Service\ProcessFlowService;
use App\Service\ProcessflowStepService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessFlowController extends Controller
{
    /**
     * The ProcessFlowService instance that will handle the business logic.
     *
     * The constructor injects the service into the controller so it can be used
     * in the controller methods.
     */
    protected $processFlowService, $processflowStepService;

    public function __construct(ProcessFlowService $processFlowService, ProcessflowStepService $processflowStepService)
    {
        $this->processFlowService = $processFlowService;
        $this->processflowStepService = $processflowStepService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a new process flow and its steps(optional).
     *
     * This method takes a request with steps data and creates a new process flow and its associated steps.
     * It handles setting up the relationships between the steps like next_step_id and process_flow_id.
     * It also handles setting the start_step_id on the process flow.
     *
     * @param StoreProcessFlowRequest $request The request containing the process flow data.
     * @return ProcessFlowResource The created process flow resource.
     */

    public function store(StoreProcessFlowRequest $request)
    {

        return DB::transaction(function () use ($request) {

            if ($request->has('steps')) {
                $steps = $request->steps;
                $createdSteps = [];
                $processFlowId = null;

                foreach ($steps as $index => $step) {
                    $createdStep = $this->processflowStepService->createProcessFlowStep(new Request($step));
                    if ($index === 0) {
                        $request['start_step_id'] = $createdStep->id;
                        $storedProcessFlow = $this->processFlowService->createProcessFlow($request);
                        $processFlowId = $storedProcessFlow->id;
                    }
                    $createdSteps[] = $createdStep;
                }
                foreach ($createdSteps as $index => $step) {
                    $next_step_id = $index === count($createdSteps) - 1 ? null : $createdSteps[$index + 1]->id;
                    $this->processflowStepService->updateProcessFlowStep(new Request(['process_flow_id' => $processFlowId, 'next_step_id' => $next_step_id]), $step->id);
                }

            } else {
                $storedProcessFlow = $this->processFlowService->createProcessFlow($request);
            }
            return new ProcessFlowResource($storedProcessFlow);
        }, 5);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
