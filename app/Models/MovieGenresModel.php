<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MovieGenresModel extends Model
{
    use HasFactory;
    protected $table="genre_movie";
    protected $fillable=['movie_id','genre_id'];  
    public $timestamps=false;
    public function deleteGenreMovie($movie_id){
        DB::delete('Delete from genre_movie where movie_id = ?', [$movie_id]);
    }
}
