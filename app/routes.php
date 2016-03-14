<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



if (Request::is('admin') || Request::is('admin/*') ){
    View::addLocation(public_path().'');
}

## Check Token ( For csrf attack Protection )
Route::when('*', 'csrf', array('post','put', 'delete'));

Route::group( array('before'=>'websiteStatus') , function () {
    ## Homepage Route 
    Route::get('/','app\\Controllers\\HomeController@index');
    ## upload file
    Route::post('uploadFile','app\\Controllers\\UploadController@uploadFile');
    ## Guest upload file
    Route::post('guestUploadFile','app\\Controllers\\UploadController@guestUploadFile');
    ## Show Guest Session Files
    Route::get('guest/{guestSession}','app\\Controllers\\GuestSessionController@show');
    Route::delete('guest/{guestSession}/delete','app\\Controllers\\GuestSessionController@delete');
    Route::put('guest/{guestSession}/lock','app\\Controllers\\GuestSessionController@lock');
    Route::post('guest/{guestSession}/sendFiles','app\\Controllers\\GuestSessionController@sendFiles');         

    ## show File
    Route::get('file/{path}','app\\Controllers\\FilesController@showFile');
    ## Download File
    Route::post('file/{path}','app\\Controllers\\FilesController@downloadFile');
    Route::post('file/{path}/downloadLocked','app\\Controllers\\FilesController@downloadLockedFile');
    Route::get('page/{id}','app\\Controllers\\AdminPagesSettingsController@show');

});

## Signed Out Group ( Auth::check == true )
Route::group( array('before'=>'hasAuth'), function () {
    
    ## Login - Signup Controller
    Route::get('auth/{type}','app\\Controllers\\AuthController@index');
    Route::post('auth/login','app\\Controllers\\AuthController@login');
    Route::post('auth/signup','app\\Controllers\\AuthController@signup');
    Route::get('password/remind','app\\Controllers\\RemindersController@getRemind');
    Route::post('password/remind','app\\Controllers\\RemindersController@postRemind');
    Route::get('password/reset/{token}','app\\Controllers\\RemindersController@getReset');
    Route::post('password/reset/{token}','app\\Controllers\\RemindersController@postReset');
});


