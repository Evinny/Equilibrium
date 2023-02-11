<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HabitController extends Controller
{
    public function user_habit_setup(request $request){
        dd($request->all());
    }
}
