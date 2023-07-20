<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeatModel extends Model
{
    use HasFactory;
    protected $table='seats';
    protected $primaryKey="id";
    public function getSeatName($id){
        $name = DB::select('select name from seats where id = ?', [$id]);
        return $name[0];
    }
}
