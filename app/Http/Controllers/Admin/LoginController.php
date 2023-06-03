<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use config\api;
use Session;

class LoginController extends BaseController
{
    function login(Request $request){
        if($request->method('POST')){
            $email=$request->input('email');
            $password=$request->input('password');
            // $user=UserModel::where('email',$email);
            $staff=DB::select('select * from staffs where email= :email and password= :password',['email'=>$email,'password'=>$password]);
            // $staff=Auth::attempt(['email' => $email, 'password' => $password]);
            // var_dump($staff);
            if($staff){
               Session::put('name',$staff[0]->name);
                return redirect('/movie/list');
            }
            else
            {
                echo"<script>alert('Đăng nhập thất bại')</script>";
                return view('login');
            }
        }
       
    }
    public function logout(){
        Session::flush();
        return redirect('/');
    }
}
