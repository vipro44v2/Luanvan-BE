<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TicketModel extends Model
{
    use HasFactory;
    protected $table='tickets';
    protected $primaryKey='id';
    protected $fillable=['seat_id','ticket_type_id','movie_price_id','prices','room_id','schedule_id','bill_id','calendars_id'];
    public $timestamps=false;
    public function getTicket($id){
        $ticket=DB::select('SELECT movies.title,schedules.time_start,calendars.date,rooms.name as room_name,seats.name as seat_name,ticket_types.type,ticket_types.prices FROM `tickets` JOIN calendars on tickets.calendars_id=calendars.id JOIN movies ON calendars.movie_id=movies.id JOIN schedules ON tickets.schedule_id=schedules.id JOIN rooms ON tickets.room_id=rooms.id JOIN seats ON tickets.seat_id=seats.id JOIN ticket_types ON tickets.ticket_type_id = ticket_types.id WHERE tickets.id=?', [$id]);
        return $ticket[0];
    }
    public function getTicketByBill($id){
        $tickets=DB::select('select * from tickets where bill_id = ?', [$id]);
        return $tickets;
    }
}
