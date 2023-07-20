<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\CalendarModel;

class CalendarController extends BaseController
{
    public function getDateByCalendar($id){
        $date=CalendarModel::getDateByCalendar($id);
        if($date)
        {
            return response()->json([
            'data'=>$date,
            'status_code'=>200,
            'message'=>'done'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'error'
            ]);
        }
    }
    public function getTheaterByMovie($id){
        $theater=CalendarModel::getTheaterByMovie($id);
        if($theater)
        {
            return response()->json([
            'data'=>$theater,
            'status_code'=>200,
            'message'=>'done'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'error'
            ]);
        }
    }
    public function getCalendar($movie_id,$theater_id){
        $schedule=CalendarModel::getSchedule($movie_id,$theater_id);
        
        if($schedule)
        {
            return response()->json([
            'data'=>$schedule,
            'status_code'=>200,
            'message'=>'done'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'error'
            ]);
        }
    }
    public function getTime($theater_id,$calendar_id){
        $time=CalendarModel::getTime($theater_id,$calendar_id);
        if($time)
        {
            return response()->json([
            'data'=>$time,
            'status_code'=>200,
            'message'=>'done'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'error'
            ]);
        }
    }
}
