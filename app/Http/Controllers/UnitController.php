<?php

namespace App\Http\Controllers;

use App\Service\UnitService;
use App\Http\Resources\UnitResource;


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