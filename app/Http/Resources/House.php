<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class House extends JsonResource
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
            'area'  => $this->area,
            'number_of_rooms' => $this->number_of_rooms,
            'number_of_bath_rooms'  => $this->number_of_bath_rooms,
            'has_internet' => $this->has_internet,
            'has_parking' => $this->has_parking
        ];
    }
}
