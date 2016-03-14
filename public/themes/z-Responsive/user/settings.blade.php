@extends('user.--index')

@section('style')
<style>
    #social-sidebar{
        display:none;
    }
</style>
@endsection

@section('javascript')


   <div class="container">
    <div class="header-content">
      
      <div class="col-md-12">
       
        <div class="panel panel-primary">
          
          <div class="panel-heading">
            <i style="font-size:18px;" class="fa fa-gear">
            </i> Your Account Settings          
          </div>
          
          <div class="panel-body text-left">
           @if(Session::has('Message'))
                  {{ Session::get('Message') }}
            @endif
            
            @if($errors->any() )

                <div style="padding:8px;margin-bottom:25px;"
                 class="alert alert-danger text-left" role="alert">
                <ul style="list-style:none;" >
                    {{ implode('',$errors->all('
                        <li ><i class="fa fa-exclamation-circle"></i> :message</li>
                        '))
                     }}
                </ul>
                </div>

            @endif         
            
            {{ Form::open( array(
                'role' => 'form'

            ) ) }}
           
           
          <div class="form-group">
               {{ Form::label( 'username','Username' ) }}
               
               {{ Form::text('username',$data['userInfo']->username ,array(
               'class'=>'form-control',
               'placeholder'=>'Username'
               )) }}
           </div>
                
            <div class="form-group">
               {{ Form::label('email','Email') }}
                
               {{ Form::text('email',$data['userInfo']->email ,array(
                'class'=>'form-control',
                'placeholder'=>'Email'
                )) }}
            </div>            
                     
                      
        <div class="form-group">
                         {{ Form::label('password','Change Password') }}

           {{ Form::password( 'password',array(
               'id'         =>'password',
               'tabindex'   => '3',
               'class'      => 'form-control',
               'placeholder'=> 'Password'
           ) ) }}

        </div>

        <div class="form-group">
           {{ Form::password( 'password_confirmation',array(
               'id'         =>'password_confirmation',
               'tabindex'   => '4',
               'class'      => 'form-control',
               'placeholder'=> 'Confirm Password'
           ) ) }}

        </div>
 
            <br >
            <div class="form-group ">
                {{ Form::button('<i class="fa fa-check-circle"></i> Save', array(
                   'type' => 'submit',
                   'class' => 'btn btn-primary btn-block'
                   ));
                }}
            </div>
          
        </div>

        {{ Form::close() }}

         
          </div> <!-- /# END panel default -->
          
        </div> <!-- /# END col-md 12 --> 
        
      </div> <!-- /# Header Content --> 
</div>
<script language="javascript">
$("#message-alert").fadeTo(4000, 500).slideUp(500, function(){
    $("#message-alert").alert('close');
});    
</script>

@endsection
@stop