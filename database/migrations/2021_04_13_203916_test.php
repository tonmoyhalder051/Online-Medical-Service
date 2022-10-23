<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Test extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('test', function (blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('hospital_id');
            $table->integer('service_type');
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->integer('discount');
            $table->integer('active');
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
        //
    }
}
