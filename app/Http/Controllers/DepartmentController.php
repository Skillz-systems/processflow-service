<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Service\DepartmentService;
use App\Http\Resources\DepartmentResource;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
/**
 * @OA\Tag(name="Department")
 */


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
 *     path="/departments/{id}",
 *     tags={"Department"},
 *     summary="Get a single department",
 *     description="Returns the details of a single department",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the department",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful Response",
 *         @OA\JsonContent(ref="#/components/schemas/DepartmentResource")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error"
 *     )
 * )
 */
    public function show(int $id)
    {
        $department = $this->departmentService->getSingleDepartment($id);

        return new DepartmentResource($department);
    }
}