<?php
namespace app\Controllers;

use View;
use DB;
use Settings;
use Files;
use File;
use LockFile;
use User;
use Input;
use Validator;
use Session;
use Redirect;

class AdminUsersSettingsController extends \BaseController {

     
    protected $totalFilesSize;
    protected $usersPaginate;
    
    function __construct() {
        
        $this->usersPaginate = DB::table('users')

            ->orderBy('users.id','desc')
            ->paginate(40);

        
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
            'title' => 'Show Users',
            'ul' => 'users',
            'active' => 'users',
            'settings'=> Settings::find(1),
            'users' => $this->usersPaginate
        );
        
        return View::make('admin.users')->with('data',$data);
	}
    
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
	public function deleteAll()
	{
        // check If user exists 
        $users = User::all();
        
        if( $users ){        
                        
            foreach($users as $user){
                
                if($user->level !== 'admin'){
                    $deleteUser = $user->delete();
                }

            }
            
             if(@$deleteUser){
                 
                 Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  User Account & Files, deleted Successfully .
                </div>
                ');
                
            }
        }
        
        return Redirect::back();
	}


    
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
	public function deleteUser($id)
	{
        // check If user exists 
        $user = User::find($id);
        
        if( $user ){        
            
            // delete User Files 
            $userFiles = DB::table('files')->where('userID','=',$id)->get();
            
            foreach($userFiles as $userFile){
                
                $fileName = $userFile->filePath;
                $fileName = explode("/",$fileName);
                $fileName = end($fileName);
                $fileExt  = $userFile->fileExt;             

                $filePath = public_path('../up-files/').$fileName.'.'.$fileExt;
                // Delete File From Disk
                $delete = File::delete($filePath);
                // Delete File From lockedfiles table If Exists
                $isLock = LockFile::where('fileId','=',$userFile->id)->delete();
                // Delete File From files table
                Files::find($userFile->id)->delete();


            }
            
             if($user->delete()){
                 
                 Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  User Account & Files, deleted Successfully .
                </div>
                ');
                
            }
        }
        
        return Redirect::back();
	}


}
