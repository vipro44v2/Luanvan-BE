<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\MovieModel;
use App\Models\CountryModel;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MovieController extends BaseController
{
    function getAll(){
        $movies=MovieModel::all();
        if($movies)
        {
            return response()->json([
            'data'=>$movies,
            'status_code'=>200,
            'message'=>'done'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'error'
            ]);
        }
    }
    public function create(Request $r){
        $movies=MovieModel::create([
            'title'=>$r->title,
            'description'=>$r->description,
            'duration'=>$r->duration,
            'age_limit'=>$r->age_limit,
            'release_date'=>$r->release_date,
            'poster'=>$r->poster,
            'quality'=>0,
            'trailer'=>$r->trailer,
            'country_id'=>$r->country_id,
            'director_id'=>$r->director_id,
            'movie_status_id'=>$r->movie_status_id
        ]);
        if($movies)
        {
            return response()->json([
            'data'=>$movies,
            'status_code'=>200,
            'message'=>'Thêm movie thành công'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'Thêm movie thất bại'
            ]);
        }
    }
    public function info($id){
        $movie = MovieModel::getMovieById($id);
        if($movie)
        {
            return response()->json([
            'data'=>$movie,
            'status_code'=>200,
            'message'=>'done'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'error'
            ]);
        }
    }
   public function getByStatus($status){
    $movies = MovieModel::getMovieByStatus($status);
    if($movies)
    {
        return response()->json([
        'data'=>$movies,
        'status_code'=>200,
        'message'=>'done'
        ]);
    }
    else
    {
        return response()->json([
            'data'=>null,
            'status_code'=>404,
            'message'=>'error'
        ]);
    }
   }
    public function getActorByMovieId($id)
    {
        $actors = MovieModel::getActorByMovieId($id);
        if ($actors) {
            return response()->json([
                'data' => $actors,
                'status_code' => 200,
                'message' => 'done'
            ]);
        } else {
            return response()->json([
                'data' => null,
                'status_code' => 404,
                'message' => 'error'
            ]);
        }
    }
    public function getGenreByMovieId($id)
    {
        $actors = MovieModel::getGenreByMovieId($id);
        if ($actors) {
            return response()->json([
                'data' => $actors,
                'status_code' => 200,
                'message' => 'done'
            ]);
        } else {
            return response()->json([
                'data' => null,
                'status_code' => 404,
                'message' => 'error'
            ]);
        }
    }
    public function search($keyword){
        $movie=MovieModel::searchMovie($keyword);
        if($movie)
        {
            return response()->json([
            'data'=>$movie,
            'status_code'=>200,
            'message'=>'done'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'error'
            ]);
        }
    }

}
