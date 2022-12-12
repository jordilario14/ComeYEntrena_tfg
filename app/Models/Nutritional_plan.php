<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutritional_plan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
    use HasFactory;
}
