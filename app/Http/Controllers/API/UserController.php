<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UserModel;
class UserController extends BaseController
{
    public function _construct(){
        $this ->middleware('auth:api',['except'=>['login','register']]);
    }
    public function getAll(){
        $user=UserModel::all();
        if($user)
        {
            return response()->json([
            'data'=>$user,
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
    public function register(Request $r){
        $user=UserModel::create([
            'name'=>$r->name,
            'email'=>$r->email,
            'password'=>$r->password,
            'id_card_number'=>$r->id_card_number,
            'phone_number'=>$r->phone_number,
            'log_count'=>0,
        ]);
        if($user)
        {
            return response()->json([
            'data'=>$user,
            'status_code'=>200,
            'message'=>'Thêm user thành công'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'Thêm user thất bại'
            ]);
        }
    }
    
    public function login(Request $r){
        $user=DB::select('select * from users where email= :email and password= :password',['email'=>$r->email,'password'=>$r->password]);
        if($user){    
            if (! $token = auth('api')->attempt($user)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }     
            return $this->createNewToken($token);           
        //     return response()->json([          
        //         'login'=>true,
        //         'status_code'=>200,
        //         'message'=>'done'
        //     ]);
        // }
        // else
        // {
        //     return response()->json([                
        //         'login'=>false,
        //         'status_code'=>404,
        //         'message'=>'error'
        //     ]);
        }
    }
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' =>auth('api')->user()
        ]);
    }
    public function getUserById($id){
        $user = UserModel::getUserById($id);
        if($user)
        {
            return response()->json([
            'data'=>$user,
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
