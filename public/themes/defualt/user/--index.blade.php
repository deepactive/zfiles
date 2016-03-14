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
    {{ HTML::style('public/themes/defualt/assets/css/bootstrap_2.min.css') }}
    <!-- Font Awesome Fonts -->
    {{ HTML::style('public/themes/defualt/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- Custom CSS -->
    @yield('style')
    {{ HTML::style('public/themes/defualt/assets/css/index.css') }}
    {{ HTML::style('public/themes/defualt/assets/css/user.css') }}
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
        
@yield('content')

@include('user.--footer')


<!-- jQuery -->
{{ HTML::script('public/themes/defualt/assets/js/jquery-1.11.3.min.js') }}
<!-- Bootstrap Core JavaScript -->
{{ HTML::script('public/themes/defualt/assets/js/bootstrap.min.js') }}
@yield('javascript')
      
<script language="javascript">
    
$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    
     $("#menu-toggle-2").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled-2");
        $('#menu ul').hide();
    });
 
     function initMenu() {
      $('#menu ul').hide();
      $('#menu ul').children('.current').parent().show();
      //$('#menu ul:first').show();
      $('#menu li a').click(
        function() {
          var checkElement = $(this).next();
          if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            return false;
            }
          if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('#menu ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
            return false;
            }
          }
        );
      }
    
    $(document).ready(function() {initMenu();});
  
</script>