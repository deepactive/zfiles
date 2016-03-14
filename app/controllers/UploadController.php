<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use uploadSettings;
use Input;
use Files;
use Validator;
use Session;
use Redirect;
use Response;
use Request;
use Auth;

class UploadController extends \BaseController {
	
   
    
    
    /**
	 * Guest Files upload Function.
	 *
	 * @return Response
	 */
        public function guestUploadFile(){
            
            
            
            # Get Signle File 
            
            $file = Input::file('file');
            
            #Get File Extention 
            $fileExt = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);

            # Check allowed file EXT From DB
            #$allowedExt = array('png','jpg','exe','mp3','zip','rar','mp4','pdf','iso');
            $allowedExt = explode( ',' , uploadSettings::find(1)->allowedFilesExt );

            #  Check allowed file Size From DB
            $validator = Validator::make(
                array('file' => $file),
                array('file' => 'required|max:'.(uploadSettings::find(1)->maxFileSize)  )
            );
            
            if ($validator->fails()){
                # If File Size Not Allowed Return Error
                return Response::json('File Size Large', 400);
            
            }else if( !in_array(strtolower($fileExt),$allowedExt) ){
                # If File Ext Not Allowed Return Error
                return Response::json('This file Type is Not Supported', 400);
                
            }else{
                # Init File To Upload
                if($file) {

                    $destinationPath = public_path() . '/../up-files/';
                    
                    $date = time('d-m-Y h:i:s.u');
                    
                    if (!preg_match('/^[\x20-\x7E]+$/', $file->getClientOriginalName() )){
                        
                        function generateRandomString($length = 10) {
                            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < $length; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }
                            return $randomString;
                        }
                        $filename = str_replace(' ','',$date.'_'.generateRandomString(6).'.'
                            .$file->getClientOriginalExtension());
                    }else{
                        $filename = str_replace(' ','',$date.'_'.$file->getClientOriginalName());
                    }

                    

                    $upload_success = $file->move($destinationPath, $filename);
                    
                    # If file Uploaded Success
                    
                    if ($upload_success) {
                        
                        #save files info
                        $files = new Files;
                        
                        # File Name
                        $files->fileName = pathinfo(strtolower(htmlentities(
                            $file->getClientOriginalName())), PATHINFO_FILENAME);
                        
                        # File Path
                        $files->filePath = preg_replace('/\s+/', '',url('/file/'.pathinfo($filename,PATHINFO_FILENAME)));
                        
                        # File Extention
                        $files->fileExt = strtolower($file->getClientOriginalExtension());
                        
                        # User Type 

                        $files->UserID = 0;
                        
                        $files->fileDesc = Session::get('guestSession');
                        
                        # User Ip
                        $files->userIp = Request::getClientIp(true);
                        
                        # File Status
                        $files->fileStatus = 1;

                        # File Downloads Counter
                        $files->fileDownloadCounter = 0;

                        $files->fileSize   = $file->getClientSize() ;
                        
                        # Save File Info                       
                        $files->save();

                        return Response::json('success', 200);                        

                    } else {
                        
                        return Response::json('Cant Upload This File ', 400);
                    }
                }
                
            }
	}

    
    /**
	 * user Upload Files Function.
	 *
	 * @return Response
	 */
        public function uploadFile(){
            
            # Get Signle File 
            
            $file = Input::file('file');
            
            #Get File Extention 
            $fileExt = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);

            # Check allowed file EXT From DB
            #$allowedExt = array('png','jpg','exe','mp3','zip','rar','mp4','pdf','iso');
            $allowedExt = explode( ',' , uploadSettings::find(1)->allowedFilesExt );

            #  Check allowed file Size From DB
            $validator = Validator::make(
                array('file' => $file),
                array('file' => 'required|max:'.(uploadSettings::find(1)->maxFileSize)  )
            );
            
            if ($validator->fails()){
                # If File Size Not Allowed Return Error
                return Response::json('File Size Large', 400);
            
            }else if( !in_array(strtolower($fileExt),$allowedExt) ){
                # If File Ext Not Allowed Return Error
                return Response::json('This file Type is Not Supported', 400);
                
            }else{
                # Init File To Upload
                if($file) {

                    $destinationPath = public_path() . '/../up-files/';
                    
                    $date = time('d-m-Y h:i:s.u');
                    
                    if (!preg_match('/^[\x20-\x7E]+$/', $file->getClientOriginalName() )){
                        
                        function generateRandomString($length = 10) {
                            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < $length; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }
                            return $randomString;
                        }
                        $filename = str_replace(' ','',$date.'_'.generateRandomString(6).'.'
                            .$file->getClientOriginalExtension());
                    }else{
                        $filename = str_replace(' ','',$date.'_'.$file->getClientOriginalName());
                    }

                    

                    $upload_success = $file->move($destinationPath, $filename);
                    
                    # If file Uploaded Success
                    
                    if ($upload_success) {
                        
                        #save files info
                        $files = new Files;
                        
                        # File Name
                        $files->fileName = pathinfo(strtolower(htmlentities(
                            $file->getClientOriginalName())), PATHINFO_FILENAME);
                        
                        # File Path
                        $files->filePath = preg_replace('/\s+/', '',url('/file/'.pathinfo($filename,PATHINFO_FILENAME)));
                        
                        # File Extention
                        $files->fileExt = strtolower($file->getClientOriginalExtension());
                        
                        # User Type 
                        if( Auth::check() ){
                            $files->UserID = Auth::user()->id;
                        }else{
                            $files->UserID = 0;
                            $files->fileDesc = 'null';
                        }
                        # User Ip
                        $files->userIp = Request::getClientIp(true);
                        
                        # File Status
                        $files->fileStatus = 1;

                        # File Downloads Counter
                        $files->fileDownloadCounter = 0;

                        $files->fileSize   = $file->getClientSize() ;
                        
                        # Save File Info
                        $files->save();
                        
                        return Response::json('success', 200);                        

                    } else {
                        
                        return Response::json('Cant Upload This File ', 400);
                    }
                }
                
            }
	}
   
}
