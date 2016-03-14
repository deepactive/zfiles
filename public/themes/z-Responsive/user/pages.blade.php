@extends('user.--index')
@section('pages')

    <div class="header-content">
      
      <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i style="font-size:18px;" class="fa fa-fw fa-files-o"></i> Website Pages
            </div>
            <div class="panel-body">

               <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <ul class="list-group text-left">
                            
                            @foreach($data['pages'] as $key=>$page)
                            <a style="font-weight:500;" target="_blank" href="{{ url('page/'.$page->pageName) }}"
                                class="list-group-item">
                                {{ $key +1 }} | 
                                <i class="fa fa-fw fa-external-link-square"></i> 
                                {{ $page->pageName }}
                                <span class="pull-right hidden-xs">
                                    <i style="font-size:18px;" class="fa fa-fw fa-clock-o"></i>
                         {{ Carbon::createFromFormat('Y-m-d H:i:s', $page->created_at)->diffForHumans(); }}
                                </span>
                            </a>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                </div>
               
            </div>
        </div>
      </div>
       
    </div>
@endsection
@stop