
@extends('user.--index')

@section('dashboard')

    <div class="header-content">
      
      <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i style="font-size:18px;" class="fa fa-bar-chart"></i> Your Files Statistics
            </div>
            <div class="panel-body">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i style="font-size:45px" class="fa fa-cloud-upload fa-stack-2x"></i>
                        </div>
                        <div class="col-xs-9 ">
                            <div class="huge">{{ $data['totalFiles'] }}</div>
                            <div>Total Uplaoded Files</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i style="font-size:45px;" class="fa fa-hdd-o fa-stack-2x"></i>
                        </div>
                        <div class="col-xs-9">
                            <div class="huge">{{ $data['totalFilesSize'] }}</div>
                            <div>Total Files Size</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                        <i style="font-size:45px;" class="fa fa-hdd-o fa-stack-2x"></i>
                        </div>
                        <div class="col-xs-9">
                            <div class="huge">{{ $data['totalFreeDiskSpace'] }}</div>
                            <div>Your Free Disk Space</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                        <i style="font-size:45px" class="fa fa-cloud-download fa-stack-2x"></i>
                        </div>
                        <div class="col-xs-9">
                            <div class="huge">{{ $data['totalDownloadedFiles'] }}</div>
                            <div>Total Download Files</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
           
            </div>
            </div>
            </div>
       
        </div>
@endsection
@stop
