<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $data['settings']->description }}">
    <meta name="keywords" content="{{ $data['settings']->keywords }}">
    <title>{{ $data['settings']->sitename }}</title>
    
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/bootstrap_2.min.css') }}
    <!-- Custom Fonts -->
    {{ HTML::style('public/themes/defualt/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- DropZone CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/basic.css') }}
    {{ HTML::style('public/themes/defualt/assets/css/dropzone.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/index.css') }}


<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>
   
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
    
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header navbar-left">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img alt="Brand" src="{{ url().'/public/themes/uploads/logo.png' }}">
      </a>
    </div>
    
      <ul class="nav navbar-nav navbar-right">
        <li><a href="auth/login"><i class="fa fa-lock"></i> Login</a></li>
        <li><a href="auth/signup"><i class="fa fa-user-plus"></i> SignUp</a></li>
      </ul>
    
  </div>
</nav>

<div class="container-fluid">

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

@if( $data['topAds'] )
<!-- Top Advertising Area  -->
<div class="col-md-12">
<div class="ads">
    {{ $data['topAds'] }}
</div>
</div>
<!-- /# TopAdvertising Area  -->
@endif

<div class="header-content">
    <div class="header-content-inner">
        {{ ThemeCustomize::find(1)->welcomeText }}
    <hr>
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
<div class="ads">
    {{ $data['bottomAds'] }}
</div>
</div>
<!-- /# TopAdvertising Area  -->
@endif

{{ ThemeCustomize::find(1)->someHtml }}

</div>
 


    <!-- jQuery -->
    {{ HTML::script('public/themes/defualt/assets/js/jquery-1.11.3.min.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/themes/defualt/assets/js/bootstrap.min.js') }}    
    
    <!-- DROPZONE Core JavaScript -->
    {{ HTML::script('public/themes/defualt/assets/js/dropzone.js') }}
   
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
      if ( this.getQueuedFiles().length === 0) {
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
