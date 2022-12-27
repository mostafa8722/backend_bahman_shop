<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('family');
            $table->string('image');
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique();
            $table->string("national_code")->nullable();
             $table->string("phone")->nullable();
             $table->enum("type",array("personal","commercial"))->default("personal");
            
            $table->string('api_token')->unique();
            $table->enum('level',array("user","customer","cooperator","admin"))->default("user");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('auth')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
