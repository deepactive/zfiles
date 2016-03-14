<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use Social;
use Input;
use Validator;
use Session;
use Redirect;

class AdminsocialSettingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $data = array(
            'title' => 'Social Settings',
            'active' => 'social',
            'settings'=> Settings::find(1),
            'socialLinks'=> Social::find(1)

        );
        return View::make('admin.social')->with('data',$data);
	}

    /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    
    public function saveUploadSettings(){
        
        $input = Input::all();
                
            
            $save = Social::find(1);
            
            $save->facebookLink       = $input['facebookLink'];
            $save->twitterLink          = $input['twitterLink'];
            $save->googlePlusLink    = $input['googlePlusLink'];

            
            if( $save->save() ){
                
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Your Action has been Successfully Updated.
                </div>
                ');
                
                return Redirect::to('admin/social');
                
            }else{
                
                Session::flash('Message','
                <div id="message-alert" class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                  <strong>Oops!</strong> 
                  Your Action has been Failed Please Check Your Fields.
                </div>
                ');
                return Redirect::to('admin/social');

            }
        }
    }

