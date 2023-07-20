<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
Use App\Models\DirectorModel;
Use App\Models\CountryModel;
Use App\Models\MovieModel;
use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Resize;

class DirectorController extends BaseController
{
    public function listDirector(){       
        $title="Danh sách đạo diễn";
        $directors=DirectorModel::getAllDirectors();
        foreach($directors as $item){
            if($item->gender==1)
            $item->gender="Nam";
            else
            $item->gender="Nữ";
        }
        return view("Director.listDirector",compact('title',"directors"));
    }
    public function addDirectorForm(){
        $nationality=CountryModel::all();
        return view("director.addDirector",compact("nationality"));
    }
    public function addDirector(Request $request){
        if($request->method('POST')){ 
            $request->validate([
                'full_name'=>'required',
                'story'=>'required|min:50',
                'birthday'=>'required',
                'image'=>'required',
            ],[
                'full_name.required'=>'Tên diễn viên không được trống',
                'story.required'=>'Tiểu sử không được trống',
                'story.min'=>"tiểu sử phải trên :min kí tự",
                'birthday.required'=>"Chưa nhập ngày sinh",
                'image.required'=>"Chưa chọn ảnh diễn viên"
            ] 
            );
            $cloudinary = new Cloudinary(
                [
                    'cloud' => [
                        'cloud_name' => 'doax8x0n9',
                        'api_key'    => '813244531242642',
                        'api_secret' => 'NpVe1HTWXm--JHJ4j-zrCvu4qKk',
                    ],
                ]
            ); 
            $file=$request->file('image')->getClientOriginalName();
            $fileName = pathinfo($file,PATHINFO_FILENAME);
            $cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['public_id' => $fileName]
            );
            $director=DirectorModel::create([
                'full_name'=>$request->input('full_name'),
                'gender'=>$request->input('gender'),
                'birthday'=>$request->input('birthday'),
                'story'=>$request->input('story'),
                'nationality'=>$request->input('nationality'),
                'image'=>$cloudinary->image($fileName)->resize(Resize::fill(450,300 ))->toUrl()
            ]);
            return redirect('/actor/list');
        }       
    }
    public function editDirectorForm($id){
        $director=DirectorModel::find($id);
        $nationality=CountryModel::all();
        return view('director.editDirector',compact('director','nationality'));
    }
    public function editDirector($id,Request $request){
            if($request->method('POST')){  
                $request->validate([
                    'full_name'=>'required',
                    'story'=>'required|min:50',
                    'birthday'=>'required',
                ],[
                    'full_name.required'=>'Tên diễn viên không được trống',
                    'story.required'=>'Tiểu sử không được trống',
                    'story.min'=>"tiểu sử phải trên :min kí tự",
                    'birthday.required'=>"Chưa nhập ngày sinh",
                ] 
                );
                $director = DirectorModel::find($id);
                $director->full_name=$request->input('full_name');
                $director->birthday=$request->input('birthday');
                $director->gender=$request->input('gender');
                $director->nationality=$request->input('nationality');
                $director->story=$request->input('story');
                if($request->file('image')){
                    $file=$request->file('image')->getClientOriginalName();
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
                        $request->file('image')->getRealPath(),
                        ['public_id' => $fileName]
                    );
                    $director->image=$cloudinary->image($fileName)->resize(Resize::fill(450,300 ))->toUrl();
                }
                $director->save();
                return redirect('/director/list');
            }
        }
        public function deleteDirector($id){
            $data=DirectorModel::find($id);
            $movie=MovieModel::getMovieByDirector($id);
            if($movie){
                echo 'Không thể xoá vì đạo diễn này đã có phim';
            }
            else{
            // $data->delete();
            // return redirect('/director/list');
            var_dump($movie);
            }
        }
}
