<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{

    protected $fillable = ['name', 'email', 'phone', 'address', 'created_by'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'customer_employee', 'customer_id', 'employee_id');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(CustomerAction::class);
    }
}
