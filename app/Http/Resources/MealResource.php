<?php

namespace App\Http\Resources;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = Meal::query()->find($this->id)->name;
        return [
            'id' => $this->id,
            'name' => $name,
            'description' => $this->description,
            'price' => $this->price,
            'main_image' => $this->main_image,
            'nutrition' => NutritionResource::collection($this->nutrition)
        ];
    }
}
