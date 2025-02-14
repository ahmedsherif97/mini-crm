<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'profile_image' => $this->profile_image,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'phone' => $this->phone,
            'phone_verified_at' => $this->phone_verified_at,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'height' => $this->height,
            'weight' => $this->weight,
            'age' => $this->age,
            'goal_id' => $this->goal->name,
            'activity_level_id' => $this->activity_level->name,
            'suspended_at' => $this->suspended_at,
            'calories' => $this->calories,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
