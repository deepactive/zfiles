@show
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    <title>{{ $data['title'].' | '.$data['settings']->sitename }}</title>
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/bootstrap_2.min.css') }}
    <!-- Font Awesome Fonts -->
    {{ HTML::style('public/themes/z-Responsive/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/sb-admin.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/social.css') }}

    @yield('style')
    {{ HTML::style('public/themes/z-Responsive/assets/css/tabs.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/navbar.css') }}

    <!--<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet'
     type='text/css'>-->
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

@include('user.--header')

<div class="container">
    <!-- PAGE WRAPPER -->
    <div id="wrapper"> 
    @if( $data['topAds'] )
    <!-- Top Advertising Area  -->
    <div class="col-md-12 ">
    <div class="ads-top">
        {{ $data['topAds'] }}
    </div>
    </div>
    <!-- /# TopAdvertising Area  -->
    @endif

        <!-- Sidebar -->
<section >
    <div class="container">
        <div class="row">
            <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
            <div class="board-inner">
                <ul class="nav nav-tabs" id="myTab">
                <li {{ ($data['nav'] === 'dashboard') ? 'class="active"' : '' }}>
                        <a href="{{ url() }}"  title="Dashboard">
                             <span class="round-tabs one">
                              <i class="fa fa-tachometer fa-stack-1x "></i>
                              
                      </span>
                       
                        </a>
                    </li>

                <li {{ ($data['nav'] === 'upload') ? 'class="active"' : '' }}>
                        <a href="{{ url('/user/'.$data['userName']).'/upload' }}" title="Upload">
                            <span class="round-tabs two">
                         <i class="fa fa-cloud-upload fa-stack-1x "></i>
                     </span>
                        </a>
                    </li>
                <li {{ ($data['nav'] === 'files') ? 'class="active"' : '' }}>
                        <a href="{{ url('/user/'.$data['userName']).'/files' }}" title="My Files">
                            <span class="round-tabs three">
                          <i class="fa fa-dropbox fa-stack-1x "></i>
                     </span> </a>
                    </li>

                <li {{ ($data['nav'] === 'send') ? 'class="active"' : '' }}>
                        <a href="{{ url('/user/'.$data['userName']).'/send' }}" title="Send Files">
                            <span class="round-tabs four">
                              <i class="fa fa-paper-plane fa-stack-1x "></i>
                         </span>
                        </a>
                    </li>
                @if(DB::table('pages')->count() )

                <li {{ ($data['nav'] === 'pages') ? 'class="active"' : '' }}>
                        <a href="{{ url('/user/'.$data['userName']).'/pages' }}" title="Pages">
                            <span class="round-tabs five">
                              <i class="fa fa-files-o fa-stack-1x "></i>
                         </span> </a>
                    </li>
                @endif
                </ul>
            </div>

            <div class="tab-content">
               <!-- Tab Content -->     

                @if($data['nav'] === 'dashboard' )
                    @yield('dashboard')
                @endif
                @if($data['nav'] === 'upload' )
                    @yield('upload')
                @endif
                @if($data['nav'] === 'files' )
                    @yield('files')
                @endif
                @if($data['nav'] === 'send' )
                    @yield('send')
                @endif
                @if($data['nav'] === 'pages' )
                    @yield('pages')
                @endif
                @if($data['nav'] === 'settings' )
                    @yield('settings')
                @endif
                <!-- /#Tab Content -->     

                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</section>

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


        


<!-- jQuery -->
{{ HTML::script('public/themes/defualt/assets/js/jquery-1.11.3.min.js') }}
<!-- Bootstrap Core JavaScript -->
{{ HTML::script('public/themes/defualt/assets/js/bootstrap.min.js') }}
@yield('javascript')
@include('user.--footer')

<script language="javascript">

</script>