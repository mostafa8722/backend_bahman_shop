<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id")->unsigned()->default(0);
            $table->foreign("product_id")->references("products")->onDelete("cascade");
         
            $table->integer("category_id")->unsigned()->default(0);
            $table->foreign("category_id")->references("categories")->onDelete("cascade");
         
            $table->string('title',190);
            $table->text('body')->nullable();
            $table->enum('type',array("category","product"));
            $table->string('image',190)->nullable();
          
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
        Schema::dropIfExists('banners');
    }
}
