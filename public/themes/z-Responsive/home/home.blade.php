<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ Settings::find(1)->description }}">
    <meta name="keywords" content="{{ Settings::find(1)->keywords }}">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    <title>{{ $data['settings']->sitename }}</title>
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/bootstrap_2.min.css') }}
    <!-- Font Awesome Fonts -->
    {{ HTML::style('public/themes/z-Responsive/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- DropZone CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/basic.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/dropzone.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/social.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/navbar.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/home.css') }}

    <!-- DROPZONE Core JavaScript -->
    {{ HTML::script('public/themes/z-Responsive/assets/js/dropzone.js') }}

    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet'
     type='text/css'>
       <!-- SEO Meta  -->
	<meta name="author" content="{{ $data['settings']->sitename }}">
	<meta name="robots" content="INDEX,FOLLOW"/>
	<meta name="robots" content="all"/>
	<meta name="distribution" content="global"/>

	<meta property="og:title" content="{{ $data['settings']->sitename }}" />
	<meta property="og:image" content="{{ url().'/public/themes/uploads/logo.png' }}" />
	<meta property="og:site_name" content="{{ Settings::find(1)->sitename }}"/>
	<meta property="og:description" content="{{ Settings::find(1)->description }}" />
	<link rel="image_src" href="{{ url().'/public/themes/uploads/logo.png' }}" />
	<meta itemprop="name" content="{{ Settings::find(1)->sitename }}" />
   
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<style type="text/css">
{{ ThemeCustomize::find(1)->someCss }}
</style>

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
<div class="container">

@if( $data['topAds'] )
<!-- Top Advertising Area  -->
<div class="col-md-12">
<div class="ads-top">
    {{ $data['topAds'] }}
</div>
</div>
<!-- /# TopAdvertising Area  -->
@endif


@if( Social::find(1) )
<div id='social-sidebar'><!-- SOCIAL Media SIDEBAR -->
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
</div> <!-- /#SOCIAL Media SIDEBAR -->
@endif

<div style=" padding: 30px 15px;" class="header-content">
    <div class="header-content-inner">
        {{ ThemeCustomize::find(1)->welcomeText }}
    <hr style="width:50%">
    <div id="dropzone">
        {{ Form::open(array('url' => '/guestUploadFile', 'class'=>'dropzone', 'id'=>'my-dropzone')) }}

        <!-- Multiple file upload-->
        
        <div class="dz-message"><center>
            <i style="font-size:45px" class="fa fa-cloud-upload fa-2x"></i>
            <h4>Drag Your Files - Photos to Upload</h4>
            <span>Or click to browse</span></center>
            
        </div> 

        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>

        {{ Form::close() }}
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

<!-- /# TopAdvertising Area  -->
@endif

{{ ThemeCustomize::find(1)->someHtml }}

</div>
 


    <!-- jQuery -->
    {{ HTML::script('public/themes/z-Responsive/assets/js/jquery-1.11.3.min.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/themes/z-Responsive/assets/js/bootstrap.min.js') }}    

   
<script language="javascript">


// myDropzone is the configuration for the element that has an id attribute
  // with the value my-dropzone (or myDropzone)
    Dropzone.options.myDropzone = {
        maxFiles: 3,
        maxFilesize: 2,


  init: function () {
       this.on("maxfilesexceeded", function(file){
    });

    this.on("success", function (file) {
      if ( this.getQueuedFiles().length === 0 ) {
            // Your application has indicated there's an error
            window.setTimeout(function(){
            // Move to a new location or you can do something else
            // window.location = "{{-- url('user/'.Auth::User()->username.'/files') --}}";
                var url = "{{ url('/guest/'.Session::get('guestSession'))  }}"
                
            window.location = url;


    }, 3000);
      }
    });
  }
};
    
    


</script>
</body>
