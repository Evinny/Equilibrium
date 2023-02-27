<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Response;
use App\Models\User;
use App\Models\Emotion;
use App\Models\Habit;
use Carbon\Carbon;


class ResponseController extends Controller
{
    //

    public function input_form(){

        
        $user = User::find(auth::user()->id);   
        $date = Carbon::now();
        $habits = $user->habits;
        $emotions = Emotion::all();
        return view('Dashboard.input_form', ['user' => $user, 'habits' => $habits, 'emotions' => $emotions, 'date' => $date]);
    }

    public function response_store(request $request){
        
        if( !(User::find(auth::id()))){
            return redirect(url()->previous())->with('error', 'oops, houve um probleminha, tente novamente.');

        }

        $habit = Habit::where('name', '=', $request->habit)->get()->first();
        $emotion = emotion::where('emotion', '=', $request->emotion)->get()->first();
        
        
        Response::create([
            'date_time' => $request->data,
            'habit_id' => $habit->id,
            'emotion_id' => $emotion->id,
            'user_id' => auth::id()
        ]);

        return redirect()->route('dashboard.index');

    }




    public function habitos_debug(request $request){
        Habit::create([
            'nome' => $request->nome,
            'categoria' => $request->categoria
        ]);
        return view('habitos_insert');
    }
}
