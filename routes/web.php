<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ResponseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');



route::get('/cadastro', function(){
    return view('cadastro_form');
})->name('cadastro.form');

route::post('/cadastro', [UserController::class, 'cadastro'])->name('cadastro.store');


route::get('/login', function(){
    return view('login_form');
})->name('login.form');

route::post('login', [UserController::class, 'auth'])->name('login');

route::get('/logout', [UserController::class, 'logout'])->name('logout');



route::middleware('auth')->name('dashboard.')->prefix('/dashboard')->group(function(){
    route::get('/home', function(){
        return view('Dashboard.dashboard_index');
    })->name('index');

    route::get('/home/inserir', [ResponseController::class, 'input_form'])->name('input.form');
    route::get('/home/inserir', [ResponseController::class, 'response_store'])->name('input.insert');
    
    //route::post('/habitos/debug', [InputController::class, 'habitos_debug'])->name('habitos.store');
});
