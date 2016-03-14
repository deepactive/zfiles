<?php

namespace app\Controllers;

use View;
use DB;
use User;
use Settings;
use Input;
use Carbon;
use Hash;
use Validator;
use Redirect;
use Auth;
use Mail;
use EmailTemplates;
use EmailSettings;

class AuthController extends \BaseController {

    /**
     * Show Auth Page (login - Signup).
     *
     * @return Response
     */
    public function index($type) {
        //
        if($type === 'login' || $type === 'signup' ){
            
            $settings = Settings::find(1);
            
            $data = array(
                'title' => $settings['sitename'], 
                'type'  => $type
            );
            return View::make('home.login-signup')->with('data',$data);
        }

    }


	/**
	 * Check Login Form  
	 *
	 * @return Response
	 */
	public function login() {
		// Get Form Inputs
        $inputs = Input::all();

        $rules  = array (
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ); 
        
        $validator = Validator::make($inputs,$rules);
        
        if( $validator->fails() ){
            
            return Redirect::to('auth/login')
                    ->WithInput()
                    ->WithErrors($validator);
        }else {
            
            $method = array (
                'email'    => $inputs['email'],
                'password' => $inputs['password']
            );
            
            $auth = Auth::attempt($method,false); 
            
            if( $auth ) {
                $Updatelastlogin = User::find(Auth::user()->id);
                $Updatelastlogin->last_login = Carbon::now(); 
                $Updatelastlogin->save(); 
                return Redirect::intended('user/'.strtolower(Auth::user()->username));
            
            }else{
                
                return Redirect::to('auth/login')
                        ->WithInput()
                        ->WithErrors('Incorrect username or password..');
            }
        }
    }


	/**
	 * Store and Create New User
	 *
	 * @return Response
	 */
	public function signup() {
        
		// Get Form Inputs
        $inputs = Input::all();
        
        $rules  = array (
            'username'       => 'required|min:5|regex:/^[A-Za-z0-9_.-]+$/|
                                 max:15|unique:users,username',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ); 
        
        $validator = Validator::make($inputs,$rules);
        
        if( $validator->fails() ){
            
            
            return Redirect::to('auth/signup')
                    ->withErrors($validator)
                    ->withInput($inputs);
        }else {
            
            $user = new User;
            
            $user->username = strtolower($inputs['username']);
            $user->email = $inputs['email'];
            $user->password = Hash::make( $inputs['password'] );
            $user->level = 'user';

            if( $user->save() ){
                $method = array (
                    'email'    => $inputs['email'],
                    'password' => $inputs['password'] 
                );

                $auth = Auth::attempt($method,false);

                if( $auth ) {
                    
                    $data = array(
                        'username' => $inputs['username'],
                        'email' => $inputs['email'],
                    );
                    
                    $emailSubject = EmailTemplates::where('emailType','=','welcomeTemplate')
                                   ->pluck('emailSubject');

              Mail::send('emails::auth.welcome',
                        array('data' => $data), function($message) use ($emailSubject){
        
          
                            $message->from(EmailSettings::find(1)->emailFromEmail,
                                           EmailSettings::find(1)->emailFromName);
                            
            
                            $message->to(Input::get("email"),Input::get("username") )
                                ->subject( $emailSubject );
        
                        });
                    
                    return Redirect::intended('user/'.Auth::user()->username)
                        ->with('message',true);
                    

                }else{

                    return Redirect::to('auth/signup')
                            ->withInput()
                            ->WithErrors(' Please check your entry and try again..');
                }
            }
        }
    }

	
    /**
	 * Logout User
	 *
	 * @return Response
	 */    
    
    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }


}
