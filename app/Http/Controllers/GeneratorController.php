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
        switch ($goal) {
            case "strength":
                $sets = "5-8";
                $reps = "1-6";
                break;
            case "endurance":
                $sets = "3";
                $reps = "15-25";
                break;
            case "definition":
                $sets = "4";
                $reps = "8-12";
                break;
            default:
                $sets = "3";
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
            $chestExercises = [];
            $backExercises = [];
            $legsExercises = [];
            $lowerLegsExercises = [];
            $bicepsExercises = [];
            $tricepsExercises = [];
            $shouldersExercises = [];
            $forearmsExercises = [];
            $absExercises = [];
            #$Exercises = [];
            function getExercises($muscle, $preference) {           
                $exercises = DB::table('exercises')
                            ->where('exercise_type', $preference)
                            ->where('muscle_group', $muscle)
                            ->lists('exercise_name');
                return $exercises;
            };
            foreach ($preferences as $preference) {
                $chestExercises = array_merge($chestExercises, getExercises('chest', $preference));
                $backExercises = array_merge($backExercises, getExercises('back', $preference));
                $legsExercises = array_merge($legsExercises, getExercises('legs', $preference));
                $lowerLegsExercises = array_merge($lowerLegsExercises, getExercises('lowerLegs', $preference));
                $bicepsExercises = array_merge($bicepsExercises, getExercises('biceps', $preference));
                $tricepsExercises = array_merge($tricepsExercises, getExercises('triceps', $preference));
                $shouldersExercises = array_merge($shouldersExercises, getExercises('shoulders', $preference));
                $forearmsExercises = array_merge($forearmsExercises, getExercises('forearms', $preference));
                $absExercises = array_merge($absExercises, getExercises('abs', $preference));
            };
        };
        $cardio = DB::table('exercises')
                        ->where('exercise_type', 'cardio')
                        ->lists('exercise_name');
        $years = intval(Request::get('years'));
        $months = intval(Request::get('months'));
        $frequency = intval(Request::get('frequency'));
        $total = ($years * 12) + $months;
        switch ($total) {
            case ($total >= 24):
                $experience = "Advanced";
                break;
            case ($total > 6):
                $experience = "Intermediate";
                break;
            default:
                $experience = "Beginner";
                $largeMuscleExercises = 1;
                $smallMuscleExercises = 1;
                $headers = ["Full Body Day"];
        };
        function fullBodyDay () {

        };
        function upperBodyDay () {

        };
        function lowerBodyDay () {

        };
        function chestDay ($frequency, $largeMuscleExercises, $smallMuscleExercises) {

        };
        function backDay () {

        };
        function legDay () {

        };
        function armDay () {

        };
        function createWorkout () {

        }
        $listsOfExercises = [
            $chestExercises,
            $backExercises,
            $legsExercises,
            $lowerLegsExercises,
            $bicepsExercises,
            $tricepsExercises,
            $shouldersExercises,
            $forearmsExercises,
            $absExercises,
            $cardio
        ];
        for ($i = 0; $i < count($listsOfExercises); $i++) {
            shuffle($listsOfExercises[$i]);
        };
        for ($i = 0; $i < 3; $i++) {
            $listsOfExercises[$i] = array_slice($listsOfExercises[$i], 0, $largeMuscleExercises);
        };
        for ($i = 3; $i < count($listsOfExercises); $i++) {
            $listsOfExercises[$i] = array_slice($listsOfExercises[$i], 0, $smallMuscleExercises);
        };
        return view('generator/workout', [
            'goal' => ucfirst($goal),
            'preferences' => implode(', ', $preferences),
            'experience' => $experience,
            'frequency' => $frequency,
            'listsOfExercises' => $listsOfExercises,
            'headers' => $headers
            ]);
    }
}