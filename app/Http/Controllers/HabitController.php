<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_emotion;
use App\Models\User_habit;
use App\Models\Habit;
use App\Models\Emotion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HabitController extends Controller
{

    public function habitsByCategory($params){
        
        $_user = auth::user();
        $table_ids = Habit::all()
            ->pluck('category', 'name');
       
        $types = [];
        $data = [];
        $habit_name = [];
        
        
        foreach($table_ids as $name => $category)
        { 
                    $types += [$name => $category]; 
        }

    
        $all_types = array_unique($types); //outputs only the types, with no repeated entryes
        
        foreach ($all_types as $category)
        { //for each good, bad and neutral
            foreach ($types as $name => $nested_category)
            { //[foreign id => bad or neutral or good]
                if($nested_category == $category)
                { //if loop category is equal to one in all category entryes
                    array_push($habit_name, $name);
                }
        }
        $data += [$category => $habit_name]; //this returns us all 3 types, and how many times they have been done
        $habit_name = [];
    }
    return $data;
}


    public function user_habit_setup(request $request){
        

        //fallback to dont polute the database
        // if(!(auth::user()->is_first_time))
        // {
        //     return redirect()->route('dashboard.index');
        // }



        $habits = $request->all();
        unset($habits['_token']);
        if($habits == []){
            return redirect()->route('dashboard.index', 
                    ['validate', "Escolha 5 Habitos de cada categoria"]);
        }

        
        $formatted_categories = $this->habitsByCategory($habits);



        $habit_categories = [];
        
        foreach($habits as $category => $name)
        {
            
            $habit_categories += [
                substr($category,0, strpos($category, '_')) => 1
            ];
        }
        
        
        
        $habits_temp_array = [];        
        $habits_insert = [];
        
        foreach($habit_categories as $category => $null)
        {            
            foreach($habits as $nested_categories => $habit)
            {
                if($category == substr($nested_categories, 0, strpos($nested_categories, '_')))
                {
                    array_push($habits_temp_array, $habit);
                }               
            }
            $habits_insert += [$category => $habits_temp_array];
            $habits_temp_array = []; 
        }



        foreach($habits_insert as $category => $values)
        {
            $amount = count($values);
            
            if ($amount > 5 || $habits == [] || $amount < 5)
            {
                return redirect()->route('dashboard.index', 
                    ['validate', "Escolha apenas 5 de cada, '$category' possui '$amount' habitos"]);
            }
        }
        
        

        $user_id = auth::id();
        $habit_id = 0;
        
        foreach($habits_insert as $category => $habits)
        {
            foreach($habits as $habit)
            {
                $habit_id = Habit::where('name', $habit)
                    ->get()
                    ->pluck('id');

                User_habit::create([
                    'user_id' => $user_id,
                    'habit_id' => $habit_id[0]
                ]);

                $habit_id = 0;
            }
        }
        
 


        $emotions = Emotion::all()
            ->pluck('emotion');
        
        foreach($emotions as $key => $emotion)
        {
            $emotion_id = Emotion::where('emotion', $emotion)
                ->get()
                ->pluck('id');
            
            User_emotion::create([
                'user_id' => $user_id,
                'emotion_id' => $emotion_id[0]
            ]);
        }
        


        $edit_user = User::find($user_id);
        
        $edit_user->is_first_time = 0;
        
        $edit_user->save();
             
    }
            
        
}
