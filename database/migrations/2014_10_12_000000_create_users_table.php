<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('img')->default('resources\assets\admin\images/avatar-80.png');
            /*
             * roles:
             * 1- System Admin
             * 2- System Supervisor
             */
            $table->integer('role');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
