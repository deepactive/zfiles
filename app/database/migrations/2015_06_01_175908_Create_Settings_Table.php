<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('settings', function( $setting ) {
            $setting->increments('id');
            $setting->string('sitename');
            $setting->string('email');
            $setting->string('description');
            $setting->string('keywords');
            $setting->integer('site_status');
            $setting->string('site_favicon');
            $setting->string('site_logo');
            $setting->timestamps();
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
        Schema::drop('settings');
	}

}
