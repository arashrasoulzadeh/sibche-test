<?php

namespace App\Models\Repositories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

interface ITripRepository
{
    public function create(string $user_id, string $from, string $to);
    public function single(string $user_id): Collection;
}
