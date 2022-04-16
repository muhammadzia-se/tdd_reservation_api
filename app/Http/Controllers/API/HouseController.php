<?php

namespace App\Http\Controllers\Api;

use App\House;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HouseCollection;
use App\Http\Resources\House as HouseResource;

class HouseController extends Controller
{
    //
    public static function store(Request $request)
    {
        $house = House::create([
            'area'  => $request->area,
            'number_of_rooms' => $request->number_of_rooms,
            'number_of_bath_rooms'  => $request->number_of_bath_rooms,
            'has_internet' => $request->has_internet,
            'has_parking' => $request->has_parking,
        ]);

        return response()->json(new HouseResource($house), 201);
    }

    public static function getAllHouses()
    {
        return new HouseCollection(House::where('id','<>',null)->get());
    }

    public static function show(int $id)
    {
        $house = House::findOrfail($id);
        
        return response()->json(new HouseResource($house), 200);
    }

    public static function update(Request $request, int $id)
    {
        $house = House::findOrfail($id);
        
        $house->update([
            'area'  => $request->area,
            'number_of_rooms' => $request->number_of_rooms,
            'number_of_bath_rooms'  => $request->number_of_bath_rooms,
            'has_internet' => $request->has_internet,
            'has_parking' => $request->has_parking
        ]);
        
        return response()->json(new HouseResource($house), 200);
    }

    public static function destroy(int $id)
    {
        $car = House::findOrfail($id);
        
        $car->delete();

        return response()->json(null, 204);
    }
}
