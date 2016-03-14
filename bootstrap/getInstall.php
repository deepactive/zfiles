<?php
session_start();

// Secuirty Point 
$url = $_SERVER['PHP_SELF'];
$url = explode("/",$url);
$url = end($url);

if( $url === 'getInstall.php' ||  file_exists('../config.php') ) {
    die('<div style="text-align:center">
            <h2 > Error : Bad Request  <br> <hr>
            <h3 >
                if you Need Reinstall system please drop all database tables.
            </h3>
            <p>Need Help? Contact With z-Files Support </p>
        </div>
        ');

}

// if isset check
if( isset($_POST['check']) ){
    define('DB_HOST' ,$_POST['host']);
    define('DB_NAME' , $_POST['dbname']); 
    define('DB_USER' , $_POST['user']); 
    define('DB_PASSWORD' , $_POST['pass']);
    define('CHARSET' , 'utf8');
    define('COLLATION' , 'utf8_unicode_ci'); 
    define('PREFIX' , '');
    
    $caught = false;

    if($_POST['host'] === '' ||
       $_POST['dbname'] === '' ||
       $_POST['user'] === ''
      ){
        $_SESSION['error'] = 'please insert all required fields';
        define('CONNECTION_ERROR',true);
        $caught = true;

    }

    // Check Connection Info
    try {
        DB::connection();
    } catch(PDOException $e){
        // if catch Error Store In Session
        $_SESSION['error'] = @$e->getMessage();
        $_SESSION['host'] = @$_POST['host'];
        $_SESSION['dbname'] = @$_POST['dbname'];
        $_SESSION['user'] = @$_POST['user'];
        $caught = true;
        header('Location: '.$_SERVER['REQUEST_URI']);

    }

    if( !$caught ){
        
        $ConfigFile  = '<?php'."\n"."\n"; 
        $ConfigFile .= '// Database Connection Information // '."\n"."\n";
        $ConfigFile .= 'define('."'DB_HOST'".' , '."'".$_POST['host']."'".'); // INSERT HOSTNAME '."\n"."\n";
        $ConfigFile .= 'define('."'DB_NAME'".' , '."'".$_POST['dbname']."'".'); // INSERT DATABASE NAME '."\n"."\n";
        $ConfigFile .= 'define('."'DB_USER'".' , '."'".$_POST['user']."'".'); // INSERT DATABASE USER '."\n"."\n";
        $ConfigFile .= 'define('."'DB_PASSWORD'".' , '."'".$_POST['pass']."'".'); // INSERT DATABASE PASSWORD '."\n"."\n";
        $ConfigFile .= '// Optional Requirements  '."\n"."\n";
        $ConfigFile .= 'define('."'CHARSET'".' , '."'utf8'".'); // INSERT DATABASE PASSWORD '."\n"."\n";
        $ConfigFile .= 'define('."'COLLATION'".' , '."'utf8_unicode_ci'".'); // INSERT DATABASE PASSWORD '."\n"."\n";
        $ConfigFile .= 'define('."'PREFIX'".' , '."''".'); // INSERT DATABASE PASSWORD '."\n"."\n";
        $ConfigFile .= "\n".'?>';
        $bytes_written = File::put('config.php', $ConfigFile);


        if ($bytes_written) {
            
            header('Location: '.$_SERVER['REQUEST_URI']);
            
        }else{
            die("Error while Create config file");
        }
        
            header('Location: '.$_SERVER['REQUEST_URI']);
        
    }    

}

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<!--  favicon.ico -->
	<link rel="shortcut icon" href="sys-admin/favicon.png">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
	Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<!-- Mobile First -->
	<meta name="viewport" content="width=device-width; initial-scale=1.0">

	<title>z-Files | Installation </title>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="sys-admin/js/html5shiv.min.js"></script>
	<script src="sys-admin/js/respond.min.js"></script>
	<![endif]-->
        
	<!-- Bootstrap -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<style>
    
        /**
 * parallax.css
 * @Author Original @msurguy -> http://bootsnipp.com/snippets/featured/parallax-login-form
 * @Reworked By @kaptenn_com 
 * @package PARALLAX LOGIN.
 */
    
    body {
        background-color: #444;
        
    }
    .form-signin input[type="text"] {
        margin-bottom: 5px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        font-family: 'Open Sans', Arial, Helvetica, sans-serif;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .vertical-offset-100 {
        padding-top: 100px;
    }
    .img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
    margin: auto;
    }
    .panel {
    margin-bottom: 20px;
    background-color: rgba(255, 255, 255, 0.75);
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }
        
    </style>
</head>

<body>
	
<div class="container">
<div class="row vertical-offset-100">
<div class="col-md-6 col-md-push-3">
    <div class="panel panel-default">
        <div class="panel-heading">                                
            <div class="row-fluid user-row">
               <h2 style="color:#286198;" class="text-center">zFiles Installation </h2>
                <hr>
                <h4 class="text-center"><span class="label label-primary"> <b>STEP 1</b> </span><br></h4>
                <h4 style="color:#286198;" class="text-center">
                <span class="glyphicon glyphicon-globe" ></span>
                 Create Database Configration File </h4>
            </div>
        </div>
        <div class="panel-body">
            <form accept-charset="UTF-8" role="form" method="post"  class="form-signin">
                <fieldset>
                    <label class="panel-login">
                        <div class="login_result">
                          <?php if(@$_SESSION['error'] !== null ) { ?>
                           <div class="alert alert-danger alert-dismissable">
                            <span class="glyphicon glyphicon-certificate"></span>
                            <strong>Oops!</strong>
                             <b><?php echo @$_SESSION['error'];?></b>
                            </div>
                            <?php } ?>
                        </div>
                    </label>
                    
                    <input class="form-control" value="<?php echo @$_SESSION['host']; ?>"
                     placeholder="Host Name" name="host" type="text" >
                    
                    <input class="form-control" value="<?php echo @$_SESSION['dbname']; ?>"
                     placeholder="DB Name" name="dbname" type="text" >
                    
                    <input class="form-control" value="<?php echo @$_SESSION['user']; ?>"
                     placeholder="DB User" name="user" type="text" >
                    
                    <input class="form-control" placeholder="DB Password" name="pass" type="text">
                    
                    <br>
                    <input class="btn btn-lg btn-primary btn-block" type="submit" name="check"
                      value="Next »">
                </fieldset>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div> 
	

</body>
</html>

<?php
if(isset($_SESSION['error']) && !isset($_POST['check']) ){
    
    session_destroy();
}

?>