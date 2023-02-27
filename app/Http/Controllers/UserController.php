<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use storage\framework\sessions;




use App\Models\User;

class UserController extends Controller
{
    public function cadastro(request $request){

        $reason=[
            'name' => 'min:5|max:80',
            'email' => 'email|unique:users',
            'telefone' => 'min:14|max:40',
            'password' => 'min:6|max:40',
            'hotmart_id' => 'required|unique:users'

        ];

        $motive=[
            'name.min' => 'Nome precisa de no minimo 5 Letras',
            'name.max' => 'Nome exige no maximo 80 letras',
            'email.email' => 'E-mail invalido',
            'email.unique' => 'E-mail ja esta em uso',
            'telefone.min' => 'telefone invalido',
            'telefone.max' => 'danado de numero é esse?',
            'password.min' => 'Senha precisa de no minimo 6 Letras',
            'password.max' => 'Senha exige no maximo 40 Letras',
            'hotmart_id.required' => 'O ID da Hotmart é Obrigatorio',
            'hotmart_id.unique' => 'O ID da Hotmart ja está em uso',
        ];

        $request->validate($reason, $motive);
        
        if($request->password != $request->password_confirmation){
            return view('cadastro_form')->with('error', '⚠️ As senhas devem ser iguais');
        };

        $user_insert = User::create([
            'name' => $request->name,
            'password' => hash::make($request->password),
            'telefone' => $request->telefone,
            'email' => $request->email,
            'hotmart_id' => $request->hotmart_id,
            
        ]);

        return redirect()->route('home');
    }

    public function auth(request $request){

        $motive = [
            'usuario' => 'required',

            'password' => 'required|min:6|max:40'
        ];

        $reason = [
            'usuario.required' => 'Usuario está em branco',
            'passowrd.required' => 'senha está em branco',
            'password.min' => 'A senha precisa de no minimo 6 caracteres',
            'password.max' => 'A senha precisa de no maximo 40 caracteres',
            
        ];

        $request->validate($motive, $reason);

        $credentials = [
            'email' => $request->usuario,
            'password' => $request->password,
        ];

        if(auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return view('login_form')->with('error', '⚠️ E-mail ou Senha incorretos');
    }

    public function logout(request $request){
        
        auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        return redirect('/');
    }


    
}
