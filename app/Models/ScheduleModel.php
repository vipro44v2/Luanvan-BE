<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    use HasFactory;
    protected $table='schedules';
    protected $primaryKey='id';
    public $fillable=['id','time_start'];
    public $timestamps=false;
}
