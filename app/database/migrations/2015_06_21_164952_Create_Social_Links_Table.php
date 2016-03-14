<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
        Schema::create('social', function( $setting ) {
            $setting->increments('id');
            $setting->string('facebookLink');
            $setting->string('twitterLink');
            $setting->string('googlePlusLink');
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
        Schema::drop('social');

	}

}
