<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DirectorModel extends Model
{
    use HasFactory;
    protected $table="directors";
    protected $primaryKey="id";
    protected $fillable=['full_name','gender','story','image','nationality','birthday'];
    public $timestamps=false;
    public function getAllDirectors(){
        $directors=DB::table('directors')
                ->join('countries','directors.nationality','=','countries.id')
                ->select('directors.*','countries.country_name');
        $directors=$directors->get();
        return $directors;
    } 
}
