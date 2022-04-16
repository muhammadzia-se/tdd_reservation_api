<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->group(function(){
    
    // Car Reservation routes

    Route::post('/cars', 'CarController@store');
    Route::get('/cars', 'CarController@getAllCars');
    Route::get('/cars/{id}', 'CarController@show');
    Route::put('/cars/{id}', 'CarController@update');
    Route::delete('/cars/{id}', 'CarController@destroy');
    Route::post('/car/reserve', 'CarReservationController@reserve');

    // House Reservation routes

    Route::post('/houses', 'HouseController@store');
    Route::get('/houses', 'HouseController@getAllHouses');
    Route::get('/houses/{id}', 'HouseController@show');
    Route::put('/houses/{id}', 'HouseController@update');
    Route::delete('/houses/{id}', 'HouseController@destroy');
    Route::post('/house/reserve', 'HouseReservationController@reserve');

});
