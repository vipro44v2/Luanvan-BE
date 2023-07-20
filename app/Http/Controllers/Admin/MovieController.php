<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\MovieModel;
use App\Models\CountryModel;
Use App\Models\ActorMovieModel;
Use App\Models\ActorsModel;
Use App\Models\GenresModel;
Use App\Models\DirectorModel;
Use App\Models\CalendarModel;
Use App\Models\MovieGenresModel;
Use App\Models\MovieStatusModel;
use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Resize;


class MovieController extends BaseController
{
    public function addMovieForm(){
        $title='Thêm phim';
        $country=CountryModel::all();
        $director=DirectorModel::all();
        $movie_status=MovieStatusModel::all();
        $actor=ActorsModel::getAllActors();
        $genres=GenresModel::all();
        return view('Movie.addMovie',compact('actor','title','genres','country','director','movie_status'));
    }
    public function addMovie(Request $request){
          
        if($request->method('POST')){ 
            
            $request->validate([
                'title'=>'required|min:8',
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
            $file=$request->file('poster')->getClientOriginalName();
            $fileName = pathinfo($file,PATHINFO_FILENAME);
            $cloudinary = new Cloudinary(
                [
                    'cloud' => [
                        'cloud_name' => 'doax8x0n9',
                        'api_key'    => '813244531242642',
                        'api_secret' => 'NpVe1HTWXm--JHJ4j-zrCvu4qKk',
                    ],
                ]
            ); 
            $cloudinary->uploadApi()->upload(
                $request->file('poster')->getRealPath(),
                ['public_id' => $fileName]
            );
            $movies=MovieModel::create([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'duration'=>$request->input('duration'),
                'age_limit'=>$request->input('age_limit'),
                'release_date'=>$request->input('date_release'),
                'poster'=>$cloudinary->image($fileName)->resize(Resize::fill(450,300 ))->toUrl(),
                'trailer'=>"",
                'country_id'=>$request->input('country'),
                'director_id'=>$request->input('director'),
                'movie_status_id'=>$request->input('movie_status'),
                'quality'=>0 
            ]);
            $id=$movies->id;
            $genre=GenresModel::all();
             foreach($genre as $item){
                if($request->input($item->id))
                {
                   MovieGenresModel::create([
                    'movie_id'=>$id,
                    'genre_id'=>$item->id
                   ]);
                }
             }
            return redirect('/movie/list');
        }
    }

       

    public function listMovie(Request $r){
        $listmovie="Danh sách phim";
        $director=DirectorModel::all();
        $movie_status=MovieStatusModel::all();
        $fitlers=[];
        $keyword=null;
        if($r->director_id){
            $director_id=$r->director_id;
            $fitlers[]=['movies.director_id','=',$director_id];
        }
        if($r->movie_status_id){
            $movie_status_id=$r->movie_status_id;
            $fitlers[]=['movies.movie_status_id','=',$movie_status_id];
        }
        if($r->keyword){
            $keyword=$r->keyword;
        }
        $movies=MovieModel::getAllMovies($fitlers,$keyword);
        return view("Movie.listMovie",compact('listmovie',"movies",'director','movie_status'));
    }
    
    public function editMovieForm($id=0){
        $title="Cập nhật phim";
        $movie=MovieModel::find($id);
        $country=CountryModel::all();
        $director=DirectorModel::all();
        $movie_status=MovieStatusModel::all();
        $genres=MovieModel::getGenreByMovieId($id);
        $listgenre=GenresModel::all();
        return view("Movie.editMovie",compact('title',"movie",'country','director','movie_status','genres','listgenre'));
    }
    public function editMovie(Request $request,$id){
        if($request->method('POST')){  
            $request->validate([
                'title'=>'required|min:10',
                'description'=>'required|min:50',
                'duration'=>'required',
                'age_limit'=>'required',
                'date_release'=>'required',
            ],[
                'title.required'=>'Tiêu đề không được trống',
                'title.min'=>'Tiêu đề phải trên :min kí tự',
                'description.required'=>'Mô tả không được trống',
                'description.min'=>"Mô tả phải trên :min kí tự",
                'duration.required'=>"Chưa nhập thời lượng phim",
                'age_limit.required'=>"Giới hạn độ tuổi không được để trống",
                'date_release.required'=>"Chưa chọn ngày khởi chiếu",
            ] 
            );           
                $data=MovieModel::find($id);
                $data->title=$request->input('title');
                $data->description=$request->input('description');
                $data->duration=$request->input('duration');
                $data->age_limit=$request->input('age_limit');
                $data->release_date=$request->input('date_release');
                if($request->file('poster')){
                    $file=$request->file('poster')->getClientOriginalName();
                    $fileName = pathinfo($file,PATHINFO_FILENAME);
                    $cloudinary = new Cloudinary(
                        [
                            'cloud' => [
                                'cloud_name' => 'doax8x0n9',
                                'api_key'    => '813244531242642',
                                'api_secret' => 'NpVe1HTWXm--JHJ4j-zrCvu4qKk',
                            ],
                        ]
                    ); 
                    $cloudinary->uploadApi()->upload(
                        $request->file('poster')->getRealPath(),
                        ['public_id' => $fileName]
                    );
                    $data->poster=$cloudinary->image($fileName)->resize(Resize::fill(450,300 ))->toUrl();
                }
                $data->country_id=$request->input('country');
                $data->director_id=$request->input('director');
                $data->movie_status_id=$request->input('movie_status');
                $data->save();
            MovieGenresModel::deleteGenreMovie($id);
            $genre=GenresModel::all();
            foreach($genre as $item){
               if($request->input($item->id))
               {
                  MovieGenresModel::create([
                   'movie_id'=>$id,
                   'genre_id'=>$item->id
                  ]);
               }
            }
            return redirect('/movie/list');
     }
   
    }
    public function deleteMovie($id){
        $data=MovieModel::find($id);
        $calendar=CalendarModel::getCalendarByMovie($id);
        if($calendar){        
            echo 'Không thể xoá vì phim này đã có lịch';
        }
        else{
            $data->delete();
             return redirect('/movie/list');
        }
        
    }
}
