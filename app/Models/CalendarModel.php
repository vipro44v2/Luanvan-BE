<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CalendarModel extends Model
{
    use HasFactory;
    protected $table='calendars';
    protected $primaryKey='id';
    protected $fillable=['id','date','movie_id'];
    public $timestamps=false;
    public function getCalendarByTheater($id){
        $calendars=DB::select('SELECT DISTINCT calendars.id,calendars.date, calendars.movie_id,rooms.name as room_name  FROM `calendars` JOIN showtimes ON calendars.id = showtimes.calendar_id JOIN rooms ON showtimes.room_id = rooms.id WHERE rooms.theater_id=?', [$id]);
        return $calendars;
    }
    public function getDateByCalendar($id){
        $date=DB::select('select date from calendars where id = ?', [$id]);
        return $date;
    }
    public function getTheaterByMovie($id){
        $theater=DB::select('SELECT DISTINCT theaters.id,theaters.theater_name FROM calendars JOIN showtimes on calendars.id=showtimes.calendar_id JOIN rooms on showtimes.room_id=rooms.id JOIN theaters 
        ON rooms.theater_id=theaters.id WHERE calendars.movie_id=?', [$id]);
        return $theater;
    }
    public function getSchedule($movie_id,$theater_id){
        $schedule=DB::select('SELECT DISTINCT calendars.date,calendars.id FROM `calendars` JOIN showtimes on calendars.id=showtimes.calendar_id JOIN rooms on showtimes.room_id=rooms.id 
        WHERE calendars.movie_id=? AND rooms.theater_id=? ', [$movie_id,$theater_id]);
        return $schedule;
    }
    public function getTime($theater_id,$calendar_id){
        $time = DB::select("SELECT DISTINCT schedules.id,schedules.time_start FROM schedules JOIN showtimes on schedules.id=showtimes.schedule_id
        join calendars on calendars.id=showtimes.calendar_id
        JOIN rooms on rooms.id=showtimes.room_id
        WHERE rooms.theater_id=? AND calendars.id=?", [$theater_id,$calendar_id]);
        return $time;
    }
    public function getRoomByCalendar($id){
        $room=DB::select('SELECT DISTINCT room_id from showtimes where calendar_id = ?', [$id]);
        return $room;
    }public function getCalendarByMovie($id){
        $calendar=DB::select('select * from calendars where movie_id = ?',[$id]);
        return($calendar);
    }

}
