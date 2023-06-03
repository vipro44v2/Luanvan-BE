<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorModel extends Model
{
    use HasFactory;
    protected $table="director";
    protected $primaryKey="id";
    protected $fillable=['id','name','gender','description'];
}
