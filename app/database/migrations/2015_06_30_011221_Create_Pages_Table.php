<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //
        Schema::create('pages', function( $pages ) {
            $pages->increments('id');
            $pages->integer('pageOrder');
            $pages->string('pageName');
            $pages->string('pageTitle');
            $pages->longText('pageContent');
            $pages->timestamps();
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
        Schema::drop('pages');
	}

}
