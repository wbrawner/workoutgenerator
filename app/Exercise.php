<?php

namespace WorkoutGenerator;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
    	'exercise_name',
    	'muscle_group',
    	'exercise_type'
    ];
}
