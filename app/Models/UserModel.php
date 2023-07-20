<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    use HasFactory;
    protected $table="users";
    protected $primaryKey="id";
    protected $fillable=['id','name','email','password','id_card_number','phone_number','log_count','created_at','updated_at'];  
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }
    public function getUserById($id){
        $user=DB::select('select * from users where id = ?', [$id]);
        return $user;
    }
}

