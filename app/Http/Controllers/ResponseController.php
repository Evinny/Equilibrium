<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habit;
use Illuminate\Support\Facades\Auth;
use App\Models\Response;
use App\Models\User;



class ResponseController extends Controller
{
    //

    public function input_form(){


        $user = User::find(auth::user()->id);   
        
        $input = Response::find(1);
        return view('Dashboard.input_form', ['user' => $user, 'input' => $input]);
    }

    public function response_store(request $request){
        Response::create([
            'data_hora' => $request->data,
            'habito_id' => $request->habito,
            'sentimento_id' => $request->sentimento,
            'user_id' => auth::user()->id
        ]);
    }




    public function habitos_debug(request $request){
        Habit::create([
            'nome' => $request->nome,
            'categoria' => $request->categoria
        ]);
        return view('habitos_insert');
    }
}
