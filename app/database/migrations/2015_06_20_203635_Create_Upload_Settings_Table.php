<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('uploadsettings', function( $setting ) {
            $setting->increments('id');
            $setting->bigInteger('maxFileSize')->unsigned();
            $setting->integer('maxUploadsFiles');
            $setting->string('allowedFilesExt');
            $setting->bigInteger('userDiskSpace')->unsigned();
            $setting->string('fileExpireLimit');
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
        Schema::drop('uploadsettings');

	}

}
