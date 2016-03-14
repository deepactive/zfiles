<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		  Schema::create('emailsettings', function( $setting ) {
            $setting->increments('id');
            $setting->string('emailFromName');
            $setting->string('emailFromEmail');
            $setting->string('SMTPHostAddress');
            $setting->string('SMTPHostPort');
            $setting->string('EMailEncryptionProtocol');
            $setting->string('SMTPServerUsername');
            $setting->string('SMTPServerPassword');
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
        Schema::drop('emailSettings');
	}

}
