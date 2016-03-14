<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('users', function($users){
            $users->increments('id');
            $users->string('username');
            $users->string('password');
            $users->string('email');
            $users->string('level');
            $users->string('last_login');
            $users->timestamps();
            $users->rememberToken();


        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::drop('users');

	}

}
