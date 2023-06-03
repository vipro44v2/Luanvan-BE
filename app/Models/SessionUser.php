<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionUser extends Model
{
    use HasFactory;
    protected $table="session_user";
    protected $primaryKey="id";
    protected $fillable=['id','token','refresh_token','token_expried','refresh_token_expried','user_id'];    
    public $timestamps=false;
}