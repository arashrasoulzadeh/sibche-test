<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FLowTest extends TestCase
{
    // use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_example1(): void
    {
        $trips = [['SFO', 'EWR']];
        $this->testTrip($trips, 1);
    }
    public function test_example2(): void
    {
        $trips = [["ATL", "EWR"], ["SFO", "ATL"]];
        $this->testTrip($trips, 2);
    }
    public function test_example3(): void
    {
        $trips = [["IND", "EWR"], ["SFO", "ATL"], ["GSO", "IND"], ["ATL", "GSO"]];
        $this->testTrip($trips, 3);
    }

    private function testTrip($trips, $user_id)
    {
        $expectedOutput = ['SFO', 'EWR'];
        foreach ($trips as $trip) {
            $data = [
                'from' => $trip[0],
                'to'    => $trip[1],
                'user_id' => $user_id
            ];
            $response = $this->postJson(route('trip.create'), $data);
        }
        $response->assertStatus(201);
        $response = $this->getJson(route('trip.single', [$user_id]), $data);
        $response->assertStatus(200);
        $response->assertJson($expectedOutput);
    }
}
