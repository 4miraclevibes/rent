<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'day_rate',
        'monthly_rate',
        'image',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
