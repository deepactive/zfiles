<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    <title> Guest Files | {{ $data['settings']->sitename }}</title>
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/bootstrap_2.min.css') }}
    <!-- Custom Fonts -->
    {{ HTML::style('public/themes/defualt/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/index.css') }}
    {{ HTML::style('public/themes/defualt/assets/css/user.css') }}
    {{ HTML::style('public/themes/defualt/assets/css/jquery.frontbox-1.1.css') }}

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

<div style="margin-top:5%;"  class="col-md-11 pull-right">
    
        <div class="panel panel-default">
          
          <div class="panel-heading">
            <i style="font-size:18px;" class="fa fa-dropbox">
            </i> Guest Session Files         
          </div>
          
          <div class="panel-body">

           <div class="alert alert-warning" role="alert">
             <i class="fa fa-exclamation-triangle"></i>
              This Guest Session &amp; Files Expire After [{{ $data['SessionExpireAfter'] }}] Day 
            </div>
                              <div class="clearfix"></div>
                <div class="col-md-6">
                <div id="message-success" style="display:none;" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  your message has been sent successfully.
                </div>
                <div id="message-error" style="display:none;" class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Oop!</strong> 
                  Sorry Email delivery failure.
                </div>
                  
                   </div>
                   <div class="clearfix"></div>
                   
            <div class="col-md-6 text-left">
                       
                        {{ Form::open( array(
                            'role' => 'form'

                        ) ) }}
                       
                        {{ Form::label('email','Send Files Via Emails : ') }}
                       <br><small><i class="fa fa-info"></i>
                        Use (Space) To Add Another Email</small>

                       {{ Form::text('email','',array(
                        'class'=>'form-control',
                        'placeholder'=>'Recipient Emails',
                        'id' => 'rec_email'
                        )) }}
                                        <br>

                    {{ Form::button('<i class="fa fa-send"></i> Send', array(
                       'class' => 'btn btn-primary  btn-block',
                       'id' => 'send'
                       ));
                    }}
                        
                    </div>
                    
                    <div class="clearfix"></div>
                    <br>
            <table id="table-pagination" data-toggle="table"

               data-classes="table table-bordered table-striped table-hover"
               data-search="true"
               data-search-align="left"

            >
              <thead>
                <tr >
                    <th data-field="state" >
                        <i class="fa fa-check-square-o"></i>
                        
                    </th>
                    <th class=" hidden-xs" data-sortable="true" data-field="id">
                    <i class="fa fa-list-ol"></i>
                    </th>
                    <th class=" hidden-xs" data-field="type"><i class="fa fa-filter"></i></th>
                    <th data-search="true" data-field="name"><i class="fa fa-file-text-o"></i> Name</th>
                    <th class=" hidden-xs" data-search="false" data-field="size">
                        <i class="fa fa-crosshairs"></i> Size
                    </th>
                    <th class=" hidden-xs" data-search="false" data-field="uploadAt"><i class="fa fa-clock-o"></i> Upload time</th>
                    <th class=" hidden-xs" title="File Status" data-search="false" data-field="status">
                        <i class="fa fa-globe"></i>
                    </th>
                    <th class=" hidden-xs" data-search="false" data-field="downloadCounter">
                      <i class="fa fa-cloud-download"></i> 
                    </th>
                    <th data-search="false" data-field="fileLink"><i class="fa fa-link"></i> File Link</th>
                    <th data-search="false" data-field="fileOptions"><i class="fa fa-link"></i>  Options</th>

                </tr>                
             
                </thead>
                <tbody style="text-align:left;">
                   
                    @foreach($data['guestFiles'] as $key=>$file)
                    
                    <tr id="tr-{{ $key+1 }}" >
                       
                                               <td >

                {{ Form::checkbox('selectedFiles[]',$file->id,null,
                          array(
                           'id'=> 'select-'.($key +1),
                           'data-id' => $file->id)
                           )
                        }}
                        
                        </td>
                       
                        <td class=" hidden-xs" style="display:none;" data-field="id">

