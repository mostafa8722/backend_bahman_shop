<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("users")->onDelete("cascade");
         
            $table->string('title',190);
            $table->string('en_title',190);
            $table->text('body')->nullable();
            $table->text('image')->nullable();
            $table->integer("parent_id")->unsigned();
            $table->foreign("parent_id")->references("categories")->onDelete("cascade");
         
            $table->enum('level',array(1,2,3,4))->default(1);
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
        Schema::dropIfExists('categories');
    }
}