## Signed In Group ( Auth::check == true )
Route::group( array('before'=>'auth'), function () {
    
    Route::group( array('before'=>'isAdmin') , function () {

        ## Admin Home Routes        
        Route::get('admin','app\\Controllers\\AdminController@index');
        
        ## settings routes
        Route::get('admin/settings','app\\Controllers\\AdminController@settings');
        Route::post('admin/settings','app\\Controllers\\AdminController@saveSettings');
        
        ## Uploader Settings Route
        Route::get('admin/upload','app\\Controllers\\AdminUploadSettingsController@index');
        Route::post('admin/upload','app\\Controllers\\AdminUploadSettingsController@saveUploadSettings');
        
        ## Files Settings Route
        Route::get('admin/files','app\\Controllers\\AdminFilesSettingsController@index');
        
        Route::get('admin/files/delete/{id}','app\\Controllers\\AdminFilesSettingsController@deleteFile');
        
        Route::get('admin/files/deleteAll','app\\Controllers\\AdminFilesSettingsController@deleteAll');                   
        
        Route::get('admin/guestFiles','app\\Controllers\\AdminFilesSettingsController@guestFiles');
        
        
    Route::get('admin/guestFiles/delete/{id}','app\\Controllers\\AdminFilesSettingsController@deleteguestFile');
        
        Route::get('admin/guestFiles/deleteAll','app\\Controllers\\AdminFilesSettingsController@deleteAllguestFiles');
        
        Route::get('admin/guestFiles/deleteExpired','app\\Controllers\\AdminFilesSettingsController@deleteExpiredFiles');
        
        ## users Settings Route
        Route::get('admin/users','app\\Controllers\\AdminUsersSettingsController@index');
        
        Route::get('admin/users/delete/{id}','app\\Controllers\\AdminUsersSettingsController@deleteUser');
        
        Route::get('admin/users/deleteAll','app\\Controllers\\AdminUsersSettingsController@deleteAll');
        
        ## Email Settings Route
        Route::get('admin/email','app\\Controllers\\AdminEmailSettingsController@index');
        
        Route::post('admin/email','app\\Controllers\\AdminEmailSettingsController@saveEmailSettings');
        
        Route::get('admin/emailTemplates','app\\Controllers\\AdminEmailSettingsController@emailTemplates');
     
        Route::post('admin/emailTemplates','app\\Controllers\\AdminEmailSettingsController@saveEmailTemplates');
        
        ## Themes & Templates Settings Routes
        Route::get('admin/themes','app\\Controllers\\AdminTemplateDesignSettingsController@themes');
        
        Route::get('admin/themes/activate/{name}','app\\Controllers\\AdminTemplateDesignSettingsController@savetheme');   
        
        Route::get('admin/themeCustomize','app\\Controllers\\AdminTemplateDesignSettingsController@themesCustomize');
  
        Route::post('admin/themeCustomize','app\\Controllers\\AdminTemplateDesignSettingsController@saveThemesCustomize');
        
        ## Pages Settings Controller
        Route::get('admin/pages','app\\Controllers\\AdminPagesSettingsController@index');
        
        Route::get('admin/pages/create','app\\Controllers\\AdminPagesSettingsController@create');
        
        Route::post('admin/pages/create','app\\Controllers\\AdminPagesSettingsController@store');
        
        Route::get('admin/pages/edit/{id}','app\\Controllers\\AdminPagesSettingsController@edit');
        
        Route::post('admin/pages/edit/{id}','app\\Controllers\\AdminPagesSettingsController@update');
        
        Route::get('admin/pages/delete/{id}','app\\Controllers\\AdminPagesSettingsController@destroy');

        
        ## Advertising Settings Controller
        Route::get('admin/advertising','app\\Controllers\\AdminAdvertisingSettingsController@index');
        
        Route::post('admin/advertising','app\\Controllers\\AdminAdvertisingSettingsController@saveAds');
        
        Route::PUT('admin/advertising/adsContent','app\\Controllers\\AdminAdvertisingSettingsController@getAdsContent');

        ## plugins Settings Route
        Route::get('admin/plugins','app\\Controllers\\AdminPluginsSettingsController@index');
        
        ## Social Settings Route
        Route::get('admin/social','app\\Controllers\\AdminsocialSettingsController@index');
        Route::post('admin/social','app\\Controllers\\AdminsocialSettingsController@saveUploadSettings');

    });

    Route::group( array('before'=>'checkUserFrofileAccess|websiteStatus') , function () {
        
        ## User Dashboard Route
        Route::get('user/{username}','app\\Controllers\\UserController@dashboard');
        ## Upload Route
        Route::get('user/{username}/upload','app\\Controllers\\UserController@upload');
        ## User upload Post Route
        Route::post('user/{username}/upload','app\\Controllers\\UploadController@uploadFile');
        ## User Files Route
        Route::get('user/{username}/files','app\\Controllers\\UserController@files');
        ## Delete File Ajax
        Route::delete('user/{username}/files/delete','app\\Controllers\\UserController@deleteFile');
        ## Lock File Ajax
        Route::put('user/{username}/files/lock','app\\Controllers\\UserController@lockFile');
         ## Send Files Route
        Route::get('user/{username}/send','app\\Controllers\\SendFilesController@files');
        Route::post('user/{username}/send','app\\Controllers\\SendFilesController@sendFiles');         
        ## Settings Route
        Route::get('user/{username}/settings','app\\Controllers\\UserController@settings');
        Route::post('user/{username}/settings','app\\Controllers\\UserController@changeSettings');
        ## Pages
        Route::get('user/{username}/pages','app\\Controllers\\UserController@pages');


    });
    
    ## Logout Route 
    Route::get('logout','app\\Controllers\\AuthController@logout');

});

