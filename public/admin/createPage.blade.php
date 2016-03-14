@extends('admin.index')
@section('admin.main')
    
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-files-o"></i> Create Page
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>                
                <li class="active">
                    <i class="fa fa-fw fa-files-o"></i> Pages Settings
                </li>
                <li >
                    <i class="fa fa-fw fa-plus-circle"></i> Create Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    

    <div class="row">

            <div class="col-md-6">
                <a href="{{ url('admin/pages') }}">
                    <i class="fa fa-arrow-circle-left fa-2x"> Back</i>
                </a>
                
            </div>
            <div class="clearfix"></div><br>
            @if($errors->any() )
                <div class="col-md-12">
                    <div style="padding:8px;margin-bottom:25px;"
                     class="alert alert-danger text-left" role="alert">
                    <ul style="list-style:none;" >
                        {{ implode('',$errors->all('
                            <li ><i class="fa fa-exclamation-circle"></i> :message</li>
                            '))
                         }}
                    </ul>
                    </div>
                </div>

            @endif    
          
           @if(Session::has('Message'))
                  <div class="col-md-12">
                  {{ Session::get('Message') }}
                </div>

            @endif

            {{ Form::open( array(
                'role' => 'form',
                'files'=> true

            ) ) }}
            <div class="col-md-6">

            <div class="panel panel-default">
                  <div class="panel-heading">
                                        
                    <label for="pageContent">
                        <i style="font-size:16px;" class="fa fa-file-text-o"></i> Page Name
                    </label>
                    </div>
                  
                  <div class="panel-body">
                    <div class="form-group">
                        {{ Form::text('pageName',
                          '',array(
                           'class' =>'form-control'
                        )) }}
                   </div>
                </div>
                
            </div>
            
            </div>
            <div class="col-md-6">

            <div class="panel panel-default">
                  <div class="panel-heading">
                                        
                    <label for="pageOrder">
                        <i style="font-size:16px;" class="fa fa-list"></i> Page order
                    </label>
                    </div>
                  
                  <div class="panel-body">
                    <div class="form-group">
                        {{ Form::number('pageOrder',
                          '',array(
                           'class' =>'form-control'
                        )) }}
                   </div>
                </div>
                
            </div>
            
            </div>

            <div class="col-md-12">

            <div class="panel panel-default">
                  <div class="panel-heading">
                                        
                    <label for="pageContent">
                         Page Title
                    </label>
                    </div>
                  
                  <div class="panel-body">
                    <div class="form-group">
                        {{ Form::text('pageTitle',
                          '',array(
                           'class' =>'form-control'
                        )) }}
                   </div>
                </div>
                
            </div>
            
            </div>

       
        <div class="col-md-12">

            <div class="panel panel-default">
                  <div class="panel-heading">
                                        
                    <label for="pageContent">
                        <i style="font-size:16px;" class="fa fa-html5"></i> Page Content
                    </label>
                    </div>
                  
                  <div class="panel-body">
                    <div class="form-group">
                        {{ Form::textarea('pageContent',
                          '',array(
                           'class' =>'form-control',
                           'id'    => 'editor1' 
                        )) }}
                   </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::button('<i class="fa fa-fw fa-plus-circle"></i> Add Page', array(
                   'type' => 'submit',
                   'class' => 'btn btn-success  btn-block'
                   ));
                }}
            </div>
        {{ Form::close() }}

        
    </div>
    
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>
@endsection
@stop