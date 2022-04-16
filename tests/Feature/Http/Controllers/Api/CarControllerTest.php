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
     * this testFunction will test the API of car store
     */

    public function car_can_be_created()
    {
        $faker = Factory::create();
        
        // imported this package to fill the fake car record
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        
        $response = $this->json('POST', 'api/cars', [
            'type'  =>  $type = $faker->vehicleType,
            'model' =>  $model = $faker->vehicleModel,
            'year'  =>  $year = $faker->biasedNumberBetween(1990,2022, 'sqrt'),
            'color' => "black",
            'number_of_passengers' => $passengers = $faker->vehicleSeatCount
        ]);

        $response->assertStatus(201)->assertJsonStructure([
            'type', 'model', 'year', 'color', 'number_of_passengers'
        ]);

        $this->assertDatabaseHas('cars', [
            'type'  => $type,
            'model' => $model,
            'year'  => $year,
            'color' => "black",
            'number_of_passengers' => $passengers
        ]);
    }

    /**
     * @test
     * this testFunction will test the API of carsList
     */
    public function get_all_cars()
    {
        $this->withoutExceptionHandling();
        // providing the records by factory
        $car1 = $this->create('Car');
        $car2 = $this->create('Car');
        $car3 = $this->create('Car');
        
        // hitting the route to get the cars collection
        $response = $this->json('GET', 'api/cars');

        // verifying the response
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['type','model','year','color','number_of_passengers']
                ]
            ]);
        
        // logging the response in case of any data lack
        //Log::info("carsList", [$response->getContent()]);
    }

    /**
     * @test
     * this testFunction will test the API of carNotFound
     */
    public function will_fail_with_404_if_car_not_found()
    {
        $response = $this->json('GET', "api/cars/-1");
        
        $response->assertStatus(404);
    }

    /**
     * @test
     * this testFunction will test the API of carUpdate
     */
    public function can_update_car()
    {
        $this->withoutExceptionHandling();
        
        $car = $this->create('Car');
        
        $response = $this->json('PUT', "api/cars/$car->id",[
            'type'  => $car->type."_updated",
            'model' => $car->model,
            'year'  => $car->year,
            'color' => $car->color,
            'number_of_passengers' => $car->number_of_passengers
        ]);
        
        $response->assertStatus(200)->assertExactJson([
            'type'  => $car->type."_updated",
            'model' => $car->model,
            'year'  => $car->year,
            'color' => $car->color,
            'number_of_passengers' => $car->number_of_passengers
        ]);
        
        $this->assertDatabaseHas('cars',[
            'type'  => $car->type."_updated",
            'model' => $car->model,
            'year'  => $car->year,
            'color' => $car->color,
            'number_of_passengers' => $car->number_of_passengers
        ]);
    }

    /**
     * @test
     * this testFunction will test the API of car not found if want to delete
     */
    public function will_fail_with_404_if_car_for_delete_not_found()
    {
        $response = $this->json('DELETE', 'api/cars/-1');
        
        $response->assertStatus(404)->assertSee(null);
    }

    /**
     * @test
     * this testFunction will test the API of car delete
     */
    public function car_can_be_deleted()
    {
        $car = $this->create('Car');

        $response = $this->json('DELETE', "api/cars/$car->id");

        $response->assertStatus(204)->assertSee(null);

        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }

}


