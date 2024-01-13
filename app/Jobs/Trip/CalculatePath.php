<?php

namespace App\Jobs\Trip;

use App\Models\Node;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

class CalculatePath
{

    /**
     * Create a new job instance.
     */
    public function __construct(public Collection $trips)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $travelList = [];
        foreach ($this->trips as $trip) {
            $travelList[] = [
                $trip->from, $trip->to
            ];
        }

        if (count($travelList) <= 1) {
            return $travelList[0];
        }
        $travelList = $this->resort($travelList);
        $src = $travelList[0][0];
        $dest = $travelList[count($travelList) - 1][1];
        return [$src, $dest];
    }

    public function moveElement($array, $a, $b)
    {
        $out = array_splice($array, $a, 1);
        array_splice($array, $b, 0, $out);
        return $array;
    }
    public function resort($trips, $index = 0)
    {
        $current = $trips[$index];
        $currentSrc = $current[0];
        for ($i = 0; $i < count($trips); $i++) {
            $pivot = $trips[$i];
            $pivotDest = $pivot[1];
            if ($currentSrc == $pivotDest) {
                $trips = $this->resort($this->moveElement($trips, $i, 0));
            }
        }

        return $trips;
    }
}
