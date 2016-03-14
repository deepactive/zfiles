<?php


namespace app\Controllers;

use View;
use DB;
use Settings;
use Input;
use Carbon;
use Files;
use File;
use LockFile;
use Hash;

use Redirect;
use Response;
use Request;
use Auth;

class FilesController extends \BaseController {

    protected $routeParametrs;
    protected $fileUrlName;
    protected $filePath;
    protected $fileData;
    protected $fileDownloadPath;
    protected $isLock;
    protected $topAds;
    protected $bottomAds;
    
    
    function __construct() {

        ## Get FileName From Url 
        $this->fileUrlName = Request::path();
        $this->fileUrlName = explode("/",$this->fileUrlName);
        $this->fileUrlName = $this->fileUrlName[1];
        
        ## Check If File Exists
        $this->filePath = url('/file/'.$this->fileUrlName);
        $this->fileData = Files::where('filePath','=',$this->filePath)
            ->first();
        
        ## If File Is Not Exsits
        
        if( !$this->fileData ){
            define('FILE-NOT-EXISTS',true);
        }else{

            $this->isLocked = LockFile::where('fileId','=',$this->fileData->id)->first();

            $this->fileDownloadPath = url('/up-files/'.$this->fileUrlName
                                          .'.'.$this->fileData->fileExt);

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
                ->where('adsPage','=','download')
                ->where('adsPosition','=','top')
                ->pluck('adsContent');

            $this->bottomAds = DB::table('advertising')
                ->where('adsPage','=','download')
                ->where('adsPosition','=','bottom')
                ->pluck('adsContent');

            }
        
    }
    
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
    public function showFile($path) {
        
        if(defined('FILE-NOT-EXISTS')){
            
            return View::make('home.fileNotExists');
        }
        
        $data = array(
            'settings' => Settings::find(1),
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
            'fileName' => $this->fileData->fileName,
            'fileSize' => size($this->fileData->fileSize),
            'fileExt' => $this->fileData->fileExt,
            'filePath' => $this->fileData->filePath,
            'isLocked' => $this->isLocked,
            'fileDownloadPath' => $this->fileDownloadPath
            
        );
        
        return View::make('home.file')->with('data',$data);

    }
    
    // Check Password For Locked Files
    function downloadLockedFile(){

        if( $this->isLocked ){
            
            $inputs = Input::all();
            $password = $inputs['password'];
            // If Password Match
            if (Hash::check($password, $this->isLocked->filePassword)){
                define('UNLOCK',true);
                $this->downloadFile();
            }else{
                return Redirect::back()->with('message',false);
            }

        }
    }
    
    // Download File Function
    function downloadFile() {
        
        if( $this->isLocked && !defined('UNLOCK')){
            die();
        }
        
        ignore_user_abort(true);

        @set_time_limit(0); // disable the time limit for this script

        $path = $this->fileDownloadPath; 
        
        $path = filter_var($path, FILTER_SANITIZE_URL); // Remove (more) invalid characters
        
        $fileSize = $this->fileData->fileSize;
        $fileName = $this->fileData->fileName;
        $fullPath = utf8_encode($path);

        if ($fd = fopen ($fullPath, "rb")) {

            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);

 
                header('Content-Description: File Transfer');
                header('Content-Transfer-Encoding: binary');
                #header("Pragma: no-cache");
                header("Content-length: $fileSize");
                header('Expires: 0');
                // check for IE only headers
                if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) ||
                   (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {

                        header('Content-Type: application/octet-stream');
                        header("Content-Disposition: attachment; filename=\"".$fileName.".".$ext."\"");
                        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                        header('Pragma: public');
                } else {

                    header('Content-Type: application/octet-stream');
                    header("Content-Disposition: attachment;filename=\"".$fileName.".".$ext."\"");
                    header('Pragma: no-cache');
                }

            

            #header("Cache-control: private"); //use this to open files directly

            while(!feof($fd)) {

                $buffer = fread($fd, 2048);
                echo $buffer;

            }
            
            // decrement donwload counter
            $this->fileData->fileDownloadCounter++;
            $this->fileData->save();                     

        }

            fclose($fd);
            exit();


        }

}
