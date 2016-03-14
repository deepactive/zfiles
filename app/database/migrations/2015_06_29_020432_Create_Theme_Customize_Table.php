<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemeCustomizeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //
        Schema::create('themecustomize', function( $themecustomize ) {
            $themecustomize->increments('id');
            $themecustomize->longText('welcomeText');
            $themecustomize->longText('someHtml');
            $themecustomize->longText('someCss');
            $themecustomize->timestamps();
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
        Schema::drop('themecustomize');
	}

}
