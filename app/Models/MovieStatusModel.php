<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieStatusModel extends Model
{
    use HasFactory;
    protected $table="movie_status";
    protected $primaryKey="id";
    protected $fillable=['id','status','description'];
}
