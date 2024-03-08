<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkflowHistoryRequest;
use App\Http\Resources\WorkflowHistoryResource;
use App\Service\WorkflowHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\WorkflowHistoryCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WorkflowHistoryController extends Controller
{
    /**
     * The WorkflowHistoryService instance that will handle the business logic.
     *
     * The constructor injects the service into the controller so it can be used
     * in the controller methods.
     */
    protected $workflowHistoryService;

    public function __construct(WorkflowHistoryService $workflowHistoryService)
    {
        $this->workflowHistoryService = $workflowHistoryService;
    }

    /**
     * @OA\Get(
     *     path="/workflowhistory",
     *     summary="Fetch all workflow histories",
     *     tags={"Workflow Histories"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/WorkflowHistory")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     * 
     * @param \App\Http\Requests\UpdateWorkflowHistoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */



    public function index()
    {
        $workflowHistories = $this->workflowHistoryService->getWorkflowHistories();
        return WorkflowHistoryResource::collection($workflowHistories);
    }


    /**
     * @OA\Post(
     *      path="/workflowhistory/create",
     *      operationId="storeWorkflowHistory",
     *      tags={"Workflow History"},
     *      summary="Create a new workflow history",
     *      description="Creates a new workflow history record",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Workflow History data",
     *          @OA\JsonContent(ref="#/components/schemas/WorkflowHistory")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", ref="#/components/schemas/WorkflowHistory")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(property="errors", type="object")
     *          )
     *      )
     * )
     * 
     * @param StoreWorkflowHistoryRequest $request The request containing the workflow history data.
     * @return WorkflowHistoryResource The created workflow history resource.

     */

    public function store(StoreWorkflowHistoryRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $storedWorkflowHistory = $this->workflowHistoryService->createWorkflowHistory($request);
            return new WorkflowHistoryResource($storedWorkflowHistory);
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
