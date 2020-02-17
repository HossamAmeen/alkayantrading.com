<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
date_default_timezone_set("Africa/Cairo") ;
class CreatePriceAtDaysTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('price_at_days', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');      
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->date('day')->default(date("Y-m-d"));
            $table->integer('price_today');
            $table->integer('price_yesterday');
            $table->integer('price_before_yesterday');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('price_at__days');
    }
}