<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MovieModel extends Model
{
    use HasFactory;
    protected $table="movies";
    protected $primaryKey="id";
    protected $fillable=["id","title","description","duration","age_limit","release_date","poster","trailer","country_id","quality","director_id","movie_status_id"];
    public $timestamps=false;

    public function getAllMovies(){
        $movies=DB::table("movies")->get();
        return $movies;
    }
    public function getMovieById($id){
        $movies=DB::select('select * from movies where id = ?', [$id]);
        return $movies;
    }   
    public function getMovieByStatus($status){
        $movies=DB::select('select * from movies where movie_status_id = ?', [$status]);
        return $movies;
    }   
}
