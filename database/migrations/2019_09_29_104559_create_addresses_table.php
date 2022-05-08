<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address', 80);
            $table->integer('number')->nullable();
            $table->string('complement', 30)->nullable();
            $table->string('neighborhood', 50);
            $table->string('city', 50);
            $table->string('uf', 2);
            $table->string('zipcode', 16);
            $table->boolean('main_address');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
