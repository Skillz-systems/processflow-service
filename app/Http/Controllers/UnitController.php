<?php

namespace App\Http\Controllers;

use App\Service\UnitService;
use App\Http\Resources\UnitResource;

/**
 * @OA\Tag(name="Units")
 */
class UnitController extends Controller
{
    private UnitService $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function index()
    {
        //
    }



    /**
     * @OA\Get(
     *     path="/units/{id}",
     *     tags={"Units"},
     *     summary="Get a Unit",
     *     description="Returns the details of a single Unit",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the unit",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Unit found",
     *         @OA\JsonContent(ref="#/components/schemas/UnitResource")
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
     * )
     */


    /**
     * Display the specified unit.
     *
     * @param int $id
     * @return UnitResource
     */
    public function show(int $id): UnitResource
    {
        $unit = $this->unitService->getSingleUnit($id);

        return new UnitResource($unit);
    }
}