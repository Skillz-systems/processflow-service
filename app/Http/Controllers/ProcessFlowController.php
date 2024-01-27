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
        // transaction for data integrity
        return DB::transaction(function () use ($request) {
            //track important IDs
            $firstStepId = null;
            $previousStepId = null;
            $processFlowId = null;

            if ($request->has('steps')) {

                $steps = $request->steps;
                //loop through steps and create them
                foreach ($steps as $index => $step) {

                    if ($previousStepId !== null) {
                        // set next_step_id on previous step,
                        // added + 1 to get the next step id
                        $step['next_step_id'] = $previousStepId + 1;
                        $step['process_flow_id'] = $processFlowId;
                    }
                    //create step
                    $createdStep = $this->processflowStepService->createProcessFlowStep(new Request($step));
                    //set previous step id
                    $previousStepId = $createdStep->id;

                    if ($index === 0) {
                        //set start step id, first step is the start step
                        //run only once
                        $firstStepId = $createdStep->id;
                        $request['start_step_id'] = $firstStepId;
                        //create processflow, since the start_step_id is set or known
                        $storedProcessFlow = $this->processFlowService->createProcessFlow($request);
                        $processFlowId = $storedProcessFlow->id;

                        //update the first step_id with processflow_id created above
                        $this->processflowStepService->updateProcessFlowStep(new Request(['process_flow_id' => $storedProcessFlow->id, 'next_step_id' => $firstStepId + 1]), $firstStepId);

                    }
                    if ($index === count($steps) - 1) {
                        //update the last step_id created with null
                        $this->processflowStepService->updateProcessFlowStep(new Request(['next_step_id' => null]), $createdStep->id);
                    }
                }

            } else {

                //only run if there are no steps
                $storedProcessFlow = $this->processFlowService->createProcessFlow($request);
            }

            return new ProcessFlowResource($storedProcessFlow);
        });
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
