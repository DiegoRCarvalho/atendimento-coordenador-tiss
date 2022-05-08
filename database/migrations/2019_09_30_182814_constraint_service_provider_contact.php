<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintServiceProviderContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_provider_contacts', function (Blueprint $table) {
            $table->unsignedInteger('service_provider');
            $table->unsignedInteger('contact');

            $table->foreign('service_provider')->references('id')->on('service_providers')->onDelete('cascade');
            $table->foreign('contact')->references('id')->on('contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_provider_contacts', function (Blueprint $table) {
            $table->dropColumn(['service_provider', 'contact']);
        });
    }
}
