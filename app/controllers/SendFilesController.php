<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use uploadSettings;
use Input;
use Carbon;
use User;
use Files;
use File;
use LockFile;
use Mail;
use EmailTemplates;
use EmailSettings;
use Response;
use Request;

class SendFilesController extends \BaseController {

 
    protected $urlUsername;
    protected $userInfo;
    protected $isAdmin;
    protected $adminPreviewMode;
    protected $userFiles;
    protected $topAds;
    protected $bottomAds;
    
    function __construct() {
        
        ## Get UserName From Url 
        $this->urlUsername = Request::path();
        $this->urlUsername = explode("/",$this->urlUsername);
        $this->urlUsername = $this->urlUsername[1];
                        
        ## Get User Personal Info
        $this->userInfo  = User::where('username', '=', $this->urlUsername)->firstOrFail();
        
        ## Get User Files Info
        $this->userFiles = Files::where('userID', '=', $this->userInfo['id'])
            ->orderBy('id','DESC')
            ->get();        
        ## If Admin Preview Mode = true, this Variable will return true
        $this->adminPreviewMode = ( defined('ADMIN_PREVIEW_MODE') ? true : false );
        ## Get User Type ( Admin - Normal )
        $this->isAdmin = ($this->userInfo->level === 'admin') ? true : false;
        
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
    



    // This Function To Return Needed data To Files Table
    public function files() {
		 ini_set('zlib.output_compression', 'Off');

        //  

        $data = array(
            'title'             => 'Send files',
            'nav'               => 'send',
            'settings'          => Settings::find(1),
            'adminPreviewMode'  => $this->adminPreviewMode,
            'userName'          => $this->userInfo['username'],
            'isAdmin'           => $this->isAdmin,
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
            // User Files Loop Data
            'userFiles'         => $this->userFiles

        );
        
        return View::make('user.send')->with('data',$data);
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
            'senderEmail'    => $this->userInfo['email'],
            'recipientEmail' => $recipientEmail
        );
        

        $s = Mail::send('emails::sendFiles',
                        array('data' => $data), function($message)
                        use($recipientEmail, $emailSubject) {
        
          $message->from(EmailSettings::find(1)->emailFromEmail,
                         EmailSettings::find(1)->emailFromName);
                            
            $message->to($recipientEmail, $this->userInfo['username'])
                ->subject( $emailSubject );
        });
        
        return Response::json('sended',200);



    }
    
  

}
