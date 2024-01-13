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
        $travelList = $this->resort($travelList);
        $src = ($travelList[count($travelList) - 1][0]);
        $dest = ($travelList[0][1]);
        return [$src, $dest];
    }

    public function moveElement($array, $a, $b)
    {
        $out = array_splice($array, $a, 1);
        array_splice($array, $b, 0, $out);
        return $array;
    }
    public function resort($trips)
    {
        for ($i = 0; $i < count($trips); $i++) {
            $src = $trips[$i][0];
            for ($j = 0; $j < count($trips); $j++) {
                $dest = $trips[$j][1];
                if ($i != $j) {
                    if ($src == $dest) {
                        $array = $this->moveElement($trips, $j, $i);
                    }
                }
            }
        }
        return $array;
    }
}
