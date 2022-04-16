<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\House;
use Faker\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(House::class, function (Faker $faker) {
    return [
        'area'  => mt_rand(1,250),
        'number_of_rooms' => random_int(1,4),
        'number_of_bath_rooms'  => random_int(1,4),
        'has_internet' => random_int(0,1),
        'has_parking' => random_int(0,1)
    ];
});
