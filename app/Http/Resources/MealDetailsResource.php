<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealDetailsResource extends JsonResource
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
            'description' => $this->description,
            'price' => $this->price,
            'main_image' => $this->main_image,
            'nutrition' => NutritionResource::collection($this->nutrition),
            'sizes' => FeatureResource::collection($this->sizes),
            'extras' => FeatureResource::collection($this->extras),
        ];
    }
}
