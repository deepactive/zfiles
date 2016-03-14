<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use uploadSettings;
use Files;
use Input;
use Validator;
use Session;
use Redirect;

class AdminUploadSettingsController extends \BaseController {

     function __construct() {
        
        ## Function To Handle Files Size
        
            function convertToBytes($from,$return){
                
                $number=$from;
                switch($return){
                    case "KB":
                        return $number*1024;
                    case "MB":
                        return $number*pow(1024,2);
                    case "GB":
                        return $number*pow(1024,3);
                    case "TB":
                        return $number*pow(1024,4);
                    case "PB":
                        return $number*pow(1024,5);
                    default:
                        return $from;
                }
            }
            
         function convertFromBytes($from,$return){
                
                $number=$from;
                switch($return){
                    case "KB":
                        return $number/1024;
                    case "MB":
                        return $number/pow(1024,2);
                    case "GB":
                        return $number/pow(1024,3);
                    case "TB":
                        return $number/pow(1024,4);
                    case "PB":
                        return $number/pow(1024,5);
                    default:
                        return $from;
                }
            }
        
    }
    
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $data = array(
            'title' => 'Upload Settings',
            'active' => 'upload',
            'settings'=> Settings::find(1),
            'uploadSettings'=> uploadSettings::find(1),
            'maxFileSize'=> convertFromBytes(uploadSettings::find(1)->maxFileSize,'MB'),
            'userDiskSpace'=> convertFromBytes(uploadSettings::find(1)->userDiskSpace,'MB')

        );
        return View::make('admin.upload')->with('data',$data);
	}


	/**
	 * Save Upload Settings form.
	 *
	 * @return Response
	 */
	public function saveUploadSettings()
	{
		//
        
        $input = Input::all();
        
        $validator = Validator::make( 
            array(
                'maxFileSize' => $input['maxFileSize'], 
                'maxUploadsFiles' => $input['maxUploadsFiles'],
                'AllowedFilesType' => $input['AllowedFilesType'],
                'userDiskSpace' => $input['userDiskSpace'],
                'fileExpireLimit' => $input['fileExpireLimit']
            ),
            
            array(
                'maxFileSize' => 'required|numeric',
                'maxUploadsFiles' => 'required|numeric',
                'AllowedFilesType' => 'required',
                'userDiskSpace' => 'required|numeric',
                'fileExpireLimit' => 'required|numeric',
                
            )
        );
            
        if ($validator->fails()){

            return Redirect::to('admin/upload')
                            ->withInput()
                            ->WithErrors($validator);
            
        }else{

            $save = uploadSettings::find(1);
            
            $save->maxFileSize       = convertToBytes($input['maxFileSize'],'MB') ;
            $save->maxUploadsFiles    = $input['maxUploadsFiles'];
            $save->AllowedFilesExt    = $input['AllowedFilesType'];
            $save->userDiskSpace       = convertToBytes($input['userDiskSpace'],'MB') ;
            $save->fileExpireLimit    = $input['fileExpireLimit'];
            
            if( $save->save() ){
                
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Your Action has been Successfully Updated.
                </div>
                ');
                
                return Redirect::to('admin/upload');
            }
        }
	}


}
