<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    <title>Expired - Deleted Guest Session | {{ Settings::find(1)->sitename }} </title>
    {{ HTML::style('public/themes/z-Responsive/assets/css/bootstrap_2.min.css') }}
    <!-- Font Awesome Fonts -->
    {{ HTML::style('public/themes/z-Responsive/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/social.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/navbar.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/home.css') }}
    
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>
       <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

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
        @if( !Auth::check() ) 
            <li><a href="{{ url('/auth/login') }}">
                <i class="fa fa-lock"></i> Login</a>
            </li>
            <li style="margin-left:20px;"><a href="{{ url('/auth/signup') }}">
                <i class="fa fa-user-plus"></i> SignUp</a>
            </li>
        @else 
            <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i>
                   | {{ Auth::user()->username }} <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    @if(Auth::user()->level === 'admin')                              
                    <li>
                        <a href="{{ URL().'/admin' }}">
                          <i class="fa fa-fw fa-tasks"></i> Admin Panel
                        </a>
                    </li>   
                    @endif
                    <li>
                        <a href="{{ url('/user/'.Auth::user()->username) }}">
                            <i class="fa fa-fw fa-user"></i> My Profile
                        </a>
                        <a href="{{ url('/user/'.Auth::user()->username.'/settings') }}">
                            <i class="fa fa-fw fa-gear"></i> Settings
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL() }}/logout"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                    </li>
                </ul>
            </li>
        @endif      
        </ul>
    
  </div><!-- /.navbar-collapse -->
</nav>

<!-- Start Page Content -->     
<div class="container">
  
@if( Social::find(1) )
<!-- SOCIAL Media SIDEBAR -->
<div id='social-sidebar'>
    <ul>
       @if( Social::find(1)->twitterLink !== '' )
        <li>
            <a class='entypo-twitter' href='{{ Social::find(1)->twitterLink }}' target='_blank'>
               <i class="fa fa-twitter "></i>
                <span>Twitter</span>
            </a>
        </li>
        @endif
        @if(Social::find(1)->facebookLink !== '')
        <li>
            <a class='entypo-facebook' href='{{ Social::find(1)->facebookLink }}' target='_blank'>
                 <i class="fa fa-facebook "></i>
                <span>facebook</span>
            </a>
        </li>
        @endif
        @if(Social::find(1)->googlePlusLink !== '')
        <li>
            <a class='entypo-gplus' href='{{ Social::find(1)->googlePlusLink }}' target='_blank'>
                <i class="fa fa-google-plus "></i>
                <span>google+</span>
            </a>
        </li>
        @endif
    </ul>
</div>
<!-- /#SOCIAL Media SIDEBAR -->
@endif
   
    <div style="margin-top:10%;" class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><i class="fa fa-exclamation-triangle"></i> Sorry,</strong>
                 this Session has been Expired. 
            </div>
            <div class="panel-body">
                <i style="color:#1E7FB2;" class="fa fa-4x fa-exclamation-triangle"></i>

    <h3 style="line-height:40px;color:#1869A0;">Sorry,
    We can't find This Files Session you're looking for. Session May be Expired Or Deleted.. <br><a style="color:#2C3E50;text-decoration:underline;font-size:30px;" href="{{ url() }}">
              <i class="fa fa-home"></i> back to home</a>.</h3>
           
            </div>
            </div>
    </div>
</div>
  
 <!-- jQuery -->
    {{ HTML::script('public/themes/z-Responsive/assets/js/jquery-1.11.3.min.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/themes/z-Responsive/assets/js/bootstrap.min.js') }}    
  
    
</body>
