<?php

namespace Tests\Feature\Http\Controllers\Api;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseControllerTest extends TestCase
{
    //use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @test
     * this testFunction will test the API of House store
     */

    public function house_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->json('POST', 'api/houses', [
            'area'  => $area = mt_rand(1,250),
            'number_of_rooms' => $rooms = random_int(1,4),
            'number_of_bath_rooms' => $bathRooms = random_int(1,4),
            'has_internet' => $internet = random_int(0,1),
            'has_parking' => $parking = random_int(0,1)
        ]);

        $response->assertStatus(201)->assertJsonStructure([
            'area', 'number_of_rooms', 'number_of_bath_rooms', 'has_internet', 'has_parking'
        ]);

        $this->assertDatabaseHas('houses', [
            'area'  => $area,
            'number_of_rooms' => $rooms,
            'number_of_bath_rooms' => $bathRooms,
            'has_internet' => $internet,
            'has_parking' => $parking
        ]);
    }

    /**
     * @test
     * this testFunction will test the API of houseList
     */
    public function get_all_house()
    {
        $this->withoutExceptionHandling();
        // providing the records by factory
        $house1 = $this->create('House');
        $house2 = $this->create('House');
        $house3 = $this->create('House');
        
        // hitting the route to get the cars collection
        $response = $this->json('GET', 'api/houses');

        // verifying the response
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['area','number_of_rooms','number_of_bath_rooms','has_internet','has_parking']
                ]
            ]);
        
        // logging the response in case of any data lack
        //Log::info("carsList", [$response->getContent()]);
    }

    /**
     * @test
     * this testFunction will test the API of houseNotFound
     */
    public function will_fail_with_404_if_house_not_found()
    {
        $response = $this->json('GET', "api/houses/-1");
        
        $response->assertStatus(404);
    }

    /**
     * @test
     * this testFunction will test the API of houseUpdate
     */
    public function can_update_house()
    {
        $this->withoutExceptionHandling();
        
        $house = $this->create('House');
        
        $response = $this->json('PUT', "api/houses/$house->id",[
            'area'  => $house->area,
            'number_of_rooms' => $house->number_of_rooms,
            'number_of_bath_rooms'  => $house->number_of_bath_rooms,
            'has_internet' => $house->has_internet,
            'has_parking' => $house->has_parking
        ]);
        
        $response->assertStatus(200)->assertExactJson([
            'area'  => $house->area,
            'number_of_rooms' => $house->number_of_rooms,
            'number_of_bath_rooms'  => $house->number_of_bath_rooms,
            'has_internet' => $house->has_internet,
            'has_parking' => $house->has_parking
        ]);
        
        $this->assertDatabaseHas('houses',[
            'area'  => $house->area,
            'number_of_rooms' => $house->number_of_rooms,
            'number_of_bath_rooms'  => $house->number_of_bath_rooms,
            'has_internet' => $house->has_internet,
            'has_parking' => $house->has_parking
        ]);
    }

    /**
     * @test
     * this testFunction will test the API of house not found if want to delete
     */
    public function will_fail_with_404_if_house_for_delete_not_found()
    {
        $response = $this->json('DELETE', 'api/houses/-1');
        
        $response->assertStatus(404)->assertSee(null);
    }

    /**
     * @test
     * this testFunction will test the API of house delete
     */
    public function car_can_be_deleted()
    {
        $car = $this->create('House');

        $response = $this->json('DELETE', "api/houses/$car->id");

        $response->assertStatus(204)->assertSee(null);

        $this->assertDatabaseMissing('houses', ['id' => $car->id]);
    }

}


