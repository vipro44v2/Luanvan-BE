<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaffModel;
use App\Models\StaffRoleModel;
use App\Models\PrivilegeModel;
use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Resize;
use Session;

class StaffController extends BaseController
{
    public function listStaff(){
        $staff=StaffModel::getAllStaff();
        return view('Staff.listStaff',compact('staff'));
    }
    public function addStaffForm(){
        $role=StaffRoleModel::all();
        return view('Staff.addStaff',compact('role'));
    }
    public function addStaff(Request $r){
        $r->validate([
            'name'=>'required',
            'id_card_number'=>'required',
            'phone_number'=>'required',
            'username'=>'required|unique:staffs',
            'password'=>'required|min:8',
            'password_confirmation'=>'required|min:8|same:password'
        ],[
            'name.required'=>'Tên diễn viên không được trống',
            'id_card_number.required'=>'Số CCCD không được trống',
            'phone_number.required'=>"Số điện thoại không được để trống",
            'username.required'=>"Tên đăng nhập không được để trống",
            'username.unique'=>"Tên đăng nhập đã được sử dụng",
            'password.required'=>'Mật khẩu không được để trống',
            'password_confirmation.same'=>'Nhập lại mật khẩu không trùng với mật khẩu'
        ] );
        $staff=StaffModel::create([
            'name'=>$r->name,
            'email'=>null,
            'username'=>$r->username,
            'password'=>md5($r->password),
            'id_card_number'=>$r->id_card_number,
            'phone_number'=>$r->phone_number,
            'img_avatar'=>null,
            'staff_status_id'=>1
        ]);
        PrivilegeModel::create([
            'staff_id'=>$staff->id,
            'staff_role_id'=>$r->role
        ]);
        return redirect('/staff/list');
    }
    public function getInfo($id){
        $staff=StaffModel::find($id);
        return view('info',compact('staff'));
    }
    public function changePasswordForm($id){
        $staff=StaffModel::find($id);
        return view('changepassword',compact('staff'));
    }
    public function changePassword($id,Request $r){
        $staff=StaffModel::find($id);       
        if(md5($r->password)==$staff->password){
            $r->validate([
                'password'=>'required',
                'new_password'=>'required|min:8|',
                'password_confirmation'=>'same:new_password'
            ],[
                'password.required'=>'Mật khẩu không được để trống',
                'new_password.required'=>'Mật khẩu không được để trống',
                'new_password.min'=>'Mật khẩu tối thiểu :min kí tự',
                'password_confirmation.same'=>'Nhập lại mật khẩu không trùng với mật khẩu'
            ]);            
            $staff->password=md5($r->new_password);
            $staff->save();
            return redirect('/info/getinfo/'.$id.'')->with('changePasswordSuccess','Đổi mật khẩu thành công');
        }
        else{
            $error='Mật khẩu sai';
            return redirect('/info/changePasswordForm/'.$id.'')->with('passwordfalse',$error);
        }
    }
    public function updateInfo($id,Request $r){
        $r->validate([
            'name'=>'required',
            'id_card_number'=>'required|min:10|',
            'phone_number'=>'required|min:10'
        ],[
            'name.required'=>'Tên không được để trống',
            'id_card_number.required'=>'Số CCCD không được để trống',
            'id_card_number.min'=>'Số CCCD tối thiểu :min kí tự',
            'phone_number.required'=>'Số điện thoại không được để trống',
            'phone_number.min'=>'Số điện thoại tối thiểu :min kí tự'
        ]); 
        $staff=StaffModel::find($id); 
        $staff->name=$r->name;
        $staff->email=$r->email;
        $staff->id_card_number=$r->id_card_number;
        $staff->phone_number=$r->phone_number;    
        if($r->file('avatar')){
            $file=$r->file('avatar')->getClientOriginalName();
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
                $r->file('avatar')->getRealPath(),
                ['public_id' => $fileName]
            );
            $staff->img_avatar=$cloudinary->image($fileName)->resize(Resize::fill(300,300 ))->toUrl();
        }
        $staff->save();
        return redirect('/info/getinfo/'.$id.'');
    }
    public function updateStaffForm($id)
    {
        $role=StaffRoleModel::all();
        $staff=StaffModel::find($id);
        return view('Staff.updateStaff',compact('staff','role'));
    }
    public function updateStaff(Request $r,$id){
        $r->validate([
            'name'=>'required',
            'id_card_number'=>'required|min:10|',
            'phone_number'=>'required|min:10'
        ],[
            'name.required'=>'Tên không được để trống',
            'id_card_number.required'=>'Số CCCD không được để trống',
            'id_card_number.min'=>'Số CCCD tối thiểu :min kí tự',
            'phone_number.required'=>'Số điện thoại không được để trống',
            'phone_number.min'=>'Số điện thoại tối thiểu :min kí tự'
        ]); 
        $staff=StaffModel::find($id); 
        $staff->name=$r->name;
        $staff->email=$r->email;
        $staff->id_card_number=$r->id_card_number;
        $staff->phone_number=$r->phone_number;  
        $staff->save();
        PrivilegeModel::deletePrivilegesByStaff($staff->id);
        PrivilegeModel::create([
            'staff_id'=>$staff->id,
            'staff_role_id'=>$r->role
        ]);
        return redirect('staff/list');
    }
}
