<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalendarModel;
use App\Models\MovieModel;
use App\Models\RoomModel;
use App\Models\TheaterModel;
use App\Models\ScheduleModel;
use App\Models\ShowtimeModel;

class CalendarController extends BaseController
{
    public function listCalendar($id){
        $title='Lịch chiếu phim';
        $calendar=CalendarModel::getCalendarByTheater($id);
        $theater=TheaterModel::find($id);
        $x=0;
        foreach($calendar as $item){
            $calendar[$x++]->movie=MovieModel::getMovieById($item->movie_id)[0]->title;
        }
        return view('Calendar.listCalendar',compact('title','calendar','theater'));
    }
    public function addCalendarForm($id){
        $schedules=ScheduleModel::all();
        $movies=MovieModel::all();
        $rooms=RoomModel::getRoomByTheater($id);
        $theater=TheaterModel::find($id);
        $title='Thêm lịch chiếu';
        return view('Calendar.addCalendar',compact('title','movies','rooms','schedules','theater'));
    }
    public function addCalendar($id,Request $request){
        if($request->method('POST')){  
            $calendar=CalendarModel::create([
                'date'=>$request->input('date'),
                'movie_id'=>$request->input('movie')
            ]);
            $schedules=ScheduleModel::all();
            foreach($schedules as $item){
                if($request->input($item->id)){
                    $showtimes=ShowtimeModel::create([
                        'schedule_id'=>$item->id,
                        'room_id'=>$request->input('room'),
                        'calendar_id'=>$calendar->id
                    ]);
                }
                
            }       
        }
        return redirect("calendar/list/{$id}");
    }
    public function editCalendarForm($theater_id,$id){
        $calendar=CalendarModel::find($id);
        $room=CalendarModel::getRoomByCalendar($id);
        $schedules=ScheduleModel::all();
        $movies=MovieModel::all();
        $rooms=RoomModel::getRoomByTheater($theater_id);
        $theater=TheaterModel::find($theater_id);
        $time=CalendarModel::getTime($theater_id,$id);
        $title='Chi tiết lịch chiếu';
        return view('Calendar.editCalendar',compact('time','room','calendar','title','movies','rooms','schedules','theater'));
    }
    public function editCalendar($theater_id,$calendar_id,Request $r){
        if($r->method('POST')){
            $data=CalendarModel::find($calendar_id);
            $data->date=$r->input('date');
            $data->movie_id=$r->input('movie');
            $data->save();
            ShowtimeModel::deleteShowtimeByCalendar($calendar_id);
            $schedules=ScheduleModel::all();
            foreach($schedules as $item){
                if($r->input($item->id)){
                    $showtimes=ShowtimeModel::create([
                        'schedule_id'=>$item->id,
                        'room_id'=>$r->input('room'),
                        'calendar_id'=>$calendar_id
                    ]);
                }
                
            }       
        }
        return redirect("calendar/list/{$theater_id}");
    }
    public function deleteCalendar($theater_id,$id){
        $data=CalendarModel::find($id);
        $data->delete();
        return redirect("calendar/list/{$theater_id}");
    }
}