{{ ((($data['guestFiles']->getCurrentPage() - 1)* $data['guestFiles']->getPerPage()) + $key+1) }}
                       
                        </td>
                        <td class=" hidden-xs" data-field="type">
                         
                          @if ($file->fileExt === 'jpg' )
                            <i class="fa fa-picture-o"></i> {{ $file->fileExt }} 
                          @elseif ($file->fileExt === 'jpg')
                            <i class="fa fa-picture-o"></i> {{ $file->fileExt }}
                          @elseif ($file->fileExt === 'png')
                            <i class="fa fa-picture-o"></i> {{ $file->fileExt }}
                          @elseif ($file->fileExt === 'zip')
                            <i class="fa fa-file-archive-o"></i> {{ $file->fileExt }}
                          @elseif ($file->fileExt === 'mp3')
                            <i class="fa fa-music"></i> {{ $file->fileExt }}
                          @elseif ($file->fileExt === 'exe')
                            <i class="fa fa-cog"></i> {{ $file->fileExt }}
                          @elseif ($file->fileExt === 'mp4')
                            <i class="fa fa-film"></i> {{ $file->fileExt }}
                          @else
                            <i class="fa fa-file-text-o"></i> {{ $file->fileExt }}
                          @endif
                        </td>
                        <td data-field="name">
                          {{ mb_substr($file->fileName,0,10,"utf-8") }}
                        </td>
                        <td class=" hidden-xs" data-field="size">
                          {{ size( $file->fileSize ) }}
                        </td>
                        <td class=" hidden-xs" data-field="uploadAt">
                          {{ Carbon::createFromFormat('Y-m-d H:i:s', $file->created_at)->diffForHumans(); }}
                        </td>
                        <td class=" hidden-xs" data-field="status">
                          @if ($file->fileStatus == 1 )
                          <i class="fa fa-check"></i>
                          @else
                          <i class="fa fa-times"></i> 
                          @endif
                        </td>                   
                        <td data-field="downloadCounter">
                            {{ $file->fileDownloadCounter }}
                        </td>
                        <td data-field="fileLink">
                            <a target="_blank" style="text-decoration:underline;
                            font-size:14px;" href="{{ $file->filePath }}">
                             <i class="fa fa-external-link"></i>
                              {{ mb_substr(html_entity_decode($file->fileName),0,10,"utf-8") }}
                            </a>
                        </td>
                        <td data-field="fileOptions">
                            <a style="font-size:18px; margin:0 10px;"
                                id="delete-{{ $key+1 }}" data-id="{{ $file->id }}"
                                role="button" class="delete_confirm"
                             >
                              <i class="fa fa-trash"></i>
                            </a>
                            
                            <a  style="font-size:18px;"
                                id="lock-{{ $key+1 }}" data-id="{{ $file->id }}"
                                role="button" class="lock_confirm">
                                
                                @if( count(LockFile::where('fileId','=',$file->id)->get()) )
                                    <i class="fa fa-lock"></i>
                                @else
                                    <i class="fa fa-unlock"></i>
                                @endif
                            </a>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
              
            </table>
                {{ $data['guestFiles']->links()  }} 

          </div>
          
        </div> <!-- /# END panel default -->

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
    {{ HTML::script('public/themes/defualt/assets/js/tables.min.js') }}
    {{ HTML::script('public/themes/defualt/assets/js/jquery.frontbox-1.1.js') }}
{{ HTML::script('public/themes/defualt/assets/js/multiple-emails.js') }}


