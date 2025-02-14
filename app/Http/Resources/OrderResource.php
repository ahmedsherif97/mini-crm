<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'delivery_address' => [
                'name' => $this->address->name,
                'city' => $this->address->city,
                'details' => $this->address->address,
                'phone' => $this->address->phone,
            ],
            'items' => $this->meals->map(function ($orderMeal) {
                return [
                    'meal_name' => $orderMeal->meal->name,
                    'quantity' => $orderMeal->quantity,
                    'meal_price' => $orderMeal->meal_price,
                    'features' => $orderMeal->features->map(function ($feature) {
                        return [
                            'feature_name' => $feature->feature->name,
                            'quantity' => $feature->quantity,
                            'price' => $feature->price,
                            'type' => $feature->feature->type
                        ];
                    }),
                ];
            }),
            'subtotal' => $this->subtotal,
            'discount' => $this->discount ?? 0,
            'delivery_fee' => $this->delivery_fee,
            'vat' => $this->vat,
            'total' => $this->total,
        ];
    }
}
