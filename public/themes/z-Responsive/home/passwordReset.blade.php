<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    <title>{{ 'Reset Password' .' | '. $data['title'] }} </title>
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/bootstrap_2.min.css') }}
    <!-- Font Awesome Fonts -->
    {{ HTML::style('public/themes/z-Responsive/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/social.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/navbar.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/home.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/login-signup.css') }}
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>
       <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<nav style="border-radius:0;" class="navbar navbar-default navbar-xs" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
      <a class="navbar-brand" href="{{ url('/') }}">
        <img alt="Brand" src="{{ url().'/public/themes/uploads/logo.png' }}">
      </a>
    </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-right top-nav">
            <li>
                <a href="{{ URL().'/auth/login' }}">
                  <i class="fa fa-lock"></i> Login
                </a>
            </li>
            <li>
                <a href="{{ URL().'/auth/signup' }}">
                    <i class="fa fa-user-plus"></i> Signup
                </a>
            </li>
      </ul>
    
  </div><!-- /.navbar-collapse -->
</nav>
<div class="container-fluid">

   <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">

                        <div class="col-xs-12">
                            <i class="fa fa-repeat"></i> Reset Password
                        </div>
                    </div>

                    <hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
          
           {{ Form::open(
             array(
               'method' => 'post',
               'class'=>'form-signin',
               'role' => 'form',
               )
            )}}
            
@if (Session::has('error'))
            <div style="padding:8px;margin-bottom:25px;"
             class="alert alert-danger text-left" role="alert">
            <ul style="list-style:none;" >
                    <li >
                    <i class="fa fa-exclamation-circle"></i>
                     {{ Session::get('error') }}.</li>
            </ul>
            </div>

    @endif
        
        <div class="form-group ">
    <input type="hidden" name="token" value="{{ $data['token'] }}">

           {{ Form::text( 'email','',array(
               'id'         =>'email',
               'tabindex'   => '1',
               'class'      => 'form-control',
               'placeholder'=> 'Email Address'
           ) ) }}

        </div>
        
        <div class="form-group">
           {{ Form::password( 'password',array(
               'id'         =>'password',
               'tabindex'   => '2',
               'class'      => 'form-control',
               'placeholder'=> 'Password'
           ) ) }}

        </div>

        <div class="form-group">
           {{ Form::password( 'password_confirmation',array(
               'id'         =>'password_confirmation',
               'tabindex'   => '3',
               'class'      => 'form-control',
               'placeholder'=> 'Confirm Password'
           ) ) }}

        </div>

        <div class="form-group">
           {{ Form::button( '<i class="fa fa-check  fa-fw fa-md"></i> Reset Password',array(
               'tabindex'   => '4',
               'class'      => 'form-control btn  btn-login ',
               'type'       => 'submit'
           ) ) }}

        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="" tabindex="5" class="forgot-password">More Help Contact Support</a>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}

						
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
    
</div>


    <!-- jQuery -->
    {{ HTML::script('public/themes/z-Responsive/assets/js/jquery-1.11.3.min.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/themes/z-Responsive/assets/js/bootstrap.min.js') }}    
    {{ HTML::script('public/themes/z-Responsive/assets/js/login-signup.js') }}