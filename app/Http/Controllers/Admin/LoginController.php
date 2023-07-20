<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use App\Models\StaffModel;
use config\api;
use Session;

class LoginController extends BaseController
{
    function login(Request $request){
        if($request->method('POST')){
            $username=$request->input('username');
            $password=$request->input('password');
            $staff=DB::select('select * from staffs where username= :username ',['username'=>$username]);
            $role=StaffModel::getRole($staff[0]->id);
            if($staff[0]->password==md5($password)){
               Session::put('staff',['id'=>$staff[0]->id,'name'=>$staff[0]->name,'avatar'=>$staff[0]->img_avatar,'role_id'=>$role[0]->staff_role_id,'role'=>$role[0]->role]);
                return redirect('/home');
            }
            else
            {
                $error='Sai tài khoản hoặc mật khẩu';
                return redirect('/')->with('faillogin',$error);
            }
        }
       
    }
    public function logout(){
        Session::flush();
        return redirect('/');
    }
}
