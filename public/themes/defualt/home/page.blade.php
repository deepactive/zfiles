<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ $data['page']->pageTitle }} | {{ Settings::find(1)->sitename }} </title>
    
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/bootstrap_2.min.css') }}
    <!-- Custom Fonts -->
    {{ HTML::style('public/themes/defualt/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- DropZone CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/basic.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/index.css') }}
    {{ HTML::style('public/themes/defualt/assets/css/user.css') }}

<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    


<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header navbar-left">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img alt="Brand" src="{{ url().'/public/themes/uploads/logo.png' }}">
      </a>
    </div>
    
    @if( !Auth::check() ) 
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ url('/auth/login') }}">
            <i class="fa fa-lock"></i> Login</a>
        </li>
        <li style="margin-left:20px;"><a href="{{ url('/auth/signup') }}">
            <i class="fa fa-user-plus"></i> SignUp</a>
        </li>
      </ul>
    
    @else 
    <ul class="nav navbar-right top-nav">
                       <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-user"></i>
                       | {{ Auth::User()->username }}  <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">

                        <li>
                            <a href="{{ url('user/'.Auth::User()->username.'/settings') }}"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}">
                            <i class="fa fa-fw fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </li>
      </ul>

    
    
    @endif

  </div>
</nav>

    <!-- sidebar-wrapper -->
    
<div id='social-sidebar' >
<ul>
    <li>
        <a class='entypo-twitter' href='https://twitter.com/digitalhubinc' target='_blank'>
           <i class="fa fa-twitter "></i>
            <span>Twitter</span>
        </a>
    </li>
    <li>
        <a class='entypo-facebook' href='http://www.facebook.net/digitalhubinc' target='_blank'>
             <i class="fa fa-facebook "></i>
            <span>facebook</span>
        </a>
    </li>
    <li>
        <a class='entypo-gplus' href='http://dribbble.com/digitalhubinc' target='_blank'>
            <i class="fa fa-google-plus "></i>
            <span>google+</span>
        </a>
    </li>
</ul>
</div>
   
    <div class="col-md-11 pull-right ">

      <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>{{ $data['page']->pageTitle }}</b>
            </div>
            <div class="panel-body" style="color:#888;padding:10px;margin:0;
               overflow:hidden;" >
                <div>{{ $data['page']->pageContent }}</div>           
            </div>
            </div>
            </div>

</div>
  


    <!-- jQuery -->
    {{ HTML::script('public/themes/defualt/assets/js/jquery-1.11.3.min.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/themes/defualt/assets/js/bootstrap.min.js') }}    
    

</body>
