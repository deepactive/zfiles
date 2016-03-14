<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site Closed for Maintenance | {{ Settings::find(1)->sitename }}</title>
    <title>Oops File Not Exists | {{ Settings::find(1)->sitename }}</title>
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
       <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>


      <div style="margin-top:200px;" class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 System Message
            </div>
            <div class="panel-body">
                        <i style="color:#1E7FB2;" class="fa fa-4x fa-exclamation-triangle"></i>

<h3 style="line-height:40px;color:#1869A0;">
    Sorry, Site Closed for Maintenance ..
</h3>
           
            </div>
            </div>
            </div>

  


    <!-- jQuery -->
    {{ HTML::script('public/themes/defualt/assets/js/jquery-1.11.3.min.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/themes/defualt/assets/js/bootstrap.min.js') }}    
    
   

</body>
