<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessFlowStepRequest;
use App\Http\Resources\ProcessFlowResource;
<<<<<<< HEAD
use App\Http\Resources\ProcessFlowStepResource;
use App\Models\ProcessFlowStep;
=======
>>>>>>> 6ecc84c (wip)
use App\Service\ProcessFlowService;
use App\Service\ProcessflowStepService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
     * @OA\Post(
     *     path="/processflowstep/create/{id}",
     *     summary="Create Process Flow Steps",
     *     tags={"Process Flow Steps"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the process flow",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Array of steps",
     *         @OA\JsonContent(
     *             type="object",
     *             required={"steps"},
     *             @OA\Property(
     *                 property="steps",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     required={"name", "step_route", "assignee_user_route", "next_user_designation", "next_user_department", "next_user_unit", "process_flow_id", "next_user_location", "step_type", "user_type", "status"},
     *                     @OA\Property(property="name", type="string", description="Step name"),
     *                     @OA\Property(property="step_route", type="string", description="Step route"),
     *                     @OA\Property(property="assignee_user_route", type="integer", description="Assignee user route"),
     *                     @OA\Property(property="next_user_designation", type="integer", description="Next user designation"),
     *                     @OA\Property(property="next_user_department", type="integer", description="Next user department"),
     *                     @OA\Property(property="next_user_unit", type="integer", description="Next user unit"),
     *                     @OA\Property(property="process_flow_id", type="integer", description="Process flow ID"),
     *                     @OA\Property(property="next_user_location", type="integer", description="Next user location"),
     *                     @OA\Property(property="step_type", type="string", description="Step type"),
     *                     @OA\Property(property="user_type", type="string", description="User type"),
     *                     @OA\Property(property="status", type="integer", description="Status"),
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Process Flow created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ProcessFlowResource")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", description="Error message"),
     *         ),
     *     ),
     * )
     */
<<<<<<< HEAD

=======
>>>>>>> 6ecc84c (wip)
    public function store($id, StoreProcessFlowStepRequest $request)
    {
        $getProcessflow = $this->processFlowService->getProcessFlow($id);
        $steps = $request->steps;
        $createdStepsId = [];
<<<<<<< HEAD
        DB::beginTransaction();

        try {
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
                $this->processFlowService->updateProcessflow($id, $processflowData);

            } else {
                // take the last step id and update the first one created
                $model = new ProcessFlowStep();
                $getStep = $model->where(["process_flow_id" => $id])->latest()->first();
                $processflowStepData = new Request(["next_step_id" => $createdStepsId[0]]);
                $this->processflowStepService->updateProcessFlowStep($processflowStepData, $getStep->id);

            }

            for ($i = 1; $i < count($createdStepsId) - 1; $i++) {
                $nextStep = new Request(["next_step_id" => $createdStepsId[$i + 1]]);
                $this->processflowStepService->updateProcessFlowStep($nextStep, $createdStepsId[$i]);
            }
            $result = $this->processFlowService->getProcessFlow($id);
            DB::commit();

            return new ProcessFlowResource($result);

        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Something went wrong.");

        }

=======
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

>>>>>>> 6ecc84c (wip)
    }

    /**
     * @OA\Get(
     *     path="/processflowstep/view/{id}",
     *     summary="View a process flow step",
     *     tags={"Process Flow Steps"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the process flow step to view",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/ProcessFlowStepResource"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="something went wrong")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="id is invalid")
     *         )
     *     )
     * )
     */

    public function show(string $id)
    {

        try {
            $getStep = $this->processflowStepService->getProcessFlowStep($id);
            if ($getStep) {
                return new ProcessFlowStepResource($getStep);
            }
            return response()->json(['status' => "error", "message" => "something went wrong"], 404);

        } catch (\Exception $e) {
            return response()->json(['status' => "error", "message" => "id is invalid"], 404);
        }

    }

    /**
     * @OA\Put(
     *     path="/processflowstep/update/{id}",
     *     summary="Update a process flow step",
     *     tags={"Process Flow Steps"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the process flow step to update",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"step"},
     *             @OA\Property(
     *                 property="step",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="string", example="1"),
     *                     @OA\Property(property="name", type="string", example="test name"),
     *                     @OA\Property(property="step_route", type="string", example="1"),
     *                     @OA\Property(property="assignee_user_route", type="string", example="1"),
     *                     @OA\Property(property="next_user_designation", type="string", example="1"),
     *                     @OA\Property(property="next_user_department", type="string", example="1"),
     *                     @OA\Property(property="next_user_unit", type="string", example="1"),
     *                     @OA\Property(property="process_flow_id", type="string", example="1"),
     *                     @OA\Property(property="ext_user_location", type="string", example="1"),
     *                     @OA\Property(property="step_type", type="string", example="1"),
     *                     @OA\Property(property="user_type", type="string", example="1"),
     *                     @OA\Property(property="next_step_id", type="string", example="2"),
     *                     @OA\Property(property="status", type="string", example="1"),
     *
     *
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="step", type="string", example="The step field is required.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Something went wrong.")
     *         )
     *     )
     * )
     */

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "step" => "required",
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $steps = $request->step;
        $stepsRequest = new Request(["start_step_id" => $steps[0]['id']]);
        // update start step id
        DB::beginTransaction();

        try {
            $this->processFlowService->updateProcessflow($id, $stepsRequest);
            // Update Start step details
            $this->processflowStepService->updateProcessFlowStep(new Request($steps[0]), $steps[0]["id"]);
            // update other steps
            for ($i = 1; $i < count($steps); $i++) {
                $this->processflowStepService->updateProcessFlowStep(new Request($steps[$i]), $steps[$i]["id"]);

            }
            DB::commit();
            return response()->json(["status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception("Something went wrong.");

        }
    }

    /**
     * @OA\Delete(
     *      path="/processflowstep/delete/{id}",
     *      operationId="deleteProcessFlowStep",
     *      tags={"Process Flow Steps"},
     *      summary="Delete a process flow step",
     *      description="Deletes a process flow step by its ID.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the process flow step to delete",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Process flow step successfully deleted"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Process flow step not found",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="error"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Provided id does not match any record"
     *              )
     *          )
     *      )
     * )
     */

    public function destroy(string $id)
    {
        if ($this->processflowStepService->deleteProcessFlowStep($id)) {
            return response()->noContent();
        }
        return response()->json(["status" => "error", "message" => "Provided id does not match any record"]);
    }
}
