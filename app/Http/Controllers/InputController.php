<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habito;
use Illuminate\Support\Facades\Auth;
use App\Models\Input;



class InputController extends Controller
{
    //

    public function input_form(){


        $user = auth::user();
        $data = Input::find(1);
        return view('Dashboard.input_form', ['user' => $user, 'data' => $data]);
    }

    public function habitos_debug(request $request){
        Habito::create([
            'nome' => $request->nome,
            'categoria' => $request->categoria
        ]);
        return view('habitos_insert');
    }
}
