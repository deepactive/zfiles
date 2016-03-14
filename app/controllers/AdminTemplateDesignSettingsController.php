<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use Themes;
use ThemeCustomize;
use Input;
use Validator;
use Session;
use Redirect;

class AdminTemplateDesignSettingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function themes()
	{
        //
        $themes = Themes::all();
        
        $data = array(
            'title' => 'Themes',
            'ul' => 'templateDesign',
            'active' => 'templateDesign',
            'settings'=> Settings::find(1),
            'themes'=> $themes

        );
        
        return View::make('admin.themes')->with('data',$data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function savetheme($name) {
		//
        $themes = Themes::all();
        
        foreach($themes as $theme){

            $updateStatus = Themes::find($theme->id);
            $updateStatus->themeStatus = 0;
            $updateStatus->save();
            
        }
        
        DB::table('themes')
            ->where('themeName','=',$name)
            ->update(array('themeStatus' => 1));

        
        return Redirect::back();

    }


	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function themesCustomize()
	{
		//
        $data = array(
            'title' => 'Theme Customize',
            'ul' => 'templateDesign',
            'active' => 'themeCustomize',
            'settings'=> Settings::find(1)

        );
        
        return View::make('admin.themeCustomize')->with('data',$data);

	}


	/**
	 * Store a newly created resource in storage.
	 * @return Response
	 */
	public function saveThemesCustomize()
	{
		//
                
        $input = Input::all();
        
        $save = ThemeCustomize::find(1);

        if(Input::file('background') !== null ){
          
            $validator = Validator::make( 
                array( 'background' => Input::file('background') ),
                array('background' => 'image|mimes:jpeg')
            );

            if ($validator->fails()){

                Session::flash('Message','
                <div id="message-alert" class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                  <strong>Oops!</strong> 
                    Background Image Must Be jpg/jpeg .
                </div>
                ');

                return Redirect::back();

            }
            
            
            $fileName = 'header.jpg';
            $activeThemeFolder = Themes::where('ThemeStatus','=','1')->pluck('themeFileName');
            $destinationPath = public_path().'/themes/'.$activeThemeFolder.'/assets/img/';

            Input::file('background')->move($destinationPath, $fileName);

        }
            
            
            $save->welcomeText       = $input['welcomeText'];
            $save->someHtml          = $input['someHtml'];
            $save->someCss           = $input['someCss'];
            
            
            if( $save->save() ){
                
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Your Action has been Successfully Updated.
                </div>
                ');
                
                
            }else{
                
                Session::flash('Message','
                <div id="message-alert" class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                  <strong>Oops!</strong> 
                  Your Action has been Failed Please Check Your Fields.
                </div>
                ');

            }
            
        return Redirect::back();


	}


}
