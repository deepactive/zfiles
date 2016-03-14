<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oops 404</title>
    
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/bootstrap_2.min.css') }}
    <!-- Custom Fonts -->
    {{ HTML::style('public/themes/defualt/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- DropZone CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/basic.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('public/themes/defualt/assets/css/user.css') }}
    {{ HTML::style('public/themes/defualt/assets/css/index.css') }}

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

    
  </div>
</nav>
    <div style="margin: auto;" class="header-content">


      <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 File Not Found 
            </div>
            <div class="panel-body">
            <i style="color:#1E7FB2;" class="fa fa-4x fa-exclamation-triangle"></i>

<h3 style="line-height:40px;color:#1869A0;">Sorry,
We can't find the File you're looking for. File May be Expired Or Deleted.. <br><a style="color:#2C3E50;text-decoration:underline;font-size:30px;" href="{{ url() }}">
          <i class="fa fa-home"></i> back to home</a>.</h3>
           
            </div>
            </div>
            </div>

</div>
  


    <!-- jQuery -->
    {{ HTML::script('public/themes/defualt/assets/js/jquery-1.11.3.min.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/themes/defualt/assets/js/bootstrap.min.js') }}    
    
   

</body>
