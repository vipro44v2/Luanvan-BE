<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\RoomModel;
use App\Models\SeatRoomModel;
use App\Models\ScheduleModel;
use App\Models\CalendarModel;
use App\Models\TicketModel;
use App\Models\ShowtimeModel;
use App\Models\SeatModel;
class RoomController extends BaseController
{
    public function getRoomByTheater($id){
        $rooms=RoomModel::getRoomByTheater($id);
        if($rooms)
    {
        return response()->json([
        'data'=>$rooms,
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
    public function getSeatByRoom($id){
        $seat=SeatRoomModel::getSeatByRoom($id);
        if($seat)
        {
            return response()->json([
            'data'=>$seat,
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
    public function getListSeat($room_id,$schedule_id,$date){
        $seats=SeatRoomModel::getSeatByRoom($room_id);
        foreach ($seats as $item){
            $item->status=true;
            $ticket=TicketModel::all();
            foreach($ticket as $item1){
                $calendar=CalendarModel::getDateByCalendar($item1->calendars_id);
                if($item1->room_id==$room_id&&$schedule_id==$item1->schedule_id&&$date==$calendar[0]->date&&$item1->seat_id==$item->id){
                    $item->status=false;
                }
            }
        }
        if($seats)
        {
            return response()->json([
            'data'=>$seats,
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
    public function getSeat($calendar_id,$schedule_id){
        $showtime=ShowtimeModel::getShowtimeByCalendar($calendar_id,$schedule_id);
        $vt=0;
        $room_id=$showtime[$vt]->room_id;
        $seats=SeatRoomModel::getSeatByRoom($room_id);
        foreach ($seats as $item){
            $item->status=true;
            $ticket=TicketModel::all();
            foreach($ticket as $item1){
                if($item1->room_id==$room_id&&$schedule_id==$item1->schedule_id&&$item1->calendars_id==$calendar_id&&$item1->seat_id==$item->id){
                    $item->status=false;
                }
            }
        }
        if($seats)
        {
            return response()->json([
            'data'=>$seats,
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
    public function getMovieByRoom($schedule_id,$room_id,$date){
        $movies=ShowtimeModel::getMovieByRoom($schedule_id,$room_id,$date);
        if($movies)
        {
            return response()->json([
            'data'=>$movies,
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
    public function getTimeByRoom($room_id,$date){
        $time=ShowtimeModel::getShowtimesByRoom($room_id,$date);
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
    public function getAllTime($room_id,$date){
        $time=ScheduleModel::all();
        $time1=ShowtimeModel::getShowtimesByRoom($room_id,$date);
        foreach($time as $item){
            $flag=true;
            foreach($time1 as $item1){
                if($item->id==$item1->schedule_id)
                    $flag=false;
            }
            $item->status=$flag;
        }
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
    public function getSeatName($id){
        $name = SeatModel::getSeatName($id);
        if($name)
        {
            return response()->json([
            'data'=>$name,
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
