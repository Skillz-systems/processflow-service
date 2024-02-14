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
     * Display a listing of all the workflow history resource.
     */
    public function index(Request $request)
    {
        $workflowhistories = QueryBuilder::for(WorkflowHistory::class)  
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