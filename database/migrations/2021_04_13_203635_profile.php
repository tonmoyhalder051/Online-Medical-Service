<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Profile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        schema::create('profile',function(blueprint $table){

            $table ->integer('user_id');
            $table ->integer('hospital_id');
            $table ->string('blood_group');
            $table ->string('address');
            $table ->string('gender');
            $table ->string('mobile');
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
