<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Response;
use App\Models\User;
use App\Models\Emotion;
use App\Models\Habit;
use Carbon\Carbon;

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

            //------HABIT categoryes------/


                elseif($request->pag == 3){

                    $habits_ids = Habit::all()->pluck('category', 'id');
                    $types = [];
                    $data = [];

                    
                    
                    foreach($habits_ids as $id => $category){ //[2 => bad]


                        foreach($_user->responses as $response){ //response


                            if($response->habit_id == $id){ //if foreign habit_id is equal to the habid id on loop

                                $types += [$response->id => $category]; //add to types [foreign id => bad]
                                
                            }
                           
                            
                        }
                    
                    }
                
                $all_types = array_unique($types); //outputs only the types, with no repeated entryes
                
                foreach ($all_types as $category){ //for each good, bad and neutral
                    
                    
                    foreach ($types as $habit_id => $all_category){ //[foreign id => bad or neutral or good]
                        if($all_category == $category){ //if loop category is equal to one in all category entryes
                            $times++; //count +1-------------------this is to count how many times only one type ocurred
                            
                        }
                    }

                    $data += [$category => $times]; //this returns us all 3 types, and how many times they have been done
                    $times = 0;
                }
                $color = "colors: [";
                arsort($data);//sorts higher to lower
                foreach($data as $category => $times){
                    if(strtolower($category) == 'ruim'){
                        $color .= "'#e62e00',";
                    }

                    if(strtolower($category) == 'bom'){
                        $color .= "'#0055ff',";
                    }

                    if(strtolower($category) == 'neutro'){
                        $color .= "'#d8d10e',";
                    }
                }
                $color .= ']';
            }
            //colors

            
            arsort($data);//sorts higher to lower
      



            $days_of_week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Sunday'];
            //['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo']



            $habits_ids = User::find(auth::id())->with('habits')->get()->first();
            dd($habits_ids->habits);
            $data = [];
            $types= [];

            $test = Response::find(1);
            $day = Carbon::parse($test->date_time)->format('l');
           //WORKSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
 
            foreach($days_of_week as $day){


                foreach($habits_ids as $id => $category){ //[2 => bad]


                        foreach($_user->responses as $response){ //response


                            if($response->habit_id == $id){ //if foreign habit_id is equal to the habid id on loop

                                $types += [$response->id => $category]; //add to types [foreign id => bad]
                                
                            }
                           
                            
                        }
                    
                    }
                }


             //SAYS THE DAYT OF THE WEEEEKKEKEKEKEK

            if(isset($color)){
                return view('Dashboard.dashboard_index', ['data' => $data, 'color' => $color]);

            }
            else{
                return view('Dashboard.dashboard_index', ['data' => $data]);
            }
            
            




            
        
    }
}
