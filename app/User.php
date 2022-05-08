<?php

namespace act;

use act\Attendance;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public const RELATIONSHIP_USER_ATTENDANCE = 'user_attendances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['registration', 'first_name', 'last_name', 'password', 'level', 'created_at','updated_at','remember_token', 'department_fk'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // N usuários possuem N atendimentos
	public function UserAttendances(){
		return $this->belongsToMany(Attendance::class, self::RELATIONSHIP_USER_ATTENDANCE, 'user', 'attendance');
    }




}
