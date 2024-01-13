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
    public function store(Store $request)
    {
        return $this->tripRepository->create($request->user_id, $request->from, $request->to);
    }
    public function single(Request $request, $user_id)
    {
        $data = $this->tripRepository->single($request->user_id);
        return dispatch_sync(new CalculatePath($data));
    }
}
