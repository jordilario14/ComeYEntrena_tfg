<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day_exercise extends Model
{
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
    use HasFactory;
}
