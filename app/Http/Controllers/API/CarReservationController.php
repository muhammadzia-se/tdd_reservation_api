<?php

namespace App\Http\Controllers\API;

use App\CarReservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarReservationController extends Controller
{
    // this function will be responsible to reserve the Car service
    public static function reserve(Request $request)
    {
        $reserveCar = CarReservation::create([
            'reserver'      =>  $request->reserver,
            'type'          =>  $request->type,
            'model'         =>  $request->model,
            'color'         => $request->color,
            'reservation'   => $request->reservation
        ]);

        return response()->json($reserveCar, 201);
    }
}
