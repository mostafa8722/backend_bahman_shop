<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("label")->nullable();
            $table->string("description")->nullable();
            $table->timestamps();
        });
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("label")->nullable();
            $table->string("description")->nullable();
            $table->timestamps();
        });
        Schema::create('permission_role', function (Blueprint $table) {

            $table->integer("role_id")->unsigned();
            $table->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
            $table->integer("permission_id")->unsigned();
            $table->foreign("permission_id")->references("id")->on("permissions")->onDelete("cascade");
            $table->primary(["role_id","permission_id"]);
        });

        Schema::create('role_user', function (Blueprint $table) {

            $table->integer("role_id")->unsigned();
            $table->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->primary(["role_id","user_id"]);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
