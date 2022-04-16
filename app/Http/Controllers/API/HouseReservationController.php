<?php

namespace App\Http\Controllers\API;

use App\HouseReservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HouseReservationController extends Controller
{
    // this function will be responsible to reserve the Car service
    public static function reserve(Request $request)
    {
        $reserveHouse = HouseReservation::create([
            'reserver'              =>  $request->reserver,
            'area'                  =>  $request->area,
            'number_of_rooms'       =>  $request->number_of_rooms,
            'number_of_bath_rooms'  => $request->number_of_bath_rooms,
            'has_internet'          => $request->has_internet,
            'has_parking'           => $request->has_parking,
            'reservation'           => $request->reservation
        ]);

        return response()->json($reserveHouse, 201);
    }
}
