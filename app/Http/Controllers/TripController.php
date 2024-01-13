<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trip\Store;
use App\Jobs\Trip\CalculatePath;
use App\Models\Repositories\ITripRepository;
use Illuminate\Http\Request;

class TripController extends Controller
{

    public function __construct(public ITripRepository $tripRepository)
    {
    }
    /**
     * @OA\Post(
     *     path="/api/trip",
     *     summary="Create a new trip",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Trip data",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="from", type="string", example="TEH"),
     *                 @OA\Property(property="to", type="string", example="RST"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="400", description="Bad request"),
     * )
     */

    public function store(Store $request)
    {
        return $this->tripRepository->create($request->user_id, $request->from, $request->to);
    }
    /**
     * @OA\Get(
     *     path="/api/trip/{userId}",
     *     summary="Fetch trip data",
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         description="ID of the user",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     * )
     */


    public function single(Request $request, $user_id)
    {
        $data = $this->tripRepository->single($request->user_id);
        return dispatch_sync(new CalculatePath($data));
    }
}
