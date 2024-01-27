<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessFlowRequest;
use App\Http\Resources\ProcessFlowResource;
use App\Service\ProcessFlowService;
use App\Service\ProcessflowStepService;
use Illuminate\Http\Request;

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

        // $user = Auth::user();
        // $token = $request->bearerToken();

        // if (!$user || !$token) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        $firstStepId = null;
        $previousStepId = null;
        $processFlowId = null;

        if ($request->has('steps')) {

            $steps = $request->steps;

            foreach ($steps as $index => $step) {

                if ($previousStepId !== null) {
                    $step['next_step_id'] = $previousStepId + 1;
                    $step['process_flow_id'] = $processFlowId;
                }
                $createdStep = $this->processflowStepService->createProcessFlowStep(new Request($step));
                $previousStepId = $createdStep->id;

                if ($index === 0) {
                    $firstStepId = $createdStep->id;
                    $request['start_step_id'] = $firstStepId;
                    $storedProcessFlow = $this->processFlowService->createProcessFlow($request);
                    $processFlowId = $storedProcessFlow->id;
                    $this->processflowStepService->updateProcessFlowStep(new Request(['process_flow_id' => $storedProcessFlow->id, 'next_step_id' => $firstStepId + 1]), $firstStepId);

                }
                if ($index === count($steps) - 1) {
                    $this->processflowStepService->updateProcessFlowStep(new Request(['next_step_id' => null]), $createdStep->id);
                }
            }

        } else {
            $storedProcessFlow = $this->processFlowService->createProcessFlow($request);
        }

        return new ProcessFlowResource($storedProcessFlow);
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
