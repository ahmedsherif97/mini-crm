<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    private mixed $coupon;

    public function __construct($resource, $coupon = null)
    {
        parent::__construct($resource);
        $this->coupon = $coupon;
    }

    public function toArray($request): array
    {
        $subtotal = 0;

        $meals = $this->meals->map(function ($cartMeal) use (&$subtotal) {
            $mealPrice = $cartMeal->meal->price;
            $features = [];
            $sizeFeature = $cartMeal->features->firstWhere('feature.type', 'size');
            if ($sizeFeature) {
                $mealPrice = $sizeFeature->feature->price;
                $features[] = [
                    'name' => $sizeFeature->feature->name,
                    'quantity' => $sizeFeature->quantity,
                    'price' => $mealPrice,
                    'type' => $sizeFeature->feature->type
                ];
            }
            foreach ($cartMeal->features as $feature) {
                if ($feature->feature->type === 'extra') {
                    $features[] = [
                        'name' => $feature->feature->name,
                        'quantity' => $feature->quantity,
                        'price' => $feature->feature->price * $feature->quantity,
                        'type' => $feature->feature->type
                    ];
                    $mealPrice += $feature->feature->price * $feature->quantity;
                }
            }

            $mealTotalPrice = $mealPrice * $cartMeal->quantity;
            $subtotal += $mealTotalPrice;

            return [
                'cart_meal_id' => $cartMeal->id,
                'meal_id' => $cartMeal->meal->id,
                'meal_name' => $cartMeal->meal->name,
                'quantity' => $cartMeal->quantity,
                'meal_price' => $mealPrice,
                'total_price' => $mealTotalPrice,
                'features' => $features,
            ];
        });

        $discount = $this->applyCouponDiscount($subtotal);
        $vat = ceil(($subtotal - $discount) * 0.14);
        $total = $subtotal - $discount + $vat;

        return [
            'meals' => $meals,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'vat' => $vat,
            'total' => $total,
        ];
    }

    private function applyCouponDiscount($subtotal)
    {
        if (!$this['coupon'] || count($this['meals']) == 0) {
            return 0;
        }

        if ($this['coupon']->type === 'percentage') {
            return ($subtotal * $this['coupon']->value) / 100;
        }

        return min($this['coupon']->value, $subtotal);
    }
}
