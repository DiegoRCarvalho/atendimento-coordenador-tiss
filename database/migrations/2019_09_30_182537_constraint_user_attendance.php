<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintUserAttendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_attendances', function (Blueprint $table) {
            $table->unsignedInteger('user');
            $table->unsignedInteger('forward_to')->nullable();
            $table->longText('note')->nullable();
            $table->unsignedInteger('error_detail_fk');
            $table->unsignedInteger('solution_detail_fk')->nullable();
            $table->unsignedInteger('attendance');

            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('forward_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('attendance')->references('id')->on('attendances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_attendances', function (Blueprint $table) {
            $table->dropColumn(['user' , 'attendance', 'action', 'note']);
        });
    }
}
