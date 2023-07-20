<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PrivilegeModel extends Model
{
    use HasFactory;
    protected $table='privileges';
    protected $fillable=['staff_id','staff_role_id'];
    public $timestamps=false;
    public function deletePrivilegesByStaff($id){
        DB::delete('delete from privileges where staff_id = ?', [$id]);
    }
}
