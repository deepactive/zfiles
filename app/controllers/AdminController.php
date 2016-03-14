<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use Files;
use Input;
use Validator;
use Session;
use Redirect;

class AdminController extends \BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		// 

        function space ( $type, $sub = null ){
            if($sub === null){
                
                $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
                $base = 1024;
                $class = min((int)log($type , $base) , count($si_prefix) - 1);

                return $disk_free_space = sprintf('%1.2f' ,
                $type / pow($base,$class)) . ' ' .      $si_prefix[$class] ;
            
            }
        }
        
        $total = disk_total_space(public_path('/'));
        $free  = disk_free_space('.');
        
        $data = array(
            'title' => 'Admin Dashboard',
            'active' => 'dashboard',
            'settings'=> Settings::find(1),
            'disk_total_space' => space($total),
            'disk_free_space' => space($free),
            'disk_used_space' => space($total-$free),
            'uploadedFiles'   => Files::all()->count(),
            'totalDownloadedFiles' => DB::table('files')->sum('fileDownloadCounter'),
            'totalExpiredFiles' => DB::table('files')
            ->where('userID','=','0')->count()
        );
        
        return View::make('admin.dashboard')->with('data',$data);
	}
    
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
    
    public function settings () {

        $data = array(
            'title' => 'General Settings',
            'active' => 'settings',
            'settings'=> Settings::find(1)

        );

        return View::make('admin.settings')->with('data',$data);
}	
    
    /**
	 * Update a website Settings in storage.
	 *
	 * @return Response
	 */
    
    public function saveSettings () {

        $input = Input::all();
        
        $validator = Validator::make( 
            array(
                'sitename' => $input['sitename'], 
                'email' => $input['email'],
                'site_favicon' => Input::file('site_favicon'),                
                'site_logo' => Input::file('site_logo'),                
            ),
            
            array(
                'sitename' => 'required',
                'email' => 'required|email',
                'site_favicon' => 'image|mimes:png',
                'site_logo' => 'image|mimes:png'
                
            )
        );
            
        if ($validator->fails()){
            
            Session::flash('Message','
            <div id="message-alert" class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              
              <strong>Oops!</strong> 
              Your Action has been Failed Please Check Your Fields.
            </div>
            ');
            return Redirect::to('admin/settings');
            
        }else{
            
            $save = Settings::find(1);
            
            $save->sitename       = $input['sitename'];
            $save->email          = $input['email'];
            $save->description    = $input['description'];
            $save->keywords       = $input['keywords'];
            $save->site_status    = $input['site_status'];
            
            if( Input::file('site_favicon') !== null ){
                
                $fileName = 'favicon.png';
            
                $destinationPath = public_path().'/themes/uploads/';

                Input::file('site_favicon')->move($destinationPath, $fileName);
            }            
            
            if( Input::file('site_logo') !== null ){
                
                $fileName = 'logo.png';
            
                $destinationPath = public_path().'/themes/uploads/';

                Input::file('site_logo')->move($destinationPath, $fileName);
            }
            
            if( $save->save() ){
                
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Your Action has been Successfully Updated.
                </div>
                ');
                
                return Redirect::to('admin/settings');
            }
        }
    }



}
