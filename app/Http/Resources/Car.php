<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Car extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => $this->type,
            "model" => $this->model,
            "year" => $this->year,
            "color" => $this->color,
            "number_of_passengers" => $this->number_of_passengers
        ];
    }
}
