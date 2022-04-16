<?php

use App\House;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // this snippet will be used to fill the table with fake data
        // factory(App\House::class, 100)->create();

        // predefined data seeder
        House::create([
            "area" => 160,
            "number_of_rooms" => 4,
            "number_of_bath_rooms" => 3,
            "has_internet" => true,
            "has_parking" => true
        ]);
        House::create([
            "area" => 160,
            "number_of_rooms" => 4,
            "number_of_bath_rooms" => 3,
            "has_internet" => true,
            "has_parking" => true
        ]);
        House::create([
            "area" => 160,
            "number_of_rooms" => 4,
            "number_of_bath_rooms" => 3,
            "has_internet" => true,
            "has_parking" => true
        ]);
    }
}
