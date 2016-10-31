@extends('Layouts.BaseAdmin')

@section('titulo')
Login | Truncate DB
@endsection

@section('cabecera')


@stop


@section('cuerpo')

<div class="container">
	 <div class="page-header">
      <center>
      <h5>Login</h5>
        <h4>
          <font class="text-primary">
            <strong><i class="glyphicon glyphicon-hdd"></i>
              Truncar Base de datos
            </strong>
          </font>
        </h4>
    </center>
  </div>

  @if (Session::has('messageErrorPasswd'))
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-emove-circle"></i>{{ Session::get('messageErrorPasswd') }}
    </div>
  @endif

  @if (Session::has('messageWarningPasswd'))
    <div class="alert alert-dangerPasswd alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h5><i class="glyphicon glyphicon-warning-sign"></i> Información...</h5>
          {{ Session::get('messageWarningPasswd') }}
        <h6><p class="text-primary">Verifica tus datos </p></h6> 
    </div>
      <br>
  @endif


  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="form-wrap">
            <br>
              <div class="panel panel-success " >
                <div class="panel-heading">
                  <center><span class="glyphicon glyphicon-user" ></span>Contraseña actual</center>
                </div>

                <div class="panel-body" >      
                  
                  {{ Form::model($administrador,['method' => 'PUT', 'route' => 'Admin.truncateAccess'])}}   

                     
                    <div class="form-group has-feedback has-feedback-left">
                      {{ Form::password('passwordAct', array('class' => 'form-control', 'placeholder' => 'Contraseña / Password', 'maxlength' => '20')) }}
                        <i class="form-control-feedback glyphicon glyphicon-lock"></i> 

                        @if( $errors->has('passwordAct') )          
                          @foreach($errors->get('passwordAct') as $error )   
                            {{ $error }}</br>
                          @endforeach            
                        @endif

                    </div>
                      
                    {{ Form::submit('Entrar', array('class' => 'btn btn-custom btn-sm btn-block')) }}
                      
                  {{ Form::close() }}


                    
                    <hr>
                       </div>  <!-- /.panel-body-->
                    </div>  <!-- /.panel-info -->
                </div> <!-- /.form-wrap -->
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

 
    
</div><!-- end div container -->


@stop

