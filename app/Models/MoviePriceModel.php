<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoviePriceModel extends Model
{
    use HasFactory;
    protected $table='movie_prices';
    protected $primaryKey='id';
    protected $fillable=["price"];
    public $timestamps=false;
}
