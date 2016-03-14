<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application;

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/

$env = $app->detectEnvironment(array(

	'local' => array('homestead'),

));

/*
|--------------------------------------------------------------------------
| Bind Paths
|--------------------------------------------------------------------------
|
| Here we are binding the paths configured in paths.php to the app. You
| should not be changing these here. If you need to change these you
| may do so within the paths.php file and they will be bound here.
|
*/

$app->bindInstallPaths(require __DIR__.'/paths.php');

/*
|--------------------------------------------------------------------------
| Load The Application
|--------------------------------------------------------------------------
|
| Here we will load this Illuminate application. We will keep this in a
| separate location so we can isolate the creation of an application
| from the actual running of the application with a given request.
|
*/

$framework = $app['path.base'].
                 '/vendor/laravel/framework/src';

require $framework.'/Illuminate/Foundation/start.php';

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

if( file_exists('config.php') ){

    require "config.php";

    App::error(function(PDOException $exception){
    
        return "
            <div style='text-align:center;'>
                <h2 >Database Connection Error : <br> <hr>"
                    .$exception->getMessage().
                "</h2>
                <p>Need Help? Contact With z-Files Support </p>
            </div>
            ";
    });
    
    $tables = array(
        'advertising','emailsettings','emailtemplates',
        'files','lockedfiles','migrations','pages',
        'password_reminders','settings','social',
        'themecustomize','themes','uploadsettings',
        'users'
    );
    
    $existsTables = array();
    
    foreach ($tables as $table){
        
        if(Schema::hasTable($table)){
            
            $existsTables[] = $table;
        }
    }
    
    if( count($existsTables) === 0 ){
        define('INSTALL',true);
        require_once __DIR__."/install.php";
        exit();
        
    }else{
     
        $missingTables = array();
    
        foreach ($tables as $table){

            if(!Schema::hasTable($table)){
                $missingTables[] = $table;
            }
        }
        
        if( count($missingTables) ){
                 
            $lastTable = end($missingTables);

            $string = '';

            foreach ($missingTables as $table){

                if($table === $lastTable){
                    $string .= $table;
                }else{
                    $string .= $table.', ';
                }
            }

            die('<div style="text-align:center">
                <h2 >Database Connection Error : <br> <hr>
                <h3 >
                    Table - '.$string.' - Is Not Exists.
                </h3>
                <p>Need Help? Contact With z-Files Support </p>
                </div>
            ');
        }else{
            if(isset($_POST['install'])){
                header('Location: '.$_SERVER['REQUEST_URI']);
            }
        }
    
    }
    


}else{
    require "getInstall.php";
    exit(); 
}



# file size Convert function
function formatFileSize($size) {
    $units = array(' B', ' KB', ' MB', ' GB', ' TB');
    for ($i = 0; $size > 1024; $i++) { $size /= 1024; }
    return round($size, 2).$units[$i];
}


return $app;

