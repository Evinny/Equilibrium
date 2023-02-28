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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function ResponsesPlucker($_user, $columnName){

    $habits_ids = $_user->habits->pluck($columnName, 'id'); 
    $types = [];

    foreach($habits_ids as $id => $column){ 
        foreach($_user->responses as $response){ 
            if($response->habit_id == $id){ 
                $types += [$response->id => $column]; 
    }}}

    $all_types = array_unique($types);
    
    return ['categories' => $all_types, 'idToCategory' => $types];
    }
//returns: the $_users responses id => the column on the responses table
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function habits_amounts(){
        
        $_user = auth::user();
        $table_ids = $_user->habits;
        
        $types = [];
        $data = [];
        $habit_name = [];
        
        foreach($table_ids as $name => $category){ 
            $types += [$name => $category];     
        }

        $all_types = array_unique($types); 

        foreach ($all_types as $category){ 
            foreach ($types as $name => $nested_category){ 
                if($nested_category == $category){
                    array_push($habit_name, $name);
            }}

            $data += [$category => $habit_name]; //this returns us all 3 types, and how many times they have been done
            $habit_name = [];
        }
        return $data;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//require: an array as a "id" => "name", and a user
    public function simpleTableFilter($table, $user){

        if($table == 'habits'){
            $table_ids = $user->habits->pluck('name', 'id');
        }
        elseif($table == 'emotions'){
            $table_ids = $user->emotions->pluck('emotion', 'id');
        }

        $data=[];
        $times = 0;

        foreach($table_ids as $id => $name){
            if($table == 'habits'){
                foreach($user->responses as $response){
                        if($id == $response->habit_id){
                        $times++;
            }}}
            
            if($table == 'emotions'){
                foreach($user->responses as $response){
                    if($id == $response->emotion_id){
                        $times++;
            }}}
            $data += [$name=>$times];
            $times= 0;      
        }
        return $data;
    }
//Returns: arr['$habit name => times that user did that habit']
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index(request $request){
        
        $_user = auth::user();
        $nested_array = false;
        
        //FALLBACK
        if($_user->is_first_time){
            $emotions = Emotion::all();
            return view('Dashboard.habits_setup', [
                'user' => Auth::user(), 
                'habits' => $this->habits_amounts(),
                'emotions' => $emotions
            ]);
        }
        //FALLBACK
        if($_user->responses->isempty() ){
            return view('Dashboard.dashboard_index');
        }
        //FALLBACK
        if(!(isset($request->pag))){
            $request->pag = 1;
        }
        
        $times = 0;
//=============================================================================================================//
                                         //------HABITS AMOUNT------//
        if($request->pag == 1){ 
            $data = $this->simpleTableFilter('habits', $_user);
            }
//=============================================================================================================//
                                         //------EMOTIONS FELT------//
            elseif($request->pag == 2){ 
                $data = $this->simpleTableFilter('emotions', $_user);
            }
//=============================================================================================================//
                                        //------HABIT CATEGORIES------//
            elseif($request->pag == 3){
    
                $categoriesArray = $this->ResponsesPlucker($_user, 'category');
                $data = [];
            
                foreach ($categoriesArray['categories'] as $category){ //for each good, bad and neutral
                    foreach ($categoriesArray['idToCategory'] as $habit_id => $all_category){ //[foreign id => bad or neutral or good]
                        if($all_category == $category){ //if loop category is equal to one in all category entryes
                            $times++; //count +1-------------------this is to count how many times only one type ocurred   
                    }}
                    $data += [$category => $times]; //this returns us all 3 types, and how many times they have been done
                    $times = 0;
                }

                $color = "colors: [";
                arsort($data);//sorts higher to lower
                foreach($data as $category => $times){
                    if($category == '☹️Ruins'){
                        $color .= "'#e62e00',";
                    }
                    if($category == '🙂Bons'){
                        $color .= "'#0055ff',";
                    }
                    if($category == '😐Neutros'){
                        $color .= "'#d8d10e',";
                        
                    }
                }
                $color .= ']';
            }
//=============================================================================================================//
                                          //------WEEKLY HABITS------//
            elseif($request->pag == 4){

                $days_of_week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Sunday', 'Saturday'];
                $days_of_week_translation = ['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'];

                $user = User::find(auth::id());
                $data = [];
                $tempData = [];
                $categoryAmounts= [];

                $data = $_user->responses->pluck('habit_id', 'date_time');

                foreach($data as $date => $habit_id){
                    $data[$date] = Habit::find($habit_id)->category;
                }

                $categoriesArray = $this->ResponsesPlucker($_user, 'category');

                foreach($categoriesArray['categories'] as $all_categories){
                    $categoryAmounts[$all_categories] = 0;
                }

                foreach($days_of_week as $day){
                    foreach($data as $date => $category){
                        if($day == Carbon::parse($date)->format('l')){
                            foreach($categoriesArray['categories'] as $all_categories){
                                if($category == $all_categories){                                 
                                    $categoryAmounts[$all_categories]++;
                    }}}}
                    
                    $tempData[$day] = $categoryAmounts;

                    foreach($categoriesArray['categories'] as $all_categories){
                        $categoryAmounts[$all_categories] = 0;
                }}

                // foreach($return as $day => $arr){
                //     //find the day position on array
                //     //put in its place the translated version
                // }
                $nested_array = true;
                $data = $tempData;
            }
//=============================================================================================================//
                                        //------RETURN STATEMENTS------//
            if(isset($color)){
                $return = ['data' => $data, 'color' => $color, 'isNested' => $nested_array];

            }
            else{
                $return = ['data' => $data, 'isNested' => $nested_array];
            }
            return view('Dashboard.dashboard_index', $return);
            

    }
}