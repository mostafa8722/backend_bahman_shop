<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("users")->onDelete("cascade");
             
            $table->string("mobile");
            $table->string("code");
            $table->enum("is_used",array(0,1))->default(0);
            $table->enum("type",array("auth","order"))->default("auth");
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
        Schema::dropIfExists('sms_logs');
    }
}
