<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','photo_id','active_status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
     * Relationship to role
     * */
    public function role(){
        return $this->belongsTo(Role::class);
    }

    /*
     * Relationship to active status
     * */
    public function activeStatus(){
        return $this->belongsTo(ActiveStatus::class);
    }

    /*
     * Relationship with the photos
     * */
    public function photo(){
        return $this->belongsTo(Photo::class);
    }

    /*
     * Method to check if user is admin
     * */
    public function isAdmin(){
        if($this->role->name == "administrator"){
            return true;
        }

        return false;
    }

    /*
     * Method to check if user is active
     * */
    public function isActive(){
        if($this->activeStatus->name == "active"){
            //echo "You are active";
            return true;
        }
            //echo "You are not active";
            return false;
    }
}
