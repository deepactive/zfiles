       <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a style="padding-top:10px;" class="navbar-brand" href="{{ URL() }}/admin">
                    <img alt="Brand" src="{{ url().'/public/themes/uploads/logo.png' }}">
                </a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-left top-nav">
                <li>
                    <a target="_blank" href="{{ URL() }}">
                      <span class="label label-info">
                      <i class="fa fa-external-link"></i> View My Site</span>
                    </a>
                </li>

                <li>
                    <a target="_blank" href="{{ URL() }}">
                      <span class="label label-warning">
                      <i class="fa fa-external-link"></i> Check For Update</span>
                    </a>
                </li>
                         <li>
                    <span class="label label-success"> Version 1.0.0 </span>
                </li>

            </ul>
            <ul class="nav navbar-right top-nav">


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i> {{ Auth::User()->username }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{url()}}"><i class="fa fa-fw fa-user"></i> My Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ URL() }}/logout">
                            <i class="fa fa-sign-out"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav ">
                            

                    <li class="{{ $data['active'] === 'dashboard' ? 'selected' : '' }}">
                        <a href="{{ url() }}/admin">
                        <i class="fa fa-tachometer"></i>
                            Dashboard
                        </a>
                    </li>


                    <li class="{{ $data['active'] === 'upload' ? 'selected' : '' }}">
                        <a href="{{ url() }}/admin/upload">
                        <i class="fa fa-fw fa-cloud-upload"></i> Upload Settings</a>
                    </li>               
                                    
                    <li class="">
                        <a href="javascript:;"
                         data-toggle="collapse"
                        data-target="#users">
                         <i class="fa fa-fw fa-users"></i> users Settings 
                        <b class="caret"></b></a>
                    <ul id="users" class="{{ @$data['ul'] === 'users' ? 'expand' : 'collapse' }}">
                        <li class="{{ $data['active'] === 'users' ? 'selected' : '' }}">
                            <a href="{{ url() }}/admin/users">
                        <i class="fa fa-fw fa-users"></i> Show Users </a>
                        </li>                        
                        
                    </ul>
                    </li>                

                                        
                    <li class="">
                        <a href="javascript:;"
                         data-toggle="collapse"
                        data-target="#demo">
                         <i class="fa fa-fw fa-files-o"></i> Files Settings 
                        <b class="caret"></b></a>
                    <ul id="demo" class="{{ @$data['ul'] === 'files' ? 'expand' : 'collapse' }}">
                        <li class="{{ $data['active'] === 'files' ? 'selected' : '' }}">
                            <a href="{{ url() }}/admin/files">
                            <i class="fa fa-fw fa-user"></i> Users Files </a>
                        </li>                        
                        
                        <li class="{{ $data['active'] === 'guestFiles' ? 'selected' : '' }}">
                            <a href="{{ url() }}/admin/guestFiles">
                            <i class="fa fa-fw fa-user-secret"></i> Anonymous Files </a>
                        </li>
                        
                    </ul>
                    </li>

                    <li class="">
                        <a href="javascript:;"
                         data-toggle="collapse"
                        data-target="#email">
                         <i class="fa fa-fw fa-send"></i> Email Settings
                        <b class="caret"></b></a>
                    <ul id="email" class="{{ @$data['ul'] === 'email' ? 'expand' : 'collapse' }}">
                        <li class="{{ $data['active'] === 'email' ? 'selected' : '' }}">
                          <a href="{{ url() }}/admin/email">
                            <i class="fa fa-fw fa-server"></i> Mail Server</a>
                        </li>   
                        
                        
                        
                        <li class="{{ $data['active'] === 'emailTemplates' ? 'selected' : '' }}">
                          <a href="{{ url() }}/admin/emailTemplates">
                            <i class="fa fa-fw fa-envelope-o"></i> Email Templates</a>
                        </li>                  
                        
                    </ul>
                    </li>   
                    
                    <li class="">
                        <a href="javascript:;"
                         data-toggle="collapse"
                        data-target="#tempalteDeisng">
                        <i class="fa fa-fw fa-desktop"></i>  appearance 
                        <b class="caret"></b></a>
                    <ul id="tempalteDeisng" class="{{ @$data['ul'] === 'templateDesign' ? 'expand' : 'collapse' }}">
                    
                    <li class="{{ $data['active'] === 'templateDesign' ? 'selected' : '' }}">
                        <a href="{{ url() }}/admin/themes">
                            <i class="fa fa-fw fa-paint-brush"></i> Themes
                        </a>
                    </li>
                    
                    <li class="{{ $data['active'] === 'themeCustomize' ? 'selected' : '' }}">
                        <a href="{{ url() }}/admin/themeCustomize">
                            <i class="fa fa-fw fa-pencil-square-o"></i> Theme Customize
                        </a>
                    </li>
                    
                    
                    </ul>
                    </li>
                    
                    <li class="{{ $data['active'] === 'pages' ? 'selected' : '' }}">
                        <a href="{{ url() }}/admin/pages">
                            <i class="fa fa-fw fa-files-o"></i> Pages
                        </a>
                    </li>    
                                          
                    <li class="{{ $data['active'] === 'advertising' ? 'selected' : '' }}">
                        <a href="{{ url() }}/admin/advertising">
                            <i class="fa fa-fw fa-bullhorn"></i> Advertising
                        </a>
                    </li>                
                          

                    <li class="{{ $data['active'] === 'social' ? 'selected' : '' }}">
                        <a href="{{ url() }}/admin/social">
                            <i class="fa fa-fw fa-connectdevelop"></i> Social Links
                        </a>
                    </li>                
                  
      
                    <li class="{{ $data['active'] === 'plugins' ? 'selected' : '' }}">
                        <a href="{{ url() }}/admin/plugins">
                            <i class="fa fa-fw fa-plug"></i> Plugins 
                        </a>
                    </li>
                    
                    <li class="{{ $data['active'] === 'settings' ? 'selected' : '' }}">
                        <a href="{{ url() }}/admin/settings">
                        <i class="fa fa-fw fa-globe"></i>
                            Website Settings
                        </a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
