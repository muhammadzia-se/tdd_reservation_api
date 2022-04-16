<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Http\Resources\Car as CarResource;
use App\Http\Resources\CarCollection as CarCollectionResource;
use App\Http\Resources\House as HouseResource;
use App\Http\Resources\HouseCollection as HouseCollectionResource;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function create(string $model, array $attributes = [])
    {
        $product = factory("App\\$model")->create($attributes);
        if ($model === "Car") return new CarResource($product);
        if ($model === "CarCollection") return new CarCollectionResource($product);
        if ($model === "House") return new HouseResource($product);
        if ($model === "HouseCollection") return new HouseCollectionResource($product);
    }


}
