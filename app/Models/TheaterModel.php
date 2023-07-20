<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TheaterModel extends Model
{
    use HasFactory;
    protected $table='theaters';
    protected $primaryKey="id";
    public function getTheaterById($id){
        $theater=DB::select('select * from theaters where id = ?', [$id]);
        return $theater;
    }
}
