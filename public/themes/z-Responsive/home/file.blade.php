<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    
    <title>{{ $data['fileName'].' | '.$data['settings']->sitename }}</title>
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/bootstrap_2.min.css') }}
    <!-- Font Awesome Fonts -->
    {{ HTML::style('public/themes/z-Responsive/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/social.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/navbar.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/jquery.frontbox-1.1.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/home.css') }}
    
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>
      
    <!-- SEO Meta  -->
    <meta name="description" content="Download {{ $data['fileName'] }}">
	<meta name="author" content="Download {{ $data['fileName'] }}">
	<meta name="robots" content="INDEX,FOLLOW"/>
	<meta name="robots" content="all"/>
	<meta name="distribution" content="global"/>

	<meta property="og:title" content='{{ $data['fileName'].' | '.$data['settings']->sitename }}' />
	<meta property="og:image" content="{{ url().'/public/themes/uploads/logo.png' }}" />
	<meta property="og:site_name" content="{{ Settings::find(1)->sitename }}"/>
	<meta property="og:description" content="{{ Settings::find(1)->description }}" />
	<link rel="image_src" href="{{ url().'/public/themes/uploads/logo.png' }}" />
	<meta itemprop="name" content="{{ Settings::find(1)->sitename }}" />
   
    <!--  -->  
    
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


<div class="container">


@if( $data['topAds'] )
<!-- Top Advertising Area  -->
<div class="col-md-12 ">
<div class="ads-top">
    {{ $data['topAds'] }}
</div>
</div>
<!-- /# TopAdvertising Area  -->
@endif


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
<!-- Start Page Content -->     

<div  class="col-md-12 ">

<div id="showfile" class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                
                 <i style="font-size:18px;" class="fa fa-cloud-download"></i> 
                 Download File 
            </div>
            <div class="panel-body">
            
            <ul class="list-group col-md-6 text-left">
                <li class="list-group-item">
                    <span>
                     <i style="font-size:18px;" class="fa fa-file-o"></i> File Name |    
                    </span>
                    {{ mb_substr($data['fileName'],0,20,"utf-8") }}
                </li>
                
                <li class="list-group-item">   
                    <span>
                       <i style="font-size:18px;" class="fa fa-filter"></i> File Extension | 
                    </span>
                    {{ $data['fileExt'] }}
                </li>
                
                <li class="list-group-item">
                    <span>
                    <i style="font-size:18px;" class="fa fa-crosshairs"></i> File Size |
                    </span>
                    {{ $data['fileSize'] }}
                </li>
                <br>

              @if ($data['isLocked'])
                {{ Form::open( array(
                    'role' => 'form',
                    'id' => 'downloadLocked',
                    'url' =>  Request::path().'/downloadLocked' 
                ) ) }}
                 <label for="password"><i class="fa fa-lock"></i> File Password</label>
                @if( Session::has('message') ?
                 $border= 'border-color:#a02a1b;': $border ='')@endif
                {{ Form::password( 'password',array(
                   'id'         =>'password',
                   'tabindex'   => '1',
                   'class'      => 'form-control',
                   'style'      => $border,
                   'placeholder'=> 'Password'
               ) ) }}
               
                @else
                {{ Form::open( array(
                    'role' => 'form',
                    'id' => 'download',
                    'url' =>Request::path()
                ) ) }}

                @endif
                
               {{ Form::button('<i class="fa fa-cloud-download"></i> Download Now',
                   array(
                       'type' => 'submit',
                       'class' => 'btn btn-primary',
                       'id' => 'as'
                   ));
                }}
                
                 {{ Form::close() }}
              </ul>
         <ul class="list-group col-md-6 col-right text-left">
               
                <li class="list-group-item">
                    <span>
                     <i class="fa fa-link"></i> Download Link
                     
                    </span>  
                    <input style="margin-bottom:0px;" class="form-control" style="width:100%;" type="text" value="{{ $data['filePath'] }}" readonly>
                    

                </li>
                
                <li class="list-group-item">
                    <span>
                     <i class="fa fa-code"></i> HTML Include (For Websites)
                     
                    </span>  
                    <input style="margin-bottom:0px;" class="form-control" style="width:100%;"
                     type="text" value="{{ htmlspecialchars('<a href="'.$data['filePath'].'">'.$data['fileName'].'</a>') }}" readonly>

                </li>
                         
            <div class="text-left">

            <h4 style="color:#1869A0;"><i class="fa fa-share-alt"></i> Share Via </h4>
                <!-- just add href= for your links, like this: -->
                <a class="btn btn-social-icon btn-facebook" onclick=" window.open('http://www.facebook.com/sharer/sharer.php?s=100&amp;p[url]={{ $data['filePath'] }}','','height=550,width=525,left=100,top=100,menubar=0')">
                    <i class="fa fa-facebook"></i>
                </a>    

               
                <a class="btn btn-social-icon btn-twitter"
                  onclick=" window.open('https://www.twitter.com/share?{{ $data['filePath'] }}','','height=550,width=525,left=100,top=100,menubar=0')"
>
                    <i class="fa fa-twitter"></i>
                </a>

                              <a class="btn btn-social-icon btn-google-plus"
                  onclick=" window.open('https://plus.google.com/share?url={{ $data['filePath'] }}','','height=550,width=525,left=100,top=100,menubar=0')"
>
                    <i class="fa fa-google-plus"></i>
                </a>


              </div>

                </div>
                    
              </ul>
            
            </div>
        </div>

    </div>


</div>
 @if( $data['bottomAds'] )
    <!-- bottom Advertising Area  -->
    <div class="col-md-12">
    <div class="ads-bottom">
        {{ $data['bottomAds'] }}
    </div>
    </div>
    <!-- /# bottom Advertising Area  -->
    @endif
</div>
    
   
</div>


    <!-- jQuery -->
    {{ HTML::script('public/themes/z-Responsive/assets/js/jquery-1.11.3.min.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/themes/z-Responsive/assets/js/bootstrap.min.js') }}    

   
    <script language="javascript">
        
    $('form#download #as').click(function() {
        $(this).removeClass('btn btn-primary').addClass('btn btn-primary m-progress btn-disabled');
    });


    @if ($data['isLocked'])
    $('#downloadLocked').on('submit',function(e) {
    e.preventDefault();
        $.ajax({
                url: {{ Request::path().'/downloadLocked' }},
                type: 'post',
                cache:false,
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "password": password
                }
            });
          });

    @else
    $('#download').on('submit',function(e) {
        $.ajax({
                url: window.location,
                type: 'post',
                cache:false,
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            });
    });
    @endif

        
    $('form#download #as').delay(3000).queue(function(){
    $('form#download #as').removeClass("btn btn-primary m-progress btn-disabled").addClass('btn btn-primary');

    });
    
    </script>

</body>
