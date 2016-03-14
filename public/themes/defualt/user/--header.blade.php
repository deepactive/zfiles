
{{ ($data['adminPreviewMode']) ?                              
    '<div class="alert alert-danger  alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"
       aria-label="Close"><span aria-hidden="true">&times;</span>
      </button>
      <strong><i class="fa fa-info-circle "></i>

     Take Notice!</strong> Dir Admin, This Is Not Your Personal Account ,
      <a style="color:#2C3E50;" 
          href="'.url('user/'.Auth::user()->username).'">
          <b>Back To Your Account</b>
      </a>
     </div>'   
: '' }}

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header navbar-left">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img alt="Brand" src="{{ url().'/public/themes/uploads/logo.png' }}">
      </a>
    </div>
    
            <ul class="nav navbar-right top-nav">
                       <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-user"></i>
                       | {{ $data['userName'] }} <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                       {{ ($data['isAdmin']) ?                              
                        '<li>
                            <a href="'.URL().'/admin">
                              <i class="fa fa-fw fa-tasks"></i> Admin Panel
                            </a>
                        </li>'   
                        : '' }}
                        <li>
                            <a href="{{ url('/user/'.$data['userName'].'/settings') }}">
                                <i class="fa fa-fw fa-gear"></i> Settings
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL() }}/logout"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </li>
      </ul>
    
  </div>
</nav>

<div class="container-fluid">
   
    <nav class="navbar navbar-default no-margin">
        
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header fixed-brand">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
            id="menu-toggle">
              <i class="fa fa-bars"></i>
            </button>
        </div><!-- navbar-header-->

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active" >
                    <button class="navbar-toggle collapse in" data-toggle="collapse"
                     id="menu-toggle-2"><i class="fa fa-bars"></i>
                    </button>
                </li>
            </ul>
        </div><!-- bs-example-navbar-collapse-1 -->
    </nav>
    
    <div id="wrapper"> <!-- PAGE WRAPPER -->
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">

                <li {{ ($data['nav'] === 'dashboard') ? 'class="active"' : '' }}>
                    <a href="{{ url('/user/'.$data['userName']) }}">
                    <span class="fa-stack fa-lg pull-left">
                    <i class="fa fa-tachometer fa-stack-1x "></i></span>Dashboard</a>
                </li>
                
                <li {{ ($data['nav'] === 'upload') ? 'class="active"' : '' }}>
                    <a href="{{ url('/user/'.$data['userName']).'/upload' }}">
                     <span class="fa-stack fa-lg pull-left">
                    <i class="fa fa-cloud-upload fa-stack-1x "></i></span>Upload</a>
                </li>
                
                <li {{ ($data['nav'] === 'files') ? 'class="active"' : '' }}>
                    <a href="{{ url('/user/'.$data['userName'].'/files') }}">
                    <span class="fa-stack fa-lg pull-left">
                    <i class="fa fa-dropbox fa-stack-1x "></i></span>My Files</a>
                </li>

                <li {{ ($data['nav'] === 'send') ? 'class="active"' : '' }} >
                    <a href="{{ url('/user/'.$data['userName'].'/send') }}">
                    <span class="fa-stack fa-lg pull-left">
                    <i class="fa fa-paper-plane fa-stack-1x "></i></span>Send Files</a>
                </li>
                @if(DB::table('pages')->count() )
                <li {{ ($data['nav'] === 'pages') ? 'class="active"' : '' }} >
                    <a href="{{ url('/user/'.$data['userName'].'/pages') }}">
                    <span class="fa-stack fa-lg pull-left">
                    <i class="fa fa-files-o fa-stack-1x "></i></span> Pages</a>
                </li>
                @endif
                
            </ul>
        </div><!-- /#sidebar-wrapper -->
@if( Social::find(1) )
<div class="hidden-xs" id='social-sidebar'><!-- SOCIAL Media SIDEBAR -->
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
@if( $data['topAds'] )
<!-- Top Advertising Area  -->
<div style="margin-bottom:20px;" class="col-md-11 ">
<div class="ads">
    {{ $data['topAds'] }}
</div>
</div>
<!-- /# TopAdvertising Area  -->
@endif
