@extends('admin.index')
@section('admin.main')
    
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-edit"></i> Theme Customize
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>                
                <li class="active">
                    <i class="fa fa-fw fa-desktop"></i> Template Design 
                </li>
                <li >
                <i class="fa fa-fw fa-edit"></i> Theme Customize
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
        {{ Form::open( array(
                'role' => 'form',
                'files'=> true

            ) ) }}       
        

    <div class="row"> 
          
           @if(Session::has('Message'))
                  <div class="col-md-12">
                  {{ Session::get('Message') }}
                </div>

            @endif

        <div class="col-md-12">
                       <div class="panel panel-default">
                  <div class="panel-heading">
                    <label for="background">
                        <i class="fa fa-fw fa-picture-o"></i> Theme Background
                        <small style="font-size:11px;" >
                        ( <i class="fa fa-info"></i>
                          For Active Theme Only )</small>
                    </label>
                    </div>
                  <div class="panel-body">
                    <div class="form-group">

                   {{ Form::file('background','',array(
                   'class'=>'form-control'
                   )) }}
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <label for="welcomeText">
                        <i class="fa fa-fw fa-code"></i> Home Page Welcom Area
                        <small style="font-size:11px;" >
                        ( <i class="fa fa-info"></i> Leave empty to disable it)</small>
                    </label>
                    </div>
                  
                  <div class="panel-body">
                   

                    <div class="form-group">
                    <div class="input-group">
                        {{ Form::textarea('welcomeText',
                          ThemeCustomize::find(1)->welcomeText,array(
                           'class'=>'form-control'
                        )) }}
                        <span class="input-group-addon">
                        <i class="fa fa-code"></i> HTML Code</span>
                    </div>   
                   </div>
                </div>
                
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <label for="someHtml">
                        <i class="fa fa-html5"></i> Add Html Code <small>( Home Page )</small>
                        <small style="font-size:11px;" >
                        ( <i class="fa fa-info"></i> Leave empty to Ignore it)</small>
                    </label>
                    </div>
                  
                  <div class="panel-body">
                   

                    <div class="form-group">
                    <div class="input-group">
                        {{ Form::textarea('someHtml',
                          ThemeCustomize::find(1)->someHtml,array(
                           'class'=>'form-control'
                        )) }}
                        <span class="input-group-addon">
                        <i class="fa fa-code"></i> HTML Code</span>
                    </div>   
                   </div>
                </div>
                
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <label for="someCss">
                        <i class="fa fa-css3"></i> Add CSS Code <small>( Home Page )</small>
                        <small style="font-size:11px;" >
                        ( <i class="fa fa-info"></i> Leave empty to Ignore it)</small>
                    </label>
                    </div>
                  
                  <div class="panel-body">
                   

                    <div class="form-group">
                    <div class="input-group">
                        {{ Form::textarea('someCss',
                          ThemeCustomize::find(1)->someCss,array(
                           'class'=>'form-control'
                        )) }}
                        <span class="input-group-addon">
                        <i class="fa fa-code"></i> CSS Code</span>
                    </div>   
                   </div>
                </div>
                
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">

            <div class="form-group">
                {{ Form::button('<i class="fa fa-save"></i> Save', array(
                   'type' => 'submit',
                   'class' => 'btn btn-success  btn-block'
                   ));
                }}
            </div>
            <br >

        </div>           
        
                
		<!-- Themes -->

        

		<!-- /#Themes -->
    
    {{ Form::close() }}
    </div>

    
@endsection
@stop