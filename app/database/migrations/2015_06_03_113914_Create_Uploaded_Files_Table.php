<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadedFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('files', function( $setting ) {
            $setting->increments('id');
            $setting->string('filePath');
            $setting->string('fileName');
            $setting->string('fileExt');
            $setting->integer('userID');
            $setting->string('fileDesc');
            $setting->string('fileSize');
            $setting->integer('fileStatus');
            $setting->integer('fileDownloadCounter');
            $setting->string('userIp');
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
        Schema::drop('files');
	}

}
