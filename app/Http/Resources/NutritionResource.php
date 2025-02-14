<?php

namespace App\Http\Resources;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NutritionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $unit = Unit::query()->find($this->pivot->unit_id)->name ?? '';
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'amount' => $this->pivot->amount ?? null,
            'unit' => $unit,
        ];
    }
}
