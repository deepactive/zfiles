<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ url().'/public/themes/uploads/favicon.png' }}">
    <title>{{ $data['title'].' | '.$data['settings']->sitename }}</title>    
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('public/admin/assets/css/bootstrap_2.min.css') }}
    <!-- Font Awesome CSS -->
    {{ HTML::style('public/admin/assets/font-awesome/css/font-awesome.min.css') }}
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('public/admin/assets/css/sb-admin.css') }}

</head>

<body>

<div id="wrapper">

@include('admin.header')

  <div id="page-wrapper">

      <div class="container-fluid">
      
@yield('admin.main')

      </div>

  </div>
  @include('admin.footer')

</div>

    <!-- jQuery -->
    {{ HTML::script('public/admin/assets/js/jquery-1.11.3.min.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/admin/assets/js/bootstrap.min.js') }}
    {{ HTML::script('public/admin/assets/js/tables.min.js') }}
    {{ HTML::script('public/admin/assets/js/jquery.confirm.js') }}


 <script type="text/javascript">
     $(".confirm").confirm();

$(".alert").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert").alert('close');
});  
     
     $('#adsPage > option:last').hide();
     $('#adsPosition > option:last').hide();
    /* Load adsCode into textarea <selec> */
$("#adsPage").change(function() {
    $("#adsPosition").val('Position')
                                $("#adsContent").val(null)

});
     
  $("#adsPosition").change(function() 
  {
              $.ajax({
                        url: window.location+'/adsContent',
                        type: 'PUT',
                        dataType: "JSON",
                        data: {
                            "page": $("#adsPage").val(),
                            "position":$("#adsPosition").val(),
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (Response){
                                $("#adsContent").val(Response)
                                console.log(Response);

                        }
                });
  });
    
</script>
</body>
</html>
