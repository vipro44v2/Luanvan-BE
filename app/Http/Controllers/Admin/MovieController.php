<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\MovieModel;
use App\Models\CountryModel;
Use App\Models\ActorsModel;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MovieController extends BaseController
{
    public function addMovieForm(){
        $title='Thêm phim';
        $actor=ActorsModel::getAllActors();
        return view('Movie.addMovie',compact('actor','title'));
    }
    public function addMovie(Request $request){

        if($request->method('POST')){  
            $request->validate([
                'title'=>'required|min:10',
                'description'=>'required|min:50',
                'duration'=>'required',
                'age_limit'=>'required',
                'date_release'=>'required',
                'poster'=>'required',
            ],[
                'title.required'=>'Tiêu đề không được trống',
                'title.min'=>'Tiêu đề phải trên :min kí tự',
                'description.required'=>'Mô tả không được trống',
                'description.min'=>"Mô tả phải trên :min kí tự",
                'duration.required'=>"Chưa nhập thời lượng phim",
                'age_limit.required'=>"Giới hạn độ tuổi không được để trống",
                'date_release.required'=>"Chưa chọn ngày khởi chiếu",
                'poster.required'=>"Chưa chọn poster"
            ] 
            );
            $movies=MovieModel::create([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'duration'=>$request->input('duration'),
                'age_limit'=>$request->input('age_limit'),
                'release_date'=>$request->input('date_release'),
                'poster'=>$request->input('poster'),
                'trailer'=>"",
                'country_id'=>$request->input('country'),
                'director_id'=>$request->input('director'),
                'movie_status_id'=>$request->input('movie_status'),
                'quality'=>0 
            ]);
            return redirect('/movie/list');
        }
       
    }

    public function listMovie(){
        $listmovie="Danh sách phim";
        $movies=MovieModel::getAllMovies();
        return view("Movie.listMovie",compact('listmovie',"movies"));
    }
    
    public function editMovieForm($id=0){
        $title="Cập nhật người dùng";
        $movie=MovieModel::getMovieById($id);
        return view("Movie.editMovie",compact('title',"movie"));
    }
    public function editMovie(Request $request,$id){
        if($request->method('POST')){  
            $request->validate([
                'title'=>'required|min:10',
                'description'=>'required|min:50',
                'duration'=>'required',
                'age_limit'=>'required',
                'date_release'=>'required',
                'poster'=>'required',
            ],[
                'title.required'=>'Tiêu đề không được trống',
                'title.min'=>'Tiêu đề phải trên :min kí tự',
                'description.required'=>'Mô tả không được trống',
                'description.min'=>"Mô tả phải trên :min kí tự",
                'duration.required'=>"Chưa nhập thời lượng phim",
                'age_limit.required'=>"Giới hạn độ tuổi không được để trống",
                'date_release.required'=>"Chưa chọn ngày khởi chiếu",
                'poster.required'=>"Chưa chọn poster"
            ] 
            );
            $data=MovieModel::find($id);
                $data->title=$request->input('title');
                $data->description=$request->input('description');
                $data->duration=$request->input('duration');
                $data->age_limit=$request->input('age_limit');
                $data->release_date=$request->input('date_release');
                $data->poster=$request->input('poster');
                $data->country_id=$request->input('country');
                $data->director_id=$request->input('director');
                $data->movie_status_id=$request->input('movie_status');
                $data->save();
            return redirect('/movie/list');
     }
   
    }
    public function deleteMovie($id){
        $data=MovieModel::find($id);
        $data->delete();
        return redirect('/movie/list');
    }
}
