<?php

namespace WorkoutGenerator\Http\Controllers;

use Request;
use WorkoutGenerator\Http\Requests;
use WorkoutGenerator\Http\Controllers\Controller;
use WorkoutGenerator\Exercise;
use DB;

class GeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('generator/generate');
    }

    public function generate()
    {
        $input = Request::all();
        $goal = Request::get('goal');
        $sets = 0;
        $reps = "";
        switch ($goal) {
            case "strength":
                $sets = 8;
                $reps = "1-6";
                break;
            case "endurance":
                $sets = 3;
                $reps = "15-25";
                break;
            case "definition":
                $sets = 4;
                $reps = "8-12";
                break;
            default:
                $sets = 3;
                $reps = "10";
        };
        $preferences = [
            Request::get('free_weights'),
            Request::get('dumbbells'),
            Request::get('barbells'),
            Request::get('selectorized'),
            Request::get('cables'), 
            Request::get('calisthenics')
        ];
        if (isset($preferences)) {
            foreach (array_keys($preferences, '') as $key) {
                unset($preferences[$key]);
            };
            $chest_exercises = [];
            $back_exercises = [];
            $legs_exercises = [];
            $lower_legs_exercises = [];
            $biceps_exercises = [];
            $triceps_exercises = [];
            $shoulders_exercises = [];
            $forearms_exercises = [];
            $abs_exercises = [];
            #$_exercises = [];
            function getExercises($muscle, $preference) {           
                $exercises = DB::table('exercises')
                            ->where('exercise_type', $preference)
                            ->where('muscle_group', $muscle)
                            ->lists('exercise_name');
                return $exercises;
            };
            foreach ($preferences as $preference) {
                $chest_exercises = array_merge($chest_exercises, getExercises('chest', $preference));
                $back_exercises = array_merge($back_exercises, getExercises('back', $preference));
                $legs_exercises = array_merge($legs_exercises, getExercises('legs', $preference));
                $lower_legs_exercises = array_merge($lower_legs_exercises, getExercises('lower_legs', $preference));
                $biceps_exercises = array_merge($biceps_exercises, getExercises('biceps', $preference));
                $triceps_exercises = array_merge($triceps_exercises, getExercises('triceps', $preference));
                $shoulders_exercises = array_merge($shoulders_exercises, getExercises('shoulders', $preference));
                $forearms_exercises = array_merge($forearms_exercises, getExercises('forearms', $preference));
                $abs_exercises = array_merge($abs_exercises, getExercises('abs', $preference));
            };
        };
        $years = intval(Request::get('years'));
        $months = intval(Request::get('months'));
        $total = ($years * 12) + $months;
        $experience = 0;
        switch ($total) {
            case ($total >= 24):
                $experience = 3;
                break;
            case ($total > 6):
                $experience = 2;
                break;
            default:
                $experience = 1;
        };
        $frequency = intval(Request::get('frequency'));
        $large_muscle = 3;
        $small_muscle = 2;
        return view('generator/workout', [
            'goal' => $goal,
            'preferences' => implode(', ', $preferences),
            'experience' => $experience,
            'frequency' => $frequency,
            'chest_exercises' => array_slice($chest_exercises, 0, $large_muscle),
            'back_exercises' => array_slice($back_exercises, 0, $large_muscle),
            'legs_exercises' => array_slice($legs_exercises, 0, $large_muscle),
            'lower_legs_exercises' => array_slice($lower_legs_exercises, 0, $small_muscle),
            'biceps_exercises' => array_slice($biceps_exercises, 0, $small_muscle),
            'triceps_exercises' => array_slice($triceps_exercises, 0, $small_muscle),
            'shoulders_exercises' => array_slice($shoulders_exercises, 0, $small_muscle),
            'forearms_exercises' => array_slice($forearms_exercises, 0, $small_muscle),
            'abs_exercises' => array_slice($abs_exercises, 0, $small_muscle)
            ]);
    }
}