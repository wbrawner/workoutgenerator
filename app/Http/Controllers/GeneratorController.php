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
            global $chestExercises;
            global $backExercises;
            global $legsExercises;
            global $lowerLegsExercises;
            global $bicepsExercises;
            global $tricepsExercises;
            global $shouldersExercises;
            global $forearmsExercises;
            global $absExercises;
            $chestExercises = [];
            $backExercises = [];
            $legsExercises = [];
            $lowerLegsExercises = [];
            $bicepsExercises = [];
            $tricepsExercises = [];
            $shouldersExercises = [];
            $forearmsExercises = [];
            $absExercises = [];
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
        global $cardioExercises;
        $cardioExercises = DB::table('exercises')
                        ->where('exercise_type', 'cardio')
                        ->lists('exercise_name');
        function getExerciseLists($muscle, $numberOfExercises) {
            global ${"$muscle" . "Exercises"};
            $shuffled = ${"$muscle" . "Exercises"};
            shuffle($shuffled);
            return array_slice($shuffled, 0, $numberOfExercises);
        };
        function getDay($title, $largeMuscles, $largeMuscleExercises, $smallMuscles = [], $smallMuscleExercises = 0) {
            $listOfExercises = [];
            foreach ($largeMuscles as $largeMuscle) {
                $listOfExercises = array_merge($listOfExercises, getExerciseLists($largeMuscle, $largeMuscleExercises));
            };
            foreach ($smallMuscles as $smallMuscle) {
                $listOfExercises = array_merge($listOfExercises, getExerciseLists($smallMuscle, $smallMuscleExercises));
            };
            return ['name' => $title . ' Day',
                'exercises' => $listOfExercises
                ];
        };
        $years = intval(Request::get('years'));
        $months = intval(Request::get('months'));
        $frequency = intval(Request::get('frequency'));
        $total = ($years * 12) + $months;
        switch ($total) {
            case ($total >= 24):
                $experience = "Advanced";
                global $days;
                $days = [];
                for ($i = 0; $i < $frequency; $i++) {
                    $days[] = getDay("Full Body", ["chest", "back", "legs"], 1, ["biceps", "triceps", "shoulders", "forearms", "lowerLegs", "abs"], 1);
                };
                break;
            case ($total > 6):
                $experience = "Intermediate";
                global $days;
                $days = [];
                $workout = intval($frequency / 2);
                $cardio = ($frequency % 2) * $workout;
                if ($frequency == 1) {
                    $days[] = getDay("Cardio Day", ["cardio"], 4);
                } else if ($frequency < 5) {
                    for ($i = 0; $i < $workout; $i++) {
                        $days[] = getDay("Upper Body Day", ["chest", "back"], 1, ["biceps", "triceps", "shoulders", "forearms"], 1);
                        $days[] = getDay("Lower Body Day", ["legs"], 2, ["lowerLegs", "abs"], 1);                        
                    }
                    for ($i = 0; $i < $cardio; $i++) {
                        $days[] = getDay("Cardio Day", ["cardio"], 4);
                    }
                } else {
                    for ($i = 0; $i < 2; $i++) {
                        $days[] = getDay("Upper Body Day", ["chest", "back"], 1, ["biceps", "triceps", "shoulders", "forearms"], 1);
                        $days[] = getDay("Lower Body Day", ["legs"], 2, ["lowerLegs", "abs"], 1); 
                    }
                    for ($i = 0; $i < ($frequency - 4); $i++) {
                        $days[] = getDay("Cardio Day", ["cardio"], 4);
                    }
                }
                break;
            default:
                global $days;
                $days = [];
                $experience = "Beginner";
                for ($i = 0; $i < $frequency; $i++) {
                    if ($i % 2 == 0) {
                        if (count($cardioExercises) > 0) {
                            $days[] = getDay("Cardio Day", ["cardio"], 4);
                        } else {
                            $days[] = getDay("Full Body", ["chest", "back", "legs"], 1, ["biceps", "triceps", "shoulders", "forearms", "lowerLegs", "abs"], 1);
                        }
                    } else {
                        $days[] = getDay("Full Body", ["chest", "back", "legs"], 1, ["biceps", "triceps", "shoulders", "forearms", "lowerLegs", "abs"], 1);
                    }
                };
        };
        return view('generator/workout', [
            'goal' => ucfirst($goal),
            'preferences' => implode(', ', $preferences),
            'experience' => $experience,
            'frequency' => $frequency,
            'days' => $days,
            'sets' => $sets,
            'reps' => $reps
            ]);
    }
}