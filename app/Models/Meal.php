<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    public function nutritional_plan()
    {
        return $this->belongsTo(Nutritional_plan::class);
    }

    public function meal_aliments()
    {
        return $this->hasMany(Meal_aliment::class);
    }
    use HasFactory;
}
