<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('products')){
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ar_title');
            $table->string('en_title');
            $table->string('company_name')->default('company_name'); 
            $table->unsignedInteger('category_id')->nullable();      
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable()->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }
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