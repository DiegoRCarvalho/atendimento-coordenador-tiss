<?php

namespace act;

use act\Attendance;
use act\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['contact_name','ddd','telephone','telephone_extension','created_at','updated_at'];

    // UM contato é tido por N atendimentos
    public function ContactAtendences(){
        return $this->belongsTo(Attendance::class, 'contact_fk', 'id');
    }

    // N contatos são tidos por N prestadores
    public function ContactServiceProviders(){
        return $this->belongsToMany(ServiceProvider::class, ServiceProvider::RELATIONSHIP_SERVICE_PROVIDER_CONTACT,'contact','service_provider');
    }
}
