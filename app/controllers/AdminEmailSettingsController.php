<?php


namespace app\Controllers;

use View;
use DB;
use Settings;
use EmailSettings;
use EmailTemplates;
use Input;
use Validator;
use Session;
use Redirect;
use Crypt;

class AdminEmailSettingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $data = array(
            'title' => 'Email Settings',
            'ul' => 'email',
            'active' => 'email',
            'settings'=> Settings::find(1),
        );
        
        return View::make('admin.email')->with('data',$data);
	}
    
	
    /**
	 * Store a website Settings in storage.
	 *
	 * @return Response
	 */
    public function saveEmailSettings(){
        
        
		//
        $input = Input::all();
        
        $validator = Validator::make( 
            array(
                'emailFromName' => $input['emailFromName'], 
                'emailFromEmail' => $input['emailFromEmail'],
                'SMTPHostAddress' => $input['SMTPHostAddress'],
                'SMTPHostPort' => $input['SMTPHostPort'],
                'EMailEncryptionProtocol' => $input['EMailEncryptionProtocol'],
                'SMTPServerUsername' => $input['SMTPServerUsername'],
                'SMTPServerPassword' => $input['SMTPServerPassword']
            ),
            
            array(
                'emailFromName' => 'required',
                'emailFromEmail' => 'required',
                'SMTPHostPort' => 'numeric',
                
            )
        );
            
        if ($validator->fails()){
            
            return Redirect::back()
                        ->withInput()
                        ->WithErrors($validator);
            
        }else{

            $save = EmailSettings::find(1);
            
            $save->emailFromName            = $input['emailFromName'] ;
            $save->emailFromEmail           = $input['emailFromEmail'];
            $save->SMTPHostAddress          = $input['SMTPHostAddress'];
            $save->SMTPHostPort             = $input['SMTPHostPort'] ;
            $save->EMailEncryptionProtocol  = $input['EMailEncryptionProtocol'];
            $save->SMTPServerUsername       = $input['SMTPServerUsername'];
            
            if(trim($input['SMTPServerPassword']) !== ''){
                $save->SMTPServerPassword       =  Crypt::encrypt($input['SMTPServerPassword']);
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
                
                return Redirect::back();
            }
        }
        
    }
    
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function emailTemplates(){
        
        
		//
        $data = array(
            'title' => 'Email Templates',
            'ul' => 'email',
            'active' => 'emailTemplates',
            'settings'=> Settings::find(1),
            
            'sendFilesSubject' => 
            EmailTemplates::where('emailType','=','sendFilesTemplate')
                                   ->pluck('emailSubject'),
            
            'welcomeSubject' => 
            EmailTemplates::where('emailType','=','welcomeTemplate')
                                   ->pluck('emailSubject'),
            
            'recoverEmailSubject' =>
            EmailTemplates::where('emailType','=','recoverPasswordTemplate')
                                   ->pluck('emailSubject'),
            
            
        );
        
        return View::make('admin.emailTemplates')->with('data',$data);
	
        
    }
    
    /**
	 * Store a Email Templates in storage.
	 *
	 * @return Response
	 */
    public function saveEmailTemplates(){
        
        
		//
        $input = Input::all();
        
        $validator = Validator::make( 
            array(
                'welcomeSubject' => $input['welcomeSubject'], 
                'sendFilesSubject' => $input['sendFilesSubject'],
                'recoverEmailSubject' => $input['recoverEmailSubject']

            ),
            
            array(
                'welcomeSubject' => 'required',
                'sendFilesSubject' => 'required',
                'recoverEmailSubject' => 'required',
                
            )
        );
            
        if ($validator->fails()){
            
            return Redirect::back()
                        ->withInput()
                        ->WithErrors($validator);
            
        }else{

            DB::table('emailtemplates')
            ->where('emailType', 'sendFilesTemplate')
            ->update(['emailSubject' => $input['sendFilesSubject']]);

            DB::table('emailtemplates')
            ->where('emailType', 'welcomeTemplate')
            ->update(['emailSubject' => $input['welcomeSubject']]);

            DB::table('emailtemplates')
            ->where('emailType', 'recoverPasswordTemplate')
            ->update(['emailSubject' => $input['recoverEmailSubject']]);

                
            Session::flash('Message','
            <div id="message-alert" class="alert alert-success alert-dismissible"
            role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <strong>Well!</strong> 
              Your Action has been Successfully Updated.
            </div>
            ');

            return Redirect::back();
        }
	
        
    }

}
