<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\GenresController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\DirectorController;
use App\Http\Controllers\API\MovieStatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'api','prefix'=>'user'],function($route){
        Route::get('/getall',[UserController::class,'getAll']);
        Route::post('/login',[UserController::class,'login']);
        Route::post('/create', [UserController::class,'register']); 
});

Route::prefix('genres')->group(function(){
    Route::get('/getall',[GenresController::class,'getAll']);
});
Route::prefix('country')->group(function(){
    Route::get('/getall',[CountryController::class,'getAll']);
});
Route::prefix('movie')->group(function(){
    Route::get('/getall',[MovieController::class,'getAll']);
    Route::post('/create', [MovieController::class,'create']);
    Route::get('/info/{id}',[MovieController::class,'info']);
    Route::get('/getbystatus/{status}',[MovieController::class,'getbystatus']);
});

Route::prefix('director')->group(function(){
    Route::get('/getall',[DirectorController::class,'getAll']);
});
Route::prefix('movieStatus')->group(function(){
    Route::get('/getall',[MovieStatusController::class,'getAll']);
});



Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
 
], function ($router) {
    Route::post('/login', 'Api\AuthController@login');
    Route::post('/register','Api\AuthController@register');
    Route::get('/logout', 'Api\AuthController@logout');
    Route::post('/refresh', 'Api\AuthController@refresh');
    Route::get('/user-profile','Api\AuthController@userProfile');
    Route::post('/change-pass', 'Api\AuthController@changePassWord');   
});
