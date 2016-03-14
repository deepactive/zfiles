
{{ ($data['adminPreviewMode']) ?                              
    '<div class="alert alert-danger alert-dismissible"  style="margin:0px;" role="alert">
      <button type="button" class="close" data-dismiss="alert"
       aria-label="Close"><span aria-hidden="true">&times;</span>
      </button>
      <strong><i class="fa fa-info-circle "></i>

     Take Notice!</strong> Dir Admin, This Is (Admin Preview Mode), Not Your Personal Account ,
      <a style="color:#2C3E50;" 
          href="'.url('user/'.Auth::user()->username).'">
          <b>Back To Your Account</b>
      </a>
     </div>'   
: '' }}

@if(Session::has('message'))

<div class="alert alert-success alert-dismissible"  style="margin:0px;" role="alert">
      <button type="button" class="close" data-dismiss="alert"
       aria-label="Close"><span aria-hidden="true">&times;</span>
      </button>
      <strong><i class="fa fa-ok-circle "></i>

     Welcome</strong> {{ $data['userName'] }}, Thanks For Signup, best regards, {{ Settings::find(1)->sitename }} Team.  
     </div>

@endif

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
                    <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
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
    
  </div><!-- /.navbar-collapse -->
</nav>