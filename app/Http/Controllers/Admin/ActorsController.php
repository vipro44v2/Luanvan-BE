<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
Use App\Models\ActorsModel;
Use App\Models\CountryModel;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Resize;


class ActorsController extends BaseController
{
    public function listActor(){       
            $title="Danh sách diễn viên";
            $actors=ActorsModel::getAllActors();
            foreach($actors as $item){
                if($item->gender==1)
                $item->gender="Nam";
                else
                $item->gender="Nữ";
                $nationality=CountryModel::find( $item->nationality);
                $item->nationality=$nationality->country_name;
            }
            return view("Actor.listActor",compact('title',"actors"));
    }
    public function addActorForm(){
        $nationality=CountryModel::all();
        return view("Actor.addActor",compact("nationality"));
    }
    public function addActor(Request $request){
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
            $actors=ActorsModel::create([
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
    public function deleteActor($id){
        $data=ActorsModel::find($id);
        $data->delete();
        return redirect('/actor/list');
    }
    public function editActorForm($id=0){
        $title="Cập nhật diễn viên";
        $actor=ActorsModel::getActorById($id);
        $nationality=CountryModel::all();
        return view("Actor.editActor",compact('title',"actor","nationality"));
    }
    public function editActor(Request $request,$id){
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
            $actor = ActorsModel::find($id);
            $actor->full_name=$request->input('full_name');
            $actor->birthday=$request->input('birthday');
            $actor->gender=$request->input('gender');
            $actor->nationality=$request->input('nationality');
            $actor->story=$request->input('story');
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
                $actor->image=$cloudinary->image($fileName)->resize(Resize::fill(450,300 ))->toUrl();
            }
            $actor->save();
            return redirect('/actor/list');
        }
    }
}

