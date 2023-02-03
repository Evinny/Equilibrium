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
    public function index(request $request){
        
        $_user = auth::user();
        

        //first time user fallback
        if($_user->responses->isempty() ){
            return view('Dashboard.dashboard_index');
        }

        if(!(isset($request->pag))){
            $request->pag = 1;
        }
        
        $times = 0;

        //------HABITS AMOUNT------//
        if($request->pag == 1){ 
            //Returns: arr['$habit name => times that user did that habit']
            $habits_ids = Habit::all()->pluck('name', 'id');
            $data = [];

                foreach($habits_ids as $id => $name){
                    
                    foreach($_user->responses as $response){
                        
                        if($response->habit_id == $id){
                            $times++;
                        }
                    }
                    
                    $data += [$name => $times];
                    $times = 0;
                }
                
                
                //ends function
            }

            //------EMOTIONS FELT------//
            elseif($request->pag == 2){ 
                
                //Returns: arr['$emotion name => times that user felt that emotion']
                $emotions_ids = Emotion::all()->pluck('emotion', 'id');
                $data = [];
                
                foreach($emotions_ids as $id => $emotion){

                    foreach($_user->responses as $response){

                        if($response->emotion_id == $id){
                            $times++;
                        }
                    }

                    $data += [$emotion => $times];
                    $times = 0;
                }

                //ends function
            }

            //------WEEKLY HABITS------/



            $habits_ids = Habit::all()->pluck('category', 'id');
            $days = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom'];
            
            $category_values = [];

            foreach($days as $day){
                foreach($habits_ids as $id => $category){

                    foreach($_user->responses as $response){
                        if($response->habit_id == $id){ 
                            $category_values += [$category];
                        }
                        
                    }
                }
            }




            
            








            arsort($data);//sorts higher to lower
            
        return view('Dashboard.dashboard_index', ['data' => $data]);
    }
}
