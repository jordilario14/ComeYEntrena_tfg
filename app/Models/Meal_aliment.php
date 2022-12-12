<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal_aliment extends Model
{
    public function aliment()
    {
        return $this->belongsTo(Aliment::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
    use HasFactory;
}
