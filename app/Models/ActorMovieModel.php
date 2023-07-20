<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorMovieModel extends Model
{
    use HasFactory;
    protected $table='actor_movie';    
    protected $fillable=['movie_id','actor_id'];  
    public $timestamps=false;
}
