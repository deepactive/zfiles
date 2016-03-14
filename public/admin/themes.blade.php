@extends('admin.index')
@section('admin.main')
    
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-paint-brush"></i> Themes
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>                
                <li class="active">
                    <i class="fa fa-fw fa-desktop"></i> Template Design 
                </li>
                <li >
                    <i class="fa fa-fw fa-paint-brush"></i> Themes
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    

    <div class="row"> 
          
           @if(Session::has('Message'))
                  <div class="col-md-12">
                  {{ Session::get('Message') }}
                </div>

            @endif

            {{ Form::open( array(
                'role' => 'form',
                'files'=> true

            ) ) }}       
        
                
		<!-- Themes -->
		@foreach($data['themes'] as $theme)
			<div style="overflow:hidden;" class="col-sm-6 col-md-4">
					
					<article style="border-radius:3px 3px 0 0;border:2px solid #ddd;" >
						<header>
                            <img style="width:100%;height:100%;"
                             src="{{ url().'/public/themes/'.$theme
                             ->themeFileName.'/thumbnail.jpg' }}">
						</header>
						
						<footer style="background:#E2E2E2;padding:3px;">
							
							<div>
								<i class="entypo-monitor"></i>
								{{ $theme->themeName }}
								<span style="margin-left:8px; font-size:8px;
								 line-height:17px; float:right; display:block">
								 Version 1.0.0</span>
							</div>
							
							<div >
                                    @if($theme->themeStatus == 1)
                                        <span 
                                        style="display:block;padding:3px;background:#18BC9C;
                                         color:#fff; cursor:defualt;">
                                        <i class="fa fa-check"></i>
                                        Active</span>
                                    @else
                                        <a href="{{ url('/admin/themes/activate/'.$theme
                                        ->themeName) }}" 
                                        style="text-decoration:none;
                                        display:block;padding:3px;background:#2F353F;
                                         color:#18BC9C; cursor:pointer;">
                                        Activate</a>
                                    @endif
							</div>
							
						</footer>
					</article>
					
				</div>
        @endforeach
		<!-- /#Themes -->

    </div>

    
@endsection
@stop