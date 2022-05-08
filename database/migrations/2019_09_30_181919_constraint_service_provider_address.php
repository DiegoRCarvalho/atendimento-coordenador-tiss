<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintServiceProviderAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_provider_addresses', function (Blueprint $table) {
            $table->unsignedInteger('service_provider');
            $table->unsignedInteger('address');

            $table->foreign('service_provider')->references('id')->on('service_providers')->onDelete('cascade');
            $table->foreign('address')->references('id')->on('addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_provider_addresses', function (Blueprint $table) {
            $table->dropColumn(['service_provider', 'address']);
        });
    }
}
