@extends('user.--index')
@section('style')
   <!-- DROPZONE Core JavaScript -->
    {{ HTML::script('public/themes/z-Responsive/assets/js/dropzone.js') }}
    <!-- DropZone CSS -->
    {{ HTML::style('public/themes/z-Responsive/assets/css/basic.css') }}
    {{ HTML::style('public/themes/z-Responsive/assets/css/dropzone.css') }}
@endsection

@section('upload')

    <div class="header-content">
      
      <div class="col-md-12">
       
        <div class="panel panel-primary">
          
          <div class="panel-heading">
            <i style="font-size:18px;" class="fa fa-cloud-upload">
            </i> Upload New Files / Photos  
            <span style="font-size:11px;">
            (Max Files:{{ uploadsettings::find(1)->maxUploadsFiles }})
            | Max File Size :({{ formatFileSize(uploadSettings::find(1)->maxFileSize) }}) 

            </span>   
          </div>
          
          <div class="panel-body">
            
            <div style="overflow:visible;" id="dropzone">
                {{ Form::open(array(
                    'url' => url().'/uploadFile',
                    'class'=>'dropzone', 
                    'id'=>'my-dropzone')) 
                }}

                <!-- Multiple file upload-->

                <div class="dz-message"><center>
                    <i style="font-size:45px" class="fa fa-cloud-upload fa-2x"></i>
                    <h4>Drag Your Files - Photos to Upload</h4>
                    <span>Or click to browse</span></center>

                </div> 

                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>

            {{ Form::close() }}
        </div>
        <br><small>File Extensions :[{{ uploadSettings::find(1)->allowedFilesExt }}] </small>

            
          </div>
          
        </div> <!-- /# END panel default -->
        
      </div> <!-- /# END col-md 12 --> 
       
    </div> <!-- /# END HEADER CONTETNT -->
@endsection


@section('javascript')

<script language="javascript">
// myDropzone is the configuration for the element that has an id attribute
  // with the value my-dropzone (or myDropzone)
    Dropzone.options.myDropzone = {
        maxFiles: {{ uploadsettings::find(1)->maxUploadsFiles }},
        maxFilesize: {{ $data['MaxUploadSize']}},


  init: function () {
       this.on("maxfilesexceeded", function(file){
    });

    this.on("success", function (file) {
      if (this.getQueuedFiles().length === 0) {
            // Your application has indicated there's an error
            window.setTimeout(function(){

            // Move to a new location or you can do something else
            window.location = "{{ url('user/'.Auth::User()->username.'/files') }}";

    }, 3000);
      }
    });
  }
};
    
</script>
@endsection
@stop
