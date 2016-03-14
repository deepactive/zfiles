<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use Advertising;
use Input;
use Validator;
use Session;
use Redirect;
use Request;
use Response;

class AdminAdvertisingSettingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //
        $data = array(
            'title' => 'Advertising',
            'active' => 'advertising',
            'settings'=> Settings::find(1)

        );
        
        return View::make('admin.advertising')->with('data',$data);	}



	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
    public function getAdsContent()
    {
        if (Request::ajax()){
            $inputs = Input::all();
            $adsContent = DB::table('advertising')
                ->select('adsContent')
                ->where('adsPage', '=', $inputs['page'])
                ->where('adsPosition', '=', $inputs['position'])
                ->pluck('emailSubject');
            return Response::json( $adsContent );
        } 
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function saveAds()
	{
        //
        $input = Input::all();

            $update = DB::table('advertising')
            ->where('adsPage', $input['adsPage'])
            ->where('adsPosition', $input['adsPosition'])
            ->update(['adsContent' => $input['adsContent']]);
            
            if($update){
            
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible"
                role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Your Action has been Successfully Updated.
                </div>
                ');

            }
            
            return Redirect::back()->withInput($input);
        
	}

}