<script language="javascript">
$(document).ready(function(){
    
    // Callback Function To Get Delete ID
    function createCallback( i ){
        return function(){
            window.id = $(this).data("id");
            window.tr = i;
        }
    }
    
    function e_createCallback( e ){
        return function(){
            window.eid = $(this).data("id");
            window.etr = e;

        }
    }

    // Delete OK/Cancel Question
    $(".delete_confirm").click(function() {

        (new FrontBox).yes_no("are you sure you want to delete this file ?",
                              "<i class='fa fa-trash'></i> Confirm File Delete").callback(function(btn){

            if(btn == 'yes' ){
              $.ajax({
                  
                        url: window.location+'/delete',
                        type: 'DELETE',
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (){
                            $('#tr-' + tr).hide('slow').remove();
                            console.log("deleted");
                        }
                });

                console.log("It failed");
            }
        });
    });

    
    // Lock Question
    $(".lock_confirm").click(function() {

        (new FrontBox).text("Please Insert Password (Leave empty to unlock):",
                              "<i class='fa fa-lock'></i> Lock|unLock File  ").callback(function(btn,ans){

            if(btn == 'ok' ){
              $.ajax({
                        url: window.location+'/lock',
                        type: 'PUT',
                        dataType: "JSON",
                        data: {
                            "eid": eid,
                            "password":ans,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (){
                            if($('#lock-' + etr + ' i').hasClass('fa fa-unlock') && ans.val != ''){
                                $('#lock-' + etr + ' i')
                                    .removeClass('fa fa-unlock').addClass('fa fa-lock')
                                    .css('color','red');
                            }else if($('#lock-' + etr + ' i').hasClass('fa fa-lock') && ans.val != ''){
                                $('#lock-' + etr + ' i')
                                    .removeClass('fa fa-lock').addClass('fa fa-unlock')
                                    .css('color','red');
                                
                            }else if($('#lock-' + etr + ' i').hasClass('fa fa-lock') && ans.val == ''){
                                $('#lock-' + etr + ' i')
                                    .removeClass('fa fa-lock').addClass('fa fa-unlock')
                                    .css('color','red');
                                
                            }
                                console.log("locked");

                        }
                });

                console.log("It failed");
            }
        });
    });

    
  // Delete File Loop To get Clicked Item ID
  for(var i = 1; i <= {{ $data['totalFiles'] }}; i++) {
      $('#delete-' + i).click( createCallback( i ) );  
  }

  // Lock File Loop To get Clicked Item ID
  for(var e = 1; e <= {{ $data['totalFiles'] }}; e++) {
      $('#lock-' + e).click( e_createCallback( e ) );  
  }
        
});
    
    // Callback Function To Get Delete ID
    function createCallback( i ){
        return function(){
            window.id = $(this).data("id");
            window.tr = i;
        }
    }

/* SEND FILES */    
    $("#send").click(function() {
                $(this).removeClass('btn btn-primary').addClass('btn btn-primary m-progress btn-disabled');

            var arr = $.map($('input:checkbox:checked'), function(e,i) {
                return +e.value;
            });
        var email = $("#rec_email").val(); 


              $.ajax({

                url: window.location+'/sendFiles',
                type: 'post',
                dataType: "JSON",
                data: {
                    "email": email,
                    "id": arr,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (){
                        $('#send').removeClass("btn btn-primary m-progress btn-disabled").addClass('btn btn-primary');
                    $('#message-success').css({"display":"block"})

                },error: function (){
                        $('#send').removeClass("btn btn-primary m-progress btn-disabled").addClass('btn btn-primary');
                    $('#message-error').css({"display":"block"})
                }
        });
    });
        

    // select File Loop To get Checked Item ID
      for(var u = 1; u <= {{ $data['totalFiles'] }}; u++) {
          $('#select-' + u).click( createCallback( u ) );  
      }



    		//Plug-in function for the bootstrap version of the multiple email
		$(function() {
			//To render the input device to multiple email input using BootStrap icon
			$('#rec_email').multiple_emails();
			//OR $('#example_emailBS').multiple_emails("Bootstrap");
		
		});

</script>
   
    
</body>
