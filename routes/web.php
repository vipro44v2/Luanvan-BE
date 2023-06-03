<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\CloudinaryController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ActorsController;
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
    return view('login');
});

Route::group(['middleware'=>'CheckLogin'],function(){
    Route::prefix('movie')->group(function(){
        Route::get('/list', [MovieController::class,'listMovie']);
        Route::get('/addMovieForm', [MovieController::class,'addMovieForm']);
        Route::get('/editMovieForm/{id}',[MovieController::class,'editMovieForm']);
        Route::post('/editMovie/{id}',[MovieController::class,'editMovie']);
        Route::get('/deleteMovie/{id}',[MovieController::class,'deleteMovie']);
        Route::post('/addMovie',[MovieController::class,'addMovie']);
    });
    Route::prefix('user')->group(function(){    
        Route::get('/list', function () {
            return view('user');
        });
    });
    Route::prefix('actor')->group(function(){    
        Route::get('/list', [ActorsController::class,'listActor']);
        Route::get('/addActorForm', function(){
            return view('Actor.addActor');
        });
        Route::post('/addActor',[ActorsController::class,'addActor']);
        Route::get('/editActorForm/{id}',[ActorsController::class,'editActorForm']);
        Route::post('/editActor/{id}',[ActorsController::class,'editActor']);
        Route::get('/deleteActor/{id}',[ActorsController::class,'deleteActor']);
    });
});


Route::post('/login',[LoginController::class,'login']);
Route::get('/logout',[LoginController::class,'logout']);
Route::post('/getimage',[CloudinaryController::class,'getImage']);