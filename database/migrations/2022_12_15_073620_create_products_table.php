<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("users")->onDelete("cascade");
         
            $table->integer("category_id")->unsigned();
            $table->foreign("category_id")->references("categories")->onDelete("cascade");
         
            $table->integer("seller_id")->unsigned();
            $table->foreign("seller_id")->references("sellers")->onDelete("cascade");
            $table->integer("brand_id")->unsigned();
            $table->foreign("brand_id")->references("brands")->onDelete("cascade");
            $table->string('title',190);
            $table->string('en_title',190);
            
            $table->text('abstract')->nullable(); 
            $table->text('discription')->nullable(); 
            $table->text('price')->nullable(); 
            $table->integer('limited_number')->default(10); 
            $table->enum('isAvailable',array(false,true));
            $table->json("images")->nullable();
            $table->json("details")->nullable();
            $table->json("features")->nullable();
            $table->json("colors")->nullable();
            $table->json("sizes")->nullable();
            $table->enum("status",array("draft","release","unrelease"))->default("draft");

          
            
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
        Schema::dropIfExists('products');
    }
}
