<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order',function(Blueprint $table){
            $table->bigIncrements('id');
            $table ->integer('user_id');
            $table ->integer('hospital_id');
            $table ->string('appointment_date');
            $table->string('email');
            $table->string('name');
            $table ->string('address');
            $table ->string('gender');
            $table ->string('mobile');
            $table ->string('blood_group');
            $table ->integer('age');
            $table ->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
