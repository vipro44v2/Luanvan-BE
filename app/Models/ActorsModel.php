<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ActorsModel extends Model
{
    use HasFactory;
    protected $table="actors";
    protected $primaryKey="id";
    protected $fillable=['id','full_name','gender','story','nationality','image','birthday'];  
    public $timestamps=false;
    public function getAllActors(){
        $actors=DB::table("actors")->get();
        return $actors;
    }
    public function getActorById($id){
        $actors=DB::select('select * from actors where id = ?', [$id]);
        return $actors;
    }   
}
