<?php

namespace App\Http\Controllers;

use App\Http\Resources\DesignationResource;
use App\Models\Designation;
use App\Service\DesignationService;
use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;


/**
 * @OA\Tag(name="Designations")
 */
class DesignationController extends Controller
{

    protected $designationService;

    public function __construct(DesignationService $designationService)
    {
        $this->designationService = $designationService;
    }

    /**
     * @OA\Get(
     *     path="/designations",
     *     tags={"Designation"},
     *     summary="Get all designations in the system",
     *     description="Returns all available designations",
     *     @OA\Response(
     *         response=200,
     *         description="Designations found",
     *         @OA\JsonContent(ref="#/components/schemas/DesignationResource")
     *     ),
     * @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     * @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     * @OA\Response(
     *          response=500,
     *          description="Server Error",
     *      ),
     *  security={
     *         {"BearerAuth": {}}
     *     }
     * )
     */

    /**
     * Retrieves all designations and returns them as a collection of DesignationResource objects.
     *
     */
    public function index()
    {
        $designations = $this->designationService->getAllDesignations();
        return DesignationResource::collection($designations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesignationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     *     path="/designations/{id}",
     *     tags={"Designation"},
     *     summary="Get a designation",
     *     description="Returns the details of a single designation",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the process flow",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Designation found",
     *         @OA\JsonContent(ref="#/components/schemas/DesignationResource")
     *     ),
     * @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     * @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      ),
     * @OA\Response(
     *          response=500,
     *          description="Server Error",
     *      ),
     *  security={
     *         {"BearerAuth": {}}
     *     }
     * )
     */
    /**
     * Retrieves a single designation by its ID and returns it as a DesignationResource.
     *
     * @param int $id The ID of the designation to retrieve.
     * @return DesignationResource The DesignationResource representing the retrieved designation.
     */
    public function show(int $id)
    {
        $designation = $this->designationService->getSingleDesignation($id);
        return new DesignationResource($designation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        //
    }
}