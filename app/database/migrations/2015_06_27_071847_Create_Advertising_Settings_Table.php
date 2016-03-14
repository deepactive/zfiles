<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisingSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('advertising', function( $advertising ) {
            $advertising->increments('id');
            $advertising->string('adsPosition');
            $advertising->string('adsPage');
            $advertising->longText('adsContent');
            $advertising->timestamps();
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
        Schema::drop('advertising');
	}

}
