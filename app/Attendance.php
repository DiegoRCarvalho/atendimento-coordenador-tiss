<?php

namespace act;

use act\User;
use act\Contact;
use act\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['created_at','updated_at', 'contact_fk', 'service_provider_fk', 'action'];

    // UM atendimento possui UM prestador
    public function AtendanceServiceProvider(){
        return $this->hasOne(ServiceProvider::class, 'id', 'service_provider_fk');
    }

    // UM atendimento possui UM contato
    public function AttendanceContact(){
        return $this->hasOne(Contact::class, 'id', 'contact_fk');
    }

    // N atendimentos são tidos por N usuários
    public function AttendanceUsers(){
        return $this->belongsToMany(User::class, User::RELATIONSHIP_USER_ATTENDANCE,'attendance','user');
    }


}
