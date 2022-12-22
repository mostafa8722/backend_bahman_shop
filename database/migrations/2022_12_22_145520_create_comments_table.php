<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("users")->onDelete("cascade");
            $table->integer("product_id")->unsigned();
            $table->foreign("product_id")->references("products")->onDelete("cascade");
            $table->string("body");
            $table->integer("rate1");
            $table->integer("rate2");
            $table->integer("rate3");
            $table->integer("rate4");
            $table->integer("total_rate");
            $table->enum("status",array("pending,","unpublish","publish"));
            

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
        Schema::dropIfExists('comments');
    }
}
