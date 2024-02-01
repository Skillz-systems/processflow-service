<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessFlowStepRequest;
use App\Http\Resources\ProcessFlowResource;
use App\Service\ProcessFlowService;
use App\Service\ProcessflowStepService;
use Illuminate\Http\Request;

class ProcessflowStepController extends Controller
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
     * Store a newly created resource in storage.
     */
    public function store($id, StoreProcessFlowStepRequest $request)
    {
        $getProcessflow = $this->processFlowService->getProcessFlow($id);
        $steps = $request->steps;
        $createdStepsId = [];
        foreach ($steps as $key => $value) {
            // create a new step
            $requestData = new Request($value);

            if ($createdStep = $this->processflowStepService->createProcessFlowStep($requestData)
            ) {
                array_push($createdStepsId, $createdStep->id);

            }

        }

        if ($getProcessflow->start_step_id < 1) {
            // update processflow start step if here
            $processflowData = new Request(["start_step_id" => $createdStepsId[0]]);
        } else {
            // take the last step id and update the first one created
        }
        $this->processFlowService->updateProcessflow($id, $processflowData);
        for ($i = 1; $i < count($createdStepsId) - 1; $i++) {
            $nextStep = new Request(["next_step" => $createdStepsId[$i + 1]]);
            $this->processflowStepService->updateProcessFlowStep($nextStep, $createdStepsId[$i]);
        }
        $result = $this->processFlowService->getProcessFlow($id);
        return new ProcessFlowResource($result);

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
