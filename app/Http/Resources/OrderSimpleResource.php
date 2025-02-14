<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderSimpleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'restaurant_name' => $this->meals->first()->meal->restaurant->name ?? '',
            'status' => $this->status,
            'date' => $this->created_at->format('d M, Y | h:i A'),
            'image' => $this->meals->first()->meal->restaurant->main_image ?? '',
        ];
    }
}
