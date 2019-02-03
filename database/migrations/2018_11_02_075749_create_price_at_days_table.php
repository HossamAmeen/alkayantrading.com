<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            ->onDelete('set null');
            $table->unsignedInteger('day_id');      
            $table->foreign('day_id')->references('id')->on('days')->onUpdate('cascade')
            ->onDelete('set null');
            $table->integer('price');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('set null');
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