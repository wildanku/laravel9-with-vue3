<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserJsonController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('home');
});

Route::middleware('guest')->group(function() {
    Route::get('/login', function() {
        return view('login');
    })->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('authenticate');
});

Route::middleware('auth')->prefix('/home')->group(function() {
    Route::middleware('auth')->get('/', function() {
        return view('home');
    })->name('home');

    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});

// json request
Route::middleware('json.response')->prefix('/json')->group(function() {
    Route::controller(UserJsonController::class)->prefix('/user')->group(function() {
        Route::get('/','index');
        Route::post('/','store');
        Route::get('/{user}','show');
        Route::post('/{user}/update','update');
        Route::post('/{user}/delete','destroy');
    });
});