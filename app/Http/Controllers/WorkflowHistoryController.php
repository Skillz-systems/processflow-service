<?php

namespace App\Http\Controllers;

use App\Models\WorkflowHistory;
use App\Http\Requests\StoreWorkflowHistoryRequest;
use App\Http\Resources\WorkflowHistoryResource;
use App\Http\Resources\WorkflowHistoryCollection;
use App\Service\WorkflowHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
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
     *      path="/api/workflow-histories",
     *      operationId="getWorkflowHistories",
     *      tags={"Workflow History"},
     *      summary="Get paginated list of workflow histories",
     *      description="Returns a paginated list of workflow histories with optional filtering, sorting, and pagination.",
     *      @OA\Parameter(
     *          name="status",
     *          in="query",
     *          description="Filter by status",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="sort",
     *          in="query",
     *          description="Sort by field (prepend with '-' for descending order)",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="Page number",
     *          required=false,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="per_page",
     *          in="query",
     *          description="Number of items per page",
     *          required=false,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/WorkflowHistoryCollection")
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      )
     * )
    */    
    
    public function index(Request $request)
    {
        $workflowhistories = $this->workflowHistoryService->getWorkflowHistories($request)  
            ->allowedFilters('status')
            ->defaultSort('-user_id')
            ->allowedSorts(['processflow_id', 'status', 'user_id', 'task_id'])
            ->paginate();

            return new WorkflowHistoryCollection($workflowhistories);
    }
    /**
     * Store a new workflow history.
     *
     * This method takes a request and creates a new workflow history.
     *
     * @param StoreWorkflowHistoryRequest $request The request containing the workflow history data.
     * @return WorkflowHistoryResource The created workflow history resource.
     */

    public function store(StoreWorkflowHistoryRequest $request)
    {
        return DB::transaction(function () use ($request) 
        {
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