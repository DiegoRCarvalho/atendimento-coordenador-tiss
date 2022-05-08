<?php

namespace act;

use act\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    protected $fillable = ['protocol','created_at','updated_at','service_provider_fk'];

    // N protocolos são tidos por UM PRESTADOR
    public function ServiceProviderProtocols(){
        return $this->belongsTo(ServiceProvider::class, 'service_provider_fk', 'id');
    }
}
