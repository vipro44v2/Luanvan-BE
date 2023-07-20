<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShowtimeModel extends Model
{
    use HasFactory;
    protected $table="showtimes";
    protected $fillable=['schedule_id','room_id','calendar_id'];
    public $timestamps=false;
    public function getTimeByCalendar($id){
       $time= DB::table('showtimes')
        ->join('schedules','showtimes.schedule_id', '=', 'schedules.id')
        ->where('showtimes.calendar_id','=',$id)
        ->select('time_start')
        ->get();
        return $time;
    }
    public function getMovieByRoom($schedule_id,$room_id,$date){
        $movie=DB::select('SELECT title FROM showtimes JOIN calendars on showtimes.calendar_id=calendars.id join movies on calendars.movie_id=movies.id WHERE schedule_id=? AND room_id =? AND date=?', [$schedule_id,$room_id,$date]);
        return $movie;
    }
    public function deleteShowtimeByCalendar($calendar_id){
        DB::delete('delete from showtimes where calendar_id= ?', [$calendar_id]);
    }
    public function getShowtimesByRoom($room_id,$date){
        $time=DB::select('SELECT showtimes.schedule_id FROM showtimes JOIN calendars on showtimes.calendar_id=calendars.id WHERE showtimes.room_id=? AND calendars.date=?', [$room_id,$date]);
        return $time;
    }
    public function getShowtimeByCalendar($calendar_id,$schedule_id){
        $showtimes=DB::select('select * from showtimes where calendar_id = ? AND schedule_id=?', [$calendar_id,$schedule_id]);
        return $showtimes;
    }
}
