<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use Auth;
use Validator;
use Session;
use Redirect;

class HomeController extends \BaseController {

     protected $guestSession;
    
    function __construct() {
        
            if( !Auth::check() ){
                
                $this->guestSession = str_random(40);
                
                Session::put('guestSession', $this->guestSession);
                
            }
                    
    }
    
	
    /*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function index() {
        
        $topAds = DB::table('advertising')
            ->where('adsPage','=','home')
            ->where('adsPosition','=','top')
            ->pluck('adsContent');
        
        $bottomAds = DB::table('advertising')
            ->where('adsPage','=','home')
            ->where('adsPosition','=','bottom')
            ->pluck('adsContent');
            
        $data = array(
            
            'settings' => Settings::find(1),
            'topAds' => $topAds,
            'bottomAds' => $bottomAds
        );
        
        // If user isLogged Rdirect To Profile
        if( Auth::check() ){
            
            return Redirect::to('user/'.Auth::user()->username)->with('data',$data);
        }

        
		return View::make('home.home')->with('data',$data);
	}
    
}
