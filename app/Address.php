<?php

namespace act;

use act\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['address', 'number', 'complement', 'neighborhood', 'city', 'uf','created_at','updated_at', 'service_providers_fk'];

    // N endereço são tido por N prestadores
    public function AddressServiceProviders(){
        return $this->belongsToMany(ServiceProvider::class, ServiceProvider::RELATIONSHIP_SERVICE_PROVIDER_ADDRESS,'address','service_provider');
    }
}
