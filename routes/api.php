<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\GenresController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\DirectorController;
use App\Http\Controllers\API\MovieStatusController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\TheaterController;
use App\Http\Controllers\API\CalendarController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\ActorController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BillController;
use App\Http\Controllers\API\PaymentController;

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
        Route::get('/getuserbyid/{id}',[UserController::class,'getUserById']);
});

Route::prefix('genres')->group(function(){
    Route::get('/getall',[GenresController::class,'getAll']);
});
Route::prefix('actor')->group(function () {
    Route::get('/getall',[ActorController::class,'getAll']);
});
Route::prefix('country')->group(function(){
    Route::get('/getall',[CountryController::class,'getAll']);
});
Route::prefix('movie')->group(function(){
    Route::get('/getall',[MovieController::class,'getAll']);
    Route::post('/create', [MovieController::class,'create']);
    Route::get('/info/{id}',[MovieController::class,'info']);
    Route::get('/getbystatus/{status}',[MovieController::class,'getbystatus']);
    Route::get('/search/keyword={keyword}',[MovieController::class,'search']);
    ///actors
    Route::get('/getactorbymovie/{id}',[MovieController::class,'getActorByMovieId']);
    ///genres
    Route::get('/getgenrebymovie/{id}',[MovieController::class,'getGenreByMovieId']);
});

Route::prefix('director')->group(function(){
    Route::get('/getall',[DirectorController::class,'getAll']);
});
Route::prefix('movieStatus')->group(function(){
    Route::get('/getall',[MovieStatusController::class,'getAll']);
});
Route::prefix('room')->group(function () {
    Route::get('/getbytheater/{id}',[RoomController::class,'getRoomByTheater']);
    Route::get('/getSeatByRoom/{id}',[RoomController::class,'getSeatByRoom']);
    Route::get('/getSeat/{room_id};{schedule_id};{date}',[RoomController::class,'getListSeat']);
    Route::get('/getListSeat/calendar_id={calendar_id}&schedule_id={schedule_id}',[RoomController::class,'getSeat']);
    Route::get('/getmoviebyroom/schedule_id={schedule_id}&room_id={room_id}&date={date}',[RoomController::class,'getMovieByRoom']);
    Route::get('/gettimebyroom/room_id={room_id}&date={date}',[RoomController::class,'getTimeByRoom']);
    Route::get('/getalltime/room_id={room_id}&date={date}',[RoomController::class,'getAllTime']);
    Route::get('/getseatname/seat_id={seat_id}',[RoomController::class,'getSeatName']);
});
Route::prefix('theater')->group(function () {
    Route::get('/getall',[TheaterController::class,'getAll']);
});
Route::prefix('calendar')->group(function () {
    Route::get('/getdatebycalendar/{id}',[CalendarController::class,'getDateByCalendar']);
    Route::get('/gettheaterbymovie/{id}',[CalendarController::class,'getTheaterByMovie']);
    Route::get('/getcalendar/movie_id={movie_id}&theater_id={theater_id}',[CalendarController::class,'getCalendar']);
    Route::get('/gettime/theater_id={theater_id}&calendar_id={calendar_id}',[CalendarController::class,'getTime']);
});
Route::prefix('ticket')->group(function () {
    Route::get('/getall',[TicketController::class,'getAll']);
    Route::post('/create',[TicketController::class,'create']);
    Route::get('/price',[TicketController::class,'getPrice']);
});
Route::prefix('bill')->group(function () {
    Route::post('/create',[BillController::class,'create']);
});
Route::prefix('payment')->group(function () {
    Route::get('/momo',[PaymentController::class,'momoPayment']);
});

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'user'
 
], function ($router) {
    Route::post('/login', [AuthController::class,'login']);
    Route::post('/register',[AuthController::class,'register']);
    Route::get('/logout', [AuthController::class,'logout']);
    Route::post('/refresh', [AuthController::class,'refresh']);
    Route::get('/user-profile',[AuthController::class,'userProfile']);
    Route::post('/change-pass', [AuthController::class,'changePassword']);
    Route::post('/updateProfile/{id}',[AuthController::class, 'updateProfile']);
});
 