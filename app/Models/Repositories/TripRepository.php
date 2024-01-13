<?php

namespace App\Models\Repositories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

class TripRepository implements ITripRepository
{
    public function create(string $user_id, string $from, string $to)
    {
        return Trip::create(
            [
                'user_id' => $user_id,
                'from' => $from,
                'to' => $to
            ]
        );
    }

    public function single(string $user_id): Collection
    {
        return Trip::where('user_id', $user_id)->get();
    }
}
