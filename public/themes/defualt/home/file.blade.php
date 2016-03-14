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
    {{ HTML::style('public/themes/defualt/assets/css/bootstrap_2.min.css') }}
    <!-- Custom Fonts -->
    {{ HTML::style('public/themes/defualt/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/index.css') }}
        {{ HTML::style('public/themes/defualt/assets/css/user.css') }}

    {{ HTML::style('public/themes/defualt/assets/css/showfile.css') }}


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

<!-- Start Page Content -->     


<div class="container-fluid">
@if( $data['topAds'] )
<!-- Top Advertising Area  -->
<div class="col-md-12 ">
<div class="ads">
    {{ $data['topAds'] }}
</div>
</div>
<!-- /# TopAdvertising Area  -->
@endif

<div  class="col-md-11 ">

<div id="showfile" class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
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

</div>
    
    @if( $data['bottomAds'] )
    <!-- bottom Advertising Area  -->
    <div style="margin-top:40px;" class="col-md-12">
    <div class="ads">
        {{ $data['bottomAds'] }}
    </div>
    </div>
    <!-- /# bottom Advertising Area  -->
    @endif
</div>


    <!-- jQuery -->
    {{ HTML::script('public/themes/defualt/assets/js/jquery-1.11.3.min.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/themes/defualt/assets/js/bootstrap.min.js') }}    

   
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
