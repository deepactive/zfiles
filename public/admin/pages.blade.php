@extends('admin.index')
@section('admin.main')
    
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-files-o"></i> Pages Settings
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>                
                <li >
                    <i class="fa fa-fw fa-files-o"></i> Pages Settings
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

        <div class="col-md-12">
        <div class="col-md-6">
            <div class="form-group">
               <a class="btn btn-info" href="{{ url('admin/pages/create') }}">
                   <i class="fa fa-plus-circle"></i> New Page
               </a>

            </div>
            <br >

        </div>

        
        
           <div class="clearfix"></div>

            <div class="panel panel-default">
                  <div class="panel-heading">
                    
                         All Pages  
                    
                    </div>
                  
                <div class="panel-body">

                          <table id="table-pagination" data-toggle="table"

               data-classes="table table-bordered table-striped table-hover"
               data-search-align="left"

            >
              <thead>
                <tr >
                    <th data-sortable="true" data-field="id">
                    <i class="fa fa-list-ol"></i>
                    </th>
                    <th data-search="true" data-field="name">
                        <i class="fa fa-file"></i> Page Name
                    </th>

                    <th data-search="false" data-field="title">
                         <i class="fa fa-file-o"></i> Page title
                    </th>

                    <th data-search="false" data-field="link">
                        <i class="fa fa-link"></i> Page Link
                    </th>
                    <th data-search="false" data-field="date">
                        <i class="fa fa-clock-o"></i> Created at
                    </th>
                    <th data-search="false" data-field="options"> 
                        <i class="fa fa-gear"></i> Options
                    </th>

                </tr>                
             
                </thead>
                <tbody style="text-align:left;">
                   
                    @foreach($data['pages'] as $key=>$page)
                    
                       <tr id="tr-{{ $key+1 }}" >
                        <td style="display:none;" data-field="id">
                        {{ $key+1 }}
                        </td>

                        <td data-field="name">
                          {{ mb_substr($page->pageName,0,15,"utf-8") }}
                        </td>


                        <td data-field="title">
                          {{ mb_substr($page->pageTitle,0,15,"utf-8") }}
                        </td>


                        <td data-field="link">
                            <a target="_blank" style="text-decoration:underline;
                            font-size:14px;" href="{{ url('page/'.$page->pageName) }}">
                             <i class="fa fa-external-link"></i> {{ $page->pageName }}
                            </a>
                        </td>
                        
                        <td data-field="date">
                         {{ Carbon::createFromFormat('Y-m-d H:i:s', $page->created_at)->diffForHumans(); }}

                        </td>

                        <td data-field="fileOptions">
  
                            <a style="text-decoration:none;font-size:15px;"
                             href="{{ url('admin/pages/edit/'.$page->id) }}"
                                
                             >
                              <i class="fa fa-pencil-square-o"></i> Edit
                            </a>
                            |
                          <a class="confirm" style="text-decoration:none;font-size:15px;"
                             href="{{ url('admin/pages/delete/'.$page->id) }}"
                                
                             >
                              <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
              
            </table>
                {{ $data['pages']->links()  }} 
               
                </div>
                
            </div>

        </div>

        
    </div>

@endsection
@stop