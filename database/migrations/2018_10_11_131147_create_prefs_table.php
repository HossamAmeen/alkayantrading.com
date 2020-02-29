<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('prefs')){
        Schema::create('prefs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('en_title')->default('alkayan');
            $table->string('ar_title')->default('الكيان');
            $table->string('arAddress')->nullable();
            $table->string('enAddress')->nullable();
            $table->string('enDescription')->nullable();
            $table->string('arDescription')->nullable();
            $table->string('phone')->nullable();
            $table->string('arMainAddress')->nullable();
            $table->string('enMainAddress')->nullable();
            $table->string('mainEmail')->nullable();
            $table->string('facebook')->nullable();
            $table->string('whatsapp',60)->nullable();
            $table->string('twitter')->nullable();
            $table->string('instgram')->nullable();
            $table->string('linkedin')->nullable();
            $table->unsignedInteger('user_id')->nullable();
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
        Schema::dropIfExists('prefs');
    }
}
