<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeatModel;
use App\Models\TheaterModel;
use App\Models\RoomModel;
use App\Models\ScheduleModel;
use App\Models\SeatRoomModel;
use App\Models\TicketModel;
use App\Models\CalendarModel;

class RoomController extends BaseController
{
    public function listRoom($id){
        $room=RoomModel::getRoomByTheater($id);
        $time=ScheduleModel::all();
        $date=date('Y-m-d');
        $seat=SeatModel::all();
        $theater=TheaterModel::find($id);
        $seats=SeatRoomModel::getSeatByRoom($room[0]->id);
        return view('Room.listRoom',compact('seat','room','theater','time','date'));
    }
    public function addRoomForm($id){
        $title='Thêm phòng';
        $theater=TheaterModel::find($id);
        return view('Room.addRoom',compact('theater','title'));
    }
    public function addRoom($id,Request $request){
        if($request->method('POST')){
            $room=RoomModel::create([
                'name'=>$request->input('name'),
                'slot'=>$request->input('slot'),
                'theater_id'=>$request->input('theater'),
                'room_status_id'=>1
            ]);
            $seat=SeatModel::all();
            for($x=0;$x<$request->input('slot');$x++){
                SeatRoomModel::create([
                    'seat_id'=>$seat[$x]->id,
                    'room_id'=>$room->id
                ]);
            }
            return redirect("/room/list/{$id}");
        }
    }
}

