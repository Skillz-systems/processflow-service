<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Service\DepartmentService;
use App\Http\Resources\DepartmentResource;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
   private DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        //
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
    public function store(StoreDepartmentRequest $request)
    {
        //
    }



    /**
     * @OA\Get(
     *      path="/departments/{id}",
     *      operationId="getDepartmentById",
     *      tags={"Routes"},
     *      summary="Get department by ID",
     *      description="Returns a single department by its ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the department to retrieve",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/DepartmentResource"
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Department not found"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error"
     *      )
     * )
     *
     * @param string $id The ID of the department to retrieve.
     * @return \App\Http\Resources\DepartmentResource
     */
    public function show(int $id): DepartmentResource
    {
        $department = $this->departmentService->getSingleDepartment($id);

        return new DepartmentResource($department);
    }
}