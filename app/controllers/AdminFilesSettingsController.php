<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use Files;
use File;
use LockFile;
use Session;
use Redirect;

class AdminFilesSettingsController extends \BaseController {

     
    protected $totalFilesSize;
    protected $filesPaginate;
    
    function __construct() {
        
        $this->filesPaginate = DB::table('files')
            ->join('users', 'files.userID', '=', 'users.id')
            ->select('files.*','users.username')
            ->orderBy('files.id','desc')
            ->paginate(20);

        
        ## Function To Handle Files Size
        
        function size ( $type, $sub = null ){
            if($sub === null){
                
                $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
                $base = 1024;
                $class = min((int)log($type , $base) , count($si_prefix) - 1);

                return @$disk_free_space = sprintf('%1.2f' ,
                $type / pow($base,$class)) . ' ' .      $si_prefix[$class] ;
            
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
            'title' => 'Users Files',
            'ul' => 'files',
            'active' => 'files',
            'settings'=> Settings::find(1),
            'files' => $this->filesPaginate
        );
        
        return View::make('admin.files')->with('data',$data);
	}
    
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function guestFiles()
	{
		//
        $data = array(
            'title' => 'Anonymous Files',
            'ul' => 'files',
            'active' => 'guestFiles',
            'settings'=> Settings::find(1),
            'files' => Files::where('userID','=','0')->orderBy('id','desc')
            ->paginate(20)
        );
        
        return View::make('admin.guestFiles')->with('data',$data);
	}
    
    /**
	 * Delete File Function.
	 *
	 * @return Response
	 */
    public function deleteFile($id) {
		
        // check If File exists This File
        $file = Files::find($id);
        
        if( $file ){
            
            $fileName = $file->filePath;
            $fileName = explode("/",$fileName);
            $fileName = end($fileName);
            $fileExt  = $file->fileExt;             

            $filePath = public_path('../up-files/').$fileName.'.'.$fileExt;
            
            // Delete File From Disk
            $deletePath = File::delete($filePath);
            // Delete File From files table
            $delete = Files::find($id)->delete();
                
            // Delete File From lockedfiles table If Exists
            $isLock = LockFile::where('fileId','=',$id)->delete();
 
            if($deletePath || $delete){

                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  File has been Successfully Deleted.
                </div>
                ');
                
            }else{
                
            Session::flash('Message','
                <div id="message-alert" class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                  <strong>Oops!</strong> 
                  Your Action has been Failed .
                </div>
                ');
                
            }

        }
        return Redirect::back();
	}

    /**
	 * Delete All Files Function.
	 *
	 * @return Response
	 */
    public function deleteAll() {
		
        // check If User Owen This File
        $files = DB::table('files')->where('userID','!=','0')->get();
        
        if( $files ){

            foreach ($files as $file){
                
                $fileName = $file->filePath;
                $fileName = explode("/",$fileName);
                $fileName = end($fileName);
                $fileExt  = $file->fileExt;             

                $filePath = public_path('../up-files/').$fileName.'.'.$fileExt;

                $delete = File::delete($filePath);
                // Delete File From lockedfiles table If Exists
                $isLock = LockFile::where('fileId','=',$file->id)->delete();
                                // Delete File From files table
                Files::find($file->id)->delete();
            }


        }
        
        if($files){
                 
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Files has been Deleted Successfully.
                </div>
                ');
                
            }else{
                
            Session::flash('Message','
                <div id="message-alert" class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                  <strong>Oops!</strong> 
                  No Users Files Found.
                </div>
                ');
                
            }
        
        return Redirect::back();
	}
    
    
    /**
	 * Delete All Guests Files Function.
	 *
	 * @return Response
	 */
    public function deleteAllguestFiles() {
		
        // check If User Owen This File
        $files = DB::table('files')->where('userID','=','0')->get();
        
        if( $files ){

            foreach ($files as $file){
                
                $fileName = $file->filePath;
                $fileName = explode("/",$fileName);
                $fileName = end($fileName);
                $fileExt  = $file->fileExt;             

                $filePath = public_path('../up-files/').$fileName.'.'.$fileExt;

                $delete = File::delete($filePath);
                // Delete File From lockedfiles table If Exists
                $isLock = LockFile::where('fileId','=',$file->id)->delete();
                                // Delete File From files table
                Files::find($file->id)->delete();
            }


        }
        
        if($files){
                 
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Files has been Deleted Successfully.
                </div>
                ');
                
            }else{
                
            Session::flash('Message','
                <div id="message-alert" class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                  <strong>Oops!</strong> 
                  No Anonymous Files Found.
                </div>
                ');
                
            }
        
        return Redirect::back();
	}
    
       /**
	 * Delete All expired Files Function.
	 *
	 * @return Response
	 */
    public function deleteExpiredFiles() {
		
        // check If File Exists
        $files = DB::table('files')->where('userID','=','0')->get();
        
        if( $files ){

            foreach ($files as $file){
                
                $fileName = $file->filePath;
                $fileName = explode("/",$fileName);
                $fileName = end($fileName);
                $fileExt  = $file->fileExt;             
                  
                $created = new Carbon($file->created_at);

                $now = Carbon::now();
                $expire = $now->diffInDays($created);
                
                if( $expire >= uploadSettings::find(1)->fileExpireLimit ){
                define('DELETED',true);
                $filePath = public_path('../up-files/').$fileName.'.'.$fileExt;

                $delete = File::delete($filePath);
                // Delete File From lockedfiles table If Exists
                $isLock = LockFile::where('fileId','=',$file->id)->delete();
                                // Delete File From files table
                Files::find($file->id)->delete();
                
                }
            }

             if(defined('DELETED')){
                 
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Anonymous Expired Files has been Deleted.
                </div>
                ');
                
            }else{
                
            Session::flash('Message','
                <div id="message-alert" class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                  <strong>Sorry!</strong> 
                  No Anonymous Expired Files has been Found.
                </div>
                ');
                
            }

        }
        
       
        
        return Redirect::back();
	}

    

}
