<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\CloudinaryController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ActorsController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\DirectorController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\HomeController;
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

    Route::get('/home',[HomeController::class,'home']);
    Route::group(['middleware'=>'CheckLogin'],function(){   
    Route::prefix('info')->group(function () {
        Route::get('/getinfo/{id}',[StaffController::class,'getInfo']);
        Route::get('/changePasswordForm/{id}',[StaffController::class,'changePasswordForm']);
        Route::post('/changePassword/{id}',[StaffController::class,'changePassword']);
        Route::post('/updateInfo/{id}',[StaffController::class,'updateInfo']);
    });
    Route::prefix('staff')->group(function(){    
        Route::get('/list',[StaffController::class,'listStaff']);
        Route::get('/addstaffform',[StaffController::class,'addStaffForm']);
        Route::post('/addStaff',[StaffController::class,'addStaff']);
        Route::get('/updateStaffForm/{id}',[StaffController::class,'updateStaffForm']);
        Route::post('/updateStaff/{id}',[StaffController::class,'updateStaff']);
    });
    Route::group(['middleware'=>'CheckPermission'],function(){
    Route::prefix('actor')->group(function(){    
        Route::get('/list', [ActorsController::class,'listActor']);
        Route::get('/addActorForm',[ActorsController::class,'addActorForm']);
        Route::post('/addActor',[ActorsController::class,'addActor']);
        Route::get('/editActorForm/{id}',[ActorsController::class,'editActorForm']);
        Route::put('/editActor/{id}',[ActorsController::class,'editActor']);
        Route::get  ('/deleteActor/{id}',[ActorsController::class,'deleteActor']);
    });
    Route::prefix('movie')->group(function(){
        Route::get('/list', [MovieController::class,'listMovie']);
        Route::get('/addMovieForm', [MovieController::class,'addMovieForm']);
        Route::get('/editMovieForm/{id}',[MovieController::class,'editMovieForm']);
        Route::put('/editMovie/{id}',[MovieController::class,'editMovie']);
        Route::get('/deleteMovie/{id}',[MovieController::class,'deleteMovie']);
        Route::post('/addMovie',[MovieController::class,'addMovie']);
    });
    Route::prefix('director')->group(function () {
        Route::get('/list',[DirectorController::class,'listDirector']);
        Route::get('/addDirectorForm',[DirectorController::class,'addDirectorForm']);
        Route::post('/addDirector',[DirectorController::class,'addDirector']);
        Route::get('/editDirectorForm/{id}',[DirectorController::class,'editDirectorForm']);
        Route::post('/editDirector/{id}',[DirectorController::class,'editDirector']);   
        Route::get('/deleteDirector/{id}',[DirectorController::class,'deleteDirector']);
    });
    Route::prefix('room')->group(function () {
        Route::get('/list/{id}',[RoomController::class,'listRoom']);
        Route::get('/addRoomForm/{id}',[RoomController::class,'addRoomForm']);
        Route::post('/addRoom/{id}',[RoomController::class,'addRoom']);
    });    
    });
    Route::prefix('calendar')->group(function () {
        Route::get('/list/{id}',[CalendarController::class,'listCalendar']);
        Route::get('/addCalendarForm/{id}',[CalendarController::class,'addCalendarForm']);
        Route::post('/addCalendar/{id}',[CalendarController::class,'addCalendar']);
        Route::get('/editCalendarForm/theater_id={theater_id}&id={id}',[CalendarController::class,'editCalendarForm']);
        Route::put('/editCalendar/theater_id={theater_id}&calendar_id={id}',[CalendarController::class,'editCalendar']);
        Route::get('/deleteCalendar/theater_id={theater_id}&id={id}',[CalendarController::class,'deleteCalendar']);
    });

    Route::prefix('bill')->group(function () {
        Route::get('/list/{id}',[BillController::class,'listBill']);
        Route::get('/getDetail/theater_id={theater_id}&bill_id={bill_id}',[BillController::class,'getDetail']);
    });
    Route::prefix('payment')->group(function () {
        Route::post('/momoPayment',[PaymentController::class,'momoPayment']);
    });
    Route::prefix('ticket')->group(function () {
        Route::get('/buyTicket/{theater_id}',[TicketController::class,'buyTicket']);
        Route::post('/createTicket',[TicketController::class,'createTicket']);
    });
});

Route::get('/thanhtoan', function () {
    return view('payment');
});
Route::get('/',function(){
    return view('login');
});
Route::post('/login',[LoginController::class,'login']);
Route::get('/logout',[LoginController::class,'logout']);
Route::get('/getimage',[CloudinaryController::class,'getImage']);