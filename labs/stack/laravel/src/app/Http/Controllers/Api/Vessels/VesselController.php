<?php

namespace App\Http\Controllers\Api\Vessels;

use App\Http\Controllers\Controller;
use App\Http\Resources\VesselIndexResource;
use App\Models\Vessel;
use App\Services\VesselService;
use Illuminate\Http\Request;

class VesselController extends Controller
{
    public function __construct(VesselService $vesselService)
    {
        $this->_vesselService = $vesselService;

        // $this->middleware('auth:api');
    }

    /**
     * Get all vessels
     *   /**
     * @OA\Get(
     *   tags={"Vessels"},
     *   path="/gis/vessels",
     *   summary="Query all vessels",
     *   operationId="VesselController@index",
     *   @OA\Parameter(
     *       name="search",
     *       in="query",
     *       required=false,
     *       @OA\Schema(
     *           type="string",
     *       )
     *   ),
     *   @OA\Parameter(
     *       name="vehicle",
     *       in="query",
     *       required=false,
     *       @OA\Schema(
     *           type="string",
     *       )
     *   ),
     *   @OA\Parameter(
     *       name="vesselClass",
     *       in="query",
     *       required=false,
     *       @OA\Schema(
     *           type="string",
     *       )
     *   ),
     *   @OA\Parameter(
     *       name="fields",
     *       in="query",
     *       required=false,
     *       @OA\Schema(
     *           type="array",
     *           @OA\Items(
     *               type="string",
     *               enum = {"id","shape","apiVersion","detectionMetadata","collectionMetadata","isCorrelated","imageChipName"},
     *           )
     *       )
     *   ),
     *   @OA\Parameter(
     *       name="page",
     *       in="query",
     *       required=false,
     *       @OA\Schema(
     *           type="integer",
     *       )
     *   ),
     *   @OA\Parameter(
     *       name="rowsPerPage",
     *       in="query",
     *       required=false,
     *       @OA\Schema(
     *           type="integer",
     *           @OA\Items(
     *               type="integer",
     *               default=15
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Successful operation", @OA\JsonContent()),
     *   @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *   @OA\Response(response=500, description="Internal server error", @OA\JsonContent())
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $this->_vesselService->list($request);

        return VesselIndexResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function show(Vessel $vessel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vessel $vessel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vessel $vessel)
    {
        //
    }
}
