@extends('admin.index')
@section('admin.main')
    
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-bullhorn"></i> Advertising
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>                
                <li >
                    <i class="fa fa-fw fa-bullhorn"></i> Advertising
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
            <label for="adsPage">
               Select Page
            </label>

            {{  Form::select('adsPage',
             array('home' => 'Home Page',
                   'profile' => 'User Profile Page',
                   'download' => 'Download File Page',
                   'page' => 'Select Page'
                   ),
                   'page',
             array('class' => 'form-control','id'=>'adsPage')) }}
            
            <div class="clearfix"><br></div>

            <label for="position">
               Select Position
            </label>

            {{  Form::select('adsPosition',
             array('top' => 'Top',
                   'bottom' => 'Bottom',
                   'Position' => 'Select Position'
                   ),
                   'Position',
             array('class' => 'form-control','id'=>'adsPosition')) }}
            <br>
             
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <label for="adsContent">
                        <i class="fa fa-fw fa-code"></i> Ads Code
                        <small style="font-size:11px;" >
                        ( <i class="fa fa-info"></i> Leave empty to disable it)</small>
                    </label>
                    </div>
                  
                  <div class="panel-body">
                   

                    <div class="form-group">
                    <div class="input-group">
                        {{ Form::textarea('adsContent',
                          '',array(
                           'class'=>'form-control',
                           'id' => 'adsContent'
                        )) }}
                        <span class="input-group-addon">
                        <i class="fa fa-code"></i> Ads Code</span>
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
                 {{ Form::close() }}

    </div>

<script>

</script>


@endsection
@stop