<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateThemesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
				//
        Schema::create('themes', function( $themes ) {
            $themes->increments('id');
            $themes->integer('themeStatus');
            $themes->string('themeName');
            $themes->string('themeFileName');
            $themes->timestamps();
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
        Schema::drop('themes');
	}

}
