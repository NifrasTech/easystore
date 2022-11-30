<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'store_id',
        'username'
    ];

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

    public function scopeJoined($query)
	{
		return $query->select('users.*','stores.name as store_name','user_roles.role')
					 ->leftJoin("stores","stores.id","=","users.store_id")
					 ->leftJoin("user_roles","user_roles.id","=","users.role_id")
					 ->where("role_id","!=",1);
	}

    public function checkPermission($value){

        $permission = UserRole::find($this->role_id);
        $permission = explode(",", $permission->permission);

        if (in_array($value, $permission)){
            return true;
        }else{
            return false;
        }
    }

    public function getPermission(){
        $permission = UserRole::find($this->role_id);
        return explode(",", $permission->permission);
    }
}
