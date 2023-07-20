<?php 
namespace App\Models;
 
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;
 
class StaffModel extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="staffs";
    protected $primaryKey="id";
    protected $fillable=['name','email','username','password','id_card_number','phone_number','img_avatar','created_at','updated_at','staff_status_id'];    

 
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
 
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
 
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
    public function getRole($staff_id){
        $role=DB::select('select * from privileges JOIN staff_roles on privileges.staff_role_id=staff_roles.id where staff_id = ?', [$staff_id]);
        return($role);
    }
    public function getAllStaff(){
        $staff=DB::select('SELECT * FROM staffs JOIN privileges on staffs.id=privileges.staff_id JOIN staff_roles on privileges.staff_role_id=staff_roles.id');
        return $staff;
    }
}
