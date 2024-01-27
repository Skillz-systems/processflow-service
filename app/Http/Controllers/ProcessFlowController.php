<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProcessFlowResource;
use Illuminate\Http\Request;
use App\Service\ProcessFlowService;
use App\Http\Requests\StoreProcessFlowRequest;

class ProcessFlowController extends Controller
{
    /**
     * The ProcessFlowService instance that will handle the business logic.
     *
     * The constructor injects the service into the controller so it can be used
     * in the controller methods.
     */
    protected $processFlowService;

    public function __construct(ProcessFlowService $processFlowService)
    {
        $this->processFlowService = $processFlowService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    /**
     * Store a new process flow.
     *
     * @param StoreProcessFlowRequest $request The request containing the process flow data.
     * @return ProcessFlowResource The created process flow resource.
     */
    public function store(StoreProcessFlowRequest $request)
    {
        $storedProcessFlow = $this->processFlowService->createProcessFlow($request);
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
