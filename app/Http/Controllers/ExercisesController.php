<?php

namespace WorkoutGenerator\Http\Controllers;

use Illuminate\Http\Request;

use WorkoutGenerator\Http\Requests;
use WorkoutGenerator\Http\Controllers\Controller;
use WorkoutGenerator\Exercise;

class ExercisesController extends Controller
{
    public function index() {
    	$exercises = Exercise::all();
    	return view('exercises.index')->with('exercises', $exercises);
    }

    public function create() {
    	return view('exercises.add');
    }
}
