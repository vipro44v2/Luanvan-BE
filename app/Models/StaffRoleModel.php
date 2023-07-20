<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRoleModel extends Model
{
    use HasFactory;
    protected $table='staff_roles';
    protected $fillable=['role','description'];
    public $timestamps=false;
}
