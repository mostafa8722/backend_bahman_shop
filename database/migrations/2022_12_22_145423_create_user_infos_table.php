<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("users")->onDelete("cascade");
             
            $table->string("name");
             $table->string("family");
             $table->string("national_code");
             $table->string("phone");
             $table->enum("type",array("personal","commercial"))->default("personal");
            
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
        Schema::dropIfExists('user_infos');
    }
}
