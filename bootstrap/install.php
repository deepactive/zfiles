<?php

// Secuirty Point 
$url = $_SERVER['PHP_SELF'];
$url = explode("/",$url);
$url = end($url);

if( $url === 'Install.php' ||  file_exists('../config.php') ) {
    die('<div style="text-align:center">
            <h2 > Error : Bad Request  <br> <hr>
            <h3 >
                if you Need Reinstall system please drop all database tables.
            </h3>
            <p>Need Help? Contact With z-Files Support </p>
        </div>
        ');

}
// If Isset Install
if(Input::has('install')){
    
    // Get Form Inputs
    $inputs = Input::all();

    $rules  = array (
        'username'       => 'required|min:5|regex:/^[A-Za-z0-9_.-]+$/|
                             max:15',
        'email'          => 'required|email',
        'password'       => 'required|min:6|confirmed',
        'password_confirmation' => 'required'
    ); 

    $validator = Validator::make($inputs,$rules);

    if( $validator->fails() ){
        
        Session::flash('error',$validator->errors());
        Session::flash('inputs',$inputs);
        $_SESSION['host'] = @$_POST['host'];


    }else{
    
        Artisan::call('migrate', ['--quiet' => true, '--force' => true]);
        $q = file_get_contents( __DIR__.'/DB.sql' );
        DB::unprepared($q);


        $user = User::find(1);
        $user->username = $inputs['username']; 
        $user->email = $inputs['email']; 
        $user->password = Hash::make($inputs['password']); 
        $user->level = 'admin'; 
        
        

        
        if( $user->save() ){
            
            header('Location: '.$_SERVER['REQUEST_URI']);

        }
        
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
        margin-bottom: 10px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"],.form-signin input[type="email"] {
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
    
@-webkit-keyframes ld {
  0%   { transform: rotate(0deg) scale(1); }
  50%  { transform: rotate(180deg) scale(1.1); }
  100% { transform: rotate(360deg) scale(1); }
}
@-moz-keyframes ld {
  0%   { transform: rotate(0deg) scale(1); }
  50%  { transform: rotate(180deg) scale(1.1); }
  100% { transform: rotate(360deg) scale(1); }
}
@-o-keyframes ld {
  0%   { transform: rotate(0deg) scale(1); }
  50%  { transform: rotate(180deg) scale(1.1); }
  100% { transform: rotate(360deg) scale(1); }
}
@keyframes ld {
  0%   { transform: rotate(0deg) scale(1); }
  50%  { transform: rotate(180deg) scale(1.1); }
  100% { transform: rotate(360deg) scale(1); }
}

.m-progress {
    position: relative;
    opacity: .8;
    color: transparent !important;
    text-shadow: none !important;
}

.m-progress:hover,
.m-progress:active,
.m-progress:focus {
    cursor: default;
    color: transparent;
    outline: none !important;
    box-shadow: none;
}

.m-progress:before {
    content: '';
    
    display: inline-block;
    
    position: absolute;
    background: transparent;
    border: 1px solid #fff;
    border-top-color: transparent;
    border-bottom-color: transparent;
    border-radius: 50%;
    
    box-sizing: border-box;
    
    top: 50%;
    left: 50%;
    margin-top: -12px;
    margin-left: -12px;
    
    width: 24px;
    height: 24px;
    
    -webkit-animation: ld 1s ease-in-out infinite;
    -moz-animation:    ld 1s ease-in-out infinite;
    -o-animation:      ld 1s ease-in-out infinite;
    animation:         ld 1s ease-in-out infinite;
}

.btn-default.m-progress:before {
    border-left-color: #333333;
    border-right-color: #333333;
}

.btn-lg.m-progress:before {
    margin-top: -16px;
    margin-left: -16px;
    
    width: 32px;
    height: 32px;
}

.btn-sm.m-progress:before {
    margin-top: -9px;
    margin-left: -9px;
    
    width: 18px;
    height: 18px;
}

.btn-xs.m-progress:before {
    margin-top: -7px;
    margin-left: -7px;
    
    width: 14px;
    height: 14px;
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
                <h4 class="text-center"><span class="label label-primary"> STEP 2 (FINAL) </span><br></h4>
                <h4 style="color:#286198;" class="text-center">
                <span class="glyphicon glyphicon-user" ></span>
                 Create Admin Account </h4>
            </div>
        </div>
        <div class="panel-body">

            <form accept-charset="UTF-8" role="form" method="post"  class="form-signin">
                <fieldset>
                       <?php if(Session::has('error')){ ?>
                        <div class="login_result">
                            <div class="alert alert-danger alert-dismissable">
                               <span class="glyphicon glyphicon-exclamation-sign" ></span>
                                <strong>Error!</strong>
                                <br>
                                <ul style="list-style:none;">
                                <?php
    
                                    $errors = Session::get('error');
                                    echo implode('',$errors->all('
                                        <li >* :message</li>
                                    '));
                                    $inputs = Session::get('inputs');
                                ?>
                                </ul>
                            </div>   
                        </div>
                    <?php } ?>
                    <input class="form-control" value="<?php echo @$inputs['username']; ?>" 
                    placeholder="Admin Username" name="username" type="text" >
                    
                    <input class="form-control" value="<?php echo @$inputs['email']; ?>"
                     placeholder="Admin Email" name="email" type="email" >
                    
                    <input class="form-control" placeholder="Password" name="password" type="password">
                    
                    <input class="form-control" placeholder="Password Confirmation"
                     name="password_confirmation" type="password">
                    <br>
                                        
                    <input onclick="loading" role="button"
                     class="btn btn-lg btn-success btn-block" type="submit"
                     name="install" id="install"  value=" Install »">
                </fieldset>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div> 
	
<script>
    $('#install').click(function() {
        $(this).removeClass('btn btn-success').addClass('btn btn-success m-progress btn-disabled');
    });

</script>
</body>
</html>

