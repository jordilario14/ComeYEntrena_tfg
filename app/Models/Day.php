<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function training_plan()
    {
        return $this->belongsTo(Training_plan::class);
    }

    public function day_exercises()
    {
        return $this->hasMany(Day_exercise::class);
    }
    use HasFactory;
}
