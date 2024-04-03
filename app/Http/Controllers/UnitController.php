<?php

namespace App\Http\Controllers;

use App\Service\UnitService;
use App\Http\Resources\UnitResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;



/**
 * @OA\Tag(name="Unit")
 */
class UnitController extends Controller
{
    private UnitService $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }


    /**
     * @OA\Get(
     *     path="/units",
     *     tags={"Unit"},
     *     summary="Get all Units in the system",
     *     description="Returns all available Units",
     *     @OA\Response(
     *         response=200,
     *         description="Units found",
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
     *  security={
     *         {"BearerAuth": {}}
     *     }
     * )
     */

    /**
     * Display a listing of the units.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $units = $this->unitService->getAllUnits();
        return UnitResource::collection($units);
    }

    /**
     * @OA\Get(
     *     path="/units/{id}",
     *     tags={"Unit"},
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
     *  security={
     *         {"BearerAuth": {}}
     *     }
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