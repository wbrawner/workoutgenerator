<?php


namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use Illuminate\Http\Request;

class GeneratorController extends Controller
{
    public function showGenerator() {
        return view('generator');
    }
    
    public function getGoal() {
        $goal = $request->input('goal');
            return $goal;
    }

    public function getExperience() {
    }

    public function getFrequency() {
    }

    public function generateWorkout () {
        $goal = Goal();
        echo $goal;
    }
}
