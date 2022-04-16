<?php

namespace App\Http\Controllers\Api;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarCollection;
use App\Http\Resources\Car as CarResource;

class CarController extends Controller
{
    //
    public static function store(Request $request)
    {
        $car = Car::create([
            'type'  => $request->type,
            'model' => $request->model,
            'year'  => $request->year,
            'color' => "black",
            'number_of_passengers' => $request->number_of_passengers
        ]);

        return response()->json(new CarResource($car), 201);
    }

    public static function getAllCars()
    {
        return new CarCollection(Car::where('id','<>',null)->get());
    }

    public static function show(int $id)
    {
        $car = Car::findOrfail($id);
        
        return response()->json(new CarResource($car), 200);
    }

    public static function update(Request $request, int $id)
    {
        $car = Car::findOrfail($id);
        
        $car->update([
            'type'  => $request->type,
            'model' => $request->model,
            'year'  => $request->year,
            'color' => $request->color,
            'number_of_passengers' => $request->number_of_passengers
        ]);
        
        return response()->json(new CarResource($car), 200);
    }

    public static function destroy(int $id)
    {
        $car = Car::findOrfail($id);
        
        $car->delete();

        return response()->json(null, 204);
    }
}
