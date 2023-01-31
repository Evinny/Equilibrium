<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habito;
use Illuminate\Support\Facades\Auth;
use App\Models\Input;
use App\Models\User;



class InputController extends Controller
{
    //

    public function input_form(){


        $user = User::find(auth::user()->id)->with(['input' => ['habito']])->get();   
        
        $input = Input::find(1);
        return view('Dashboard.input_form', ['user' => $user, 'input' => $input]);
    }

    public function habitos_debug(request $request){
        Habito::create([
            'nome' => $request->nome,
            'categoria' => $request->categoria
        ]);
        return view('habitos_insert');
    }
}
