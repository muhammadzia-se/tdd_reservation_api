<?php

namespace Tests\Feature\Http\Controllers\Api;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CarControllerTest extends TestCase
{
    //use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @test
     */
    public function car_can_be_reserved(){
        $this->withoutExceptionHandling();
        
        $car = $this->create('CarReservation');
        $faker = Factory::create();
        
        // imported this package to fill the fake car record
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        
        $response = $this->json('POST', "api/car/reserve", [
            'reserver'  =>  $rserver = $faker->userName,
            'type'      =>  $type = $faker->vehicleType,
            'model'     =>  $model = $faker->vehicleModel,
            'color'     => "black",
            'reservation' => true
        ]);

        Log::info('reservation', [$response->getContent()]);

        $response->assertStatus(201)->assertJsonStructure([
            'reserver', 'type', 'model', 'color', 'reservation'
        ]);

        $this->assertDatabaseHas('car_reservations', [
            'reserver' => $rserver,
            'type'  => $type,
            'model' =>  $model
        ]);

    }

}


