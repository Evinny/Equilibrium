<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Response;
use App\Models\User;
use App\Models\Emotion;
use App\Models\Habit;


class DashboardController extends Controller
{
    public function index(){
        
        $_user = auth::user();
        
        if($_user->responses->isempty()){
            return view('Dashboard.dashboard_index');
        }

        $habits_ids = Habit::all()->pluck('name', 'id');
        $habits = [];
        $times = 0;


        foreach($habits_ids as $id => $name){
            foreach($_user->responses as $response){
                if($response->habit_id == $id){
                    $times++;
                }
            }
            $habits += [$name => $times];
            $times = 0;
        }

        arsort($habits);

        $emotions_ids = Emotion::all()->pluck('emotion', 'id');
        $emotions = [];
        

        foreach($emotions_ids as $id => $emotion){

            foreach($_user->responses as $response){

                if($response->emotion_id == $id){
                    $times++;
                }
            }

            $emotions += [$emotion => $times];
            $times = 0;
        }

        arsort($emotions);

   
        return view('Dashboard.dashboard_index', ['habits' => $habits, 'emotions' => $emotions]);
    }
}
