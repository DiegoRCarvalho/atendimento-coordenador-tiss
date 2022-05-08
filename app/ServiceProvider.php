<?php

namespace act;

use act\Address;
use act\Contact;
use act\Attendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    public const RELATIONSHIP_SERVICE_PROVIDER_CONTACT = 'service_provider_contacts';
    public const RELATIONSHIP_SERVICE_PROVIDER_ADDRESS = 'service_provider_addresses';
    protected $fillable = ['cpf_cnpj','corporate_name','company_fancy_name','type','created_at','updated_at','attendance_fk', 'protocols_fk'];

    // UM prestador tem N protocolos
    public function ServiceProviderProtocols(){
        return $this->hasMany(Protocol::class, 'service_provider_fk', 'id');
    }

    // N prestadores possuem N endereços
    public function ServiceProviderAddress(){
        return $this->belongsToMany(Address::class, self::RELATIONSHIP_SERVICE_PROVIDER_ADDRESS, 'service_provider', 'address');
    }

    // N prestadores tem N contatos
    public function ServiceProviderContacts(){
        return $this->belongsToMany(Contact::class, self::RELATIONSHIP_SERVICE_PROVIDER_CONTACT, 'service_provider', 'contact');
    }

    // UM prestador é tido em N atendimentos
    public function ServiceProviderAtendences(){
        return $this->belongsTo(Attendance::class, 'service_provider_fk', 'id');
    }

}
