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

    public function getAllMovies($fitlers=[],$keyword=null){
        $movies=DB::table("movies")
                ->join('movie_status','movies.movie_status_id','=','movie_status.id')
                ->join('directors','movies.director_id','=','directors.id')
                ->select('movies.*','directors.full_name as director_name','movie_status.status');
        if($fitlers){
            $movies=$movies->where($fitlers);
        }
        if($keyword){
            $movies=$movies->where(function($query) use ($keyword) {
                $query->orWhere('title','like','%'.$keyword.'%');
            });
        }
        $movies=$movies->paginate(4);
        return $movies;
    }
    public function searchMovie($keyword=null){
        $movies=DB::table("movies");
        if($keyword){
            $movies=$movies->where(function($query) use ($keyword) {
                $query->orWhere('title','like','%'.$keyword.'%');
            });
        }
        $movies=$movies->get();
        return $movies;
    }
    // public function getMovieById($id){
    //     $movies=DB::select('select * from movies where id = ?', [$id]);
    //     return $movies;
    // }   
    public function getMovieByStatus($status){
        $movies=DB::select('select * from movies where movie_status_id = ?', [$status]);
        return $movies;
    }   
    public function getMovieById($id)
    {
        $movies = DB::select('select *, movies.description as movie_des from movies join directors on movies.director_id = directors.id inner join countries on movies.country_id = countries.id where movies.id = ?', [$id]);
        return $movies;
    }
    public function getActorByMovieId($id)
    {
        $actors = DB::select('select actors.* from actor_movie join actors on actor_movie.actor_id = actors.id where actor_movie.movie_id = ?', [$id]);
        return $actors;
    }
    public function getGenreByMovieId($id)
    {
        $genres = DB::select('select genres.* from genre_movie join genres on genre_movie.genre_id = genres.id where genre_movie.movie_id = ?', [$id]);
        return $genres;
    }
    public function getMovieByDirector($id){
        $movie=DB::select('select * from movies where director_id = ?', [$id]);
        return $movie;
    }
}
