<?php


namespace app\Controllers;

use View;
use DB;
use User;
use Settings;
use Input;
use Hash;
use Validator;
use Redirect;
use Auth;
use Mail;
use EmailTemplates;
use EmailSettings;
use Password;

class RemindersController extends \Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
        $settings = Settings::find(1);
            
        $data = array(
            'title' => $settings['sitename']
        );
		return View::make('home.passwordRemind')->with('data',$data);
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
        $emailSubject = EmailTemplates::where('emailType','=','recoverPasswordTemplate')
                                   ->pluck('emailSubject');
        
        $response = Password::remind(Input::only('email'), function($message)
                                     use($emailSubject){
				$message->subject( $emailSubject ); 
			});
        
		switch ($response )
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', true )->withInput();
			case Password::REMINDER_SENT:
                return Redirect::back()->with('success', true)->withInput();
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);
        
        $settings = Settings::find(1);    
        $data = array(
            'title' => $settings['sitename'],
            'token' => $token
        );
		return View::make('home.passwordReset')->with('data',$data);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
                return Redirect::back()->with('error',
                                            'Password is incorrect');
            case Password::INVALID_TOKEN:
                return Redirect::back()->with('error', 'This Link has Expired or used Before');
			case Password::INVALID_USER:
				return Redirect::back()->with('error', 'This E-mail Is Not Exists');

			case Password::PASSWORD_RESET:
                Session::flash('success',true);
				return Redirect::to( url('auth/login') )
                                ->withInput( Input::all() );
		}
	}

}
