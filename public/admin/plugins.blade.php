@extends('admin.index')
@section('admin.main')
    
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-plug"></i> Plugins Settings 
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>                
                <li >
                <i class="fa fa-fw fa-plug"></i> Plugins Settings 
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    

    <div class="row">

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
        <div class="col-md-12">
           
            <div class="panel panel-default">

                  
                  <div class="panel-body">
                    <h4><i class="fa fa-fw fa-plug"></i> this Feature as Soon </h4>
                </div>
                
            </div>

        </div>
 

                 {{ Form::close() }}

    </div>




@endsection
@stop