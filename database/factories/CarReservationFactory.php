<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CarReservation;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(CarReservation::class, function (Faker $faker) {
    $faker = Factory::create();
    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    return [
        'reserver'  =>  $faker->userName,
        'type'      =>  $faker->vehicleType,
        'model'     =>  $faker->vehicleModel,
        'color'     => "black",
        'reservation' => true
    ];
});
