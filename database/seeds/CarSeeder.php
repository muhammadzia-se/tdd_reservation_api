<?php

use App\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // this snippet will be used to fill the table with fake data
        // factory(App\Car::class, 100)->create();

        // predefined data seeder
        Car::create([
            "type" => "Sedan",
            "model" => "Bmw 530e",
            "year" => "2021",
            "color" => "red",
            "number_of_passengers" => 5
        ]);

        Car::create([
            "type" => "Sedan",
            "model" => "Mercedes e200",
            "year" => "2021",
            "color" => "black",
            "number_of_passengers" => 5
        ]);
        Car::create([
            "type" => "Sport",
            "model" => "Ford Mustang",
            "year" => "2017",
            "color" => "white",
            "number_of_passengers" => 2
        ]);
    }
}
