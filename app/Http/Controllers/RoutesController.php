<?php

namespace App\Http\Controllers;

use App\Http\Resources\RouteResource;
use App\Service\RouteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoutesController extends Controller
{

    protected $routeService;

    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;

    }
    /**
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *      path="/routes",
     *      operationId="storeRoute",
     *      tags={"Routes"},
     *      summary="Create a new route",
     *      @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         description="Route Name",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="link",
     *         in="query",
     *         required=true,
     *         description="Route Path",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="status",
     *         in="query",
     *         required=true,
     *         description="This is the active or inactive status of a route , Default as true or 1 , to indicate the route is active",
     *         @OA\Schema(type="boolean")
     *     ),
     *      @OA\Response(
     *          response="200",
     *          description="Route created successfully",
     *          @OA\JsonContent(ref="#/components/schemas/RouteResource")
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Bad Request",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="name", type="array",
     *                      @OA\Items(type="string", example="The name field is required.")
     *                  ),
     *                  @OA\Property(property="link", type="array",
     *                      @OA\Items(type="string", example="The link field is required.")
     *                  ),
     *                  @OA\Property(property="status", type="array",
     *                      @OA\Items(type="string", example="The status field is required.")
     *                  ),
     *              )
     *          )
     *      )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\RouteResource
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'link' => 'required|string',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "error", "data" => $validator->errors()], 400);
        }

        $result = $this->routeService->createRoute($request);
        return new RouteResource($result);
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
