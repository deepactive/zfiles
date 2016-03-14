<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use uploadSettings;
use Input;
use Carbon;
use Files;
use File;
use LockFile;
use Mail;
use EmailTemplates;
use EmailSettings;
use Hash;

use Redirect;
use Response;
use Request;
use Auth;

class GuestSessionController extends \BaseController {


    protected $topAds;
    protected $bottomAds;
    
    
    function __construct() {
                        
 
            ## Function To Handle Files Size

            function size ( $type, $sub = null ){
                if($sub === null){

                    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
                    $base = 1024;
                    $class = min((int)log($type , $base) , count($si_prefix) - 1);

                    return @$disk_free_space = sprintf('%1.2f' ,
                    $type / pow($base,$class)).' '.$si_prefix[$class] ;

                }
            }
            
            ## ads Data
            $this->topAds = DB::table('advertising')
                ->where('adsPage','=','profile')
                ->where('adsPosition','=','top')
                ->pluck('adsContent');

            $this->bottomAds = DB::table('advertising')
                ->where('adsPage','=','profile')
                ->where('adsPosition','=','bottom')
                ->pluck('adsContent');

        
    }
	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($GuestSession)
	{
		//
        $GuestSessionFile = DB::table('files')
            ->where('fileDesc',$GuestSession)
            ->paginate(20);
        
        if( count($GuestSessionFile) == 0 ){
            return View::Make('home.expiredGuestSession');
        }
        

        $lastFile = $GuestSessionFile[0];
        $created = new Carbon($lastFile->created_at);
        $now = Carbon::now();
        $expire = uploadSettings::find(1)->fileExpireLimit - $now->diffInDays($created) ;
        
        if( $expire <= 0 ){
            return View::Make('home.expiredGuestSession');
        }

        
        $data = array(
            'settings' => Settings::find(1),
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
            'guestFiles' => $GuestSessionFile,
            'totalFiles' => count($GuestSessionFile),
            'SessionExpireAfter' => $expire
            
        );
        
        return View::make('home.guestFiles')->with('data',$data);
        
        
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete()
	{
		//
                
        $file = Files::find(Input::get('id'));
        // check If Guest Owen This File By Ip
    
        if($file && Request::getClientIp() === $file->userIp && $file->userID == 0) {

            
            $fileName = $file->filePath;
            $fileName = explode("/",$fileName);
            $fileName = end($fileName);
            $fileExt  = $file->fileExt;             

            $filePath = public_path('../up-files/').$fileName.'.'.$fileExt;

            $delete = File::delete($filePath);

            if($delete){
                // Delete File From files table
                Files::find(Input::get('id'))->delete();
                
                // Delete File From lockedfiles table If Exists
                $isLock = LockFile::where('fileId','=',Input::get('id'))->delete();
 
                return Response::json('deleted success');
            }else{
                return Response::json('Delete Is Faild');
            }

        }
    }
    

	


	/**
	 * Lock the specified resource in storage.
	 *
	 * @return Response
	 */
	public function lock()
	{
		//
        $file = Files::find(Input::get('eid'));
        
        // check If Guest Owen This File By Ip

        if($file && Request::getClientIp() == $file->userIp && $file->userID == 0) {

            $lockExists = LockFile::where('fileId','=',$file->id)->first();

            if( $lockExists && trim(Input::get('password')) === '' ){

                    $lockExists->delete();
                    return Response::json('unLock success');

            }elseif( $lockExists && trim(Input::get('password')) !== '' ){

                $lockExists->filePassword = Hash::make(Input::get('password'));
                $lockExists->save();
                return Response::json('Change Password success');

            }else if(!$lockExists && trim(Input::get('password')) !== ''){
                $lockedFiles = new LockFile;

                $lockedFiles->fileId = Input::get('eid');
                $lockedFiles->userID = 0;
                $lockedFiles->filePassword = Hash::make(Input::get('password'));

                if($lockedFiles->save()){
                    // If Lock Success
                    return Response::json('Lock success');

                }else{
                    // If Lock Is Fail
                    return Response::json('Lock Is Fails');
                }
            }
        }else{
            return Response::json(400,'Delete Is Faild');

        }

        
	}

  // This Function Used To Send Files	
    public function sendFiles() {

        $recipientEmail = json_decode(Input::get("email"));
        $selectedFiles = Input::get("id");
        
        if(count($recipientEmail) == 0 || count($selectedFiles) == 0){
                    return false;

        }
        
        $files = DB::table('files')
                ->whereIn('id',$selectedFiles)
                ->get();
        
        $emailSubject = EmailTemplates::where('emailType','=','sendFilesTemplate')
                                   ->pluck('emailSubject');
            
        $data = array(
            'files' => $files,
            'senderEmail'    => 'Guest',
            'recipientEmail' => $recipientEmail
        );
        
        $s = Mail::send('emails::sendFiles',
                        array('data' => $data), function($message)
                        use($recipientEmail, $emailSubject) {
        
          $message->from(EmailSettings::find(1)->emailFromEmail,
                         EmailSettings::find(1)->emailFromName);
                            
            $message->to($recipientEmail, 'Guest')
                ->subject( $emailSubject );
        });
        
        return Response::json('sended',200);



    }
  


}
