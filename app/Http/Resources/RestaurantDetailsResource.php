<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description ?? '',
            'main_image' => $this->main_image ?? '',
            'images' => $this->images ?? [],
            'delivery_fee' => $this->delivery_fee ?? 0,
            'delivery_time' => $this->delivery_time ?? 0,
            'is_active' => $this->is_active,
            'is_available' => $this->is_available,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'categories' => $this->categories,
            'rate' => $this->averageRate(),
        ];
    }
}
