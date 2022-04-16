<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use Faker\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {
    $faker = Factory::create();
    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    return [
        'type'  => $faker->vehicleType,
        'model' => $faker->vehicleModel,
        'year'  => $faker->biasedNumberBetween(1990,2022, 'sqrt'),
        'color' => "black",
        'number_of_passengers' => $faker->vehicleSeatCount
    ];
});
