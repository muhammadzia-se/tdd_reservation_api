<?php

namespace Tests\Feature\Http\Controllers\Api;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseReservationControllerTest extends TestCase
{
    //use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @test
     */
    public function house_can_be_reserved(){
        $this->withoutExceptionHandling();
        $faker = Factory::create();
        
        $response = $this->json('POST', "api/house/reserve", [
            'reserver' => $rserver =  $faker->name,
            'area'  => $area = mt_rand(1,250),
            'number_of_rooms' =>  $rooms = random_int(1,4),
            'number_of_bath_rooms'  => random_int(1,4),
            'has_internet' => random_int(0,1),
            'has_parking' => random_int(0,1),
            'reservation' => true
        ]);

        Log::info('reservation', [$response->getContent()]);

        $response->assertStatus(201)->assertJsonStructure([
            'reserver', 'area', 'number_of_rooms', 'number_of_bath_rooms', 'has_internet', 'has_parking', 'reservation'
        ]);

        $this->assertDatabaseHas('house_reservations', [
            'reserver' => $rserver,
            'area'  => $area,
            'number_of_rooms' =>  $rooms
        ]);

    }
    
}
