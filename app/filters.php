<?php


/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/


Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('/');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| Admin Filter
|--------------------------------------------------------------------------
|
| The "admin" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('hasAuth', function() {
    
    if( Auth::check() ){
        
        return Redirect::to('user/'.Auth::user()->username);
    }
});

Route::filter('websiteStatus', function() {

    
if( @Settings::find(1)->site_status == 0 ){
    
    return View::make('home.closeMessage');

}

});



Route::filter('checkUserFrofileAccess', function() {
        
        // Alow Admin To Access Users Profiles
    
    if( Auth::User()->level !== 'admin' ){
                
        // Get UserName From Url
        $urlUsername = Request::path();
        $urlUsername = explode("/",$urlUsername);
        $urlUsername = $urlUsername[1];    
        // Get UserName From Current Auth
        $currentUserName = Auth::user()->username;   
        // Check If User Is In His Url
        if ($urlUsername !== $currentUserName){
            return View::make('home.404');
        }
        
    }else{
        
        $urlUsername = Request::path();
        $urlUsername = explode("/",$urlUsername);
        $urlUsername = $urlUsername[1];
        
        $userExists = User::where('username','=',$urlUsername)->get();
        if(count($userExists) == 0){
            return View::make('home.404');
        }
        $currentUserName = Auth::user()->username;   

        if( $userExists === 0) {
            
            return View::make('home.404');
            
        }else if( $userExists[0]->username !== Auth::User()->username  ){
            
            define('ADMIN_PREVIEW_MODE',true);

        }
        

    }

    
});


Route::filter('isAdmin', function() {
    
    
    if( Auth::User()->level !== 'admin' ){
        
            return View::make('home.404');
    }
    
    
});

/*

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
