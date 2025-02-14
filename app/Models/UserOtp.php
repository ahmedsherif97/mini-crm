<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOtp extends Model
{
    protected $fillable = [
        'email', 'otp_code', 'verified_at', 'user_id'
    ];

    public $timestamps = true;
}