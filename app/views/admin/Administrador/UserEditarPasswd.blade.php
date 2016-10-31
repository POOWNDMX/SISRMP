
@extends('Layouts.BaseAdmin')

@section('titulo')
    Settings | {{ $userAdministrador->first_name.' '.$userAdministrador->last_name }}
@endsection

@section('cabecera')  
@stop


@section('cuerpo')
                           {{-- FORMULARIO PARA EDITAR CONTRASEÑA DE USUARIO ADMINISTRADOR --}}
<div class="container"><!-- div container -->
	<div class="page-header"><!-- div page-header -->
    <center>
      <h5>Configuración de la contraseña </h5>
        <h4>
          <font class="text-primary">
            <strong><i class="glyphicon glyphicon-edit"></i>
              {{ $userAdministrador->first_name.' '.$userAdministrador->last_name }}
            </strong>
          </font>
        </h4>
    </center>
  </div><!-- end div page-header -->

  <!-- SI NO SE EJECUTA ALGUNA OPERACION MUESTRA EL MENSAJE -->
  @if (Session::has('messageFallo'))
    <div class="alert alert-errorOperacion alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-remove"></i>{{ Session::get('messageFallo') }}
    </div>
  @endif

  <h6>
    Este formulario es para cambiar la contraseña del administrador: 
    <font color="red">{{ $userAdministrador->first_name.' '.$userAdministrador->last_name }}
</font>
  </h6>
    <br>

  <div class="panel panel-info" >
    <div class="panel-heading">Ingresa los datos, todos los campos son obligatorios.</div>
      <div class="panel-body" >

          <!-- FORM FOR EDIT PASSWORD CLIENTES -->
          {{ Form::model($userAdministrador, ['method' => 'PUT', 'route' => ['userAdmin.updatePasswd', $userAdministrador -> id], 'class' => 'form-horizontal',  'accept-charset' => 'ISO-8859-1'])}}

              <div class="form-group has-feedback has-feedback-left"><!-- div form-group 1 -->
                  {{ Form::label('', 'Nueva contraseña:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  <input name="password" type="password" value="" class="form-control" placeholder="Contraseña...">
                    <i class="form-control-feedback glyphicon glyphicon-lock"></i>
                                         
                </div><!-- end div col-lg-4 -->        
              </div><!-- end div form-group 1 -->

              <div class="form-group has-feedback has-feedback-left"><!-- div form-group 2 -->
                  {{ Form::label('', 'Confirmación de contraseña:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  <input name="password_confirmation" type="password" value="" class="form-control" placeholder="Repita la contraseña..." maxlength="20">
                    <i class="form-control-feedback glyphicon glyphicon-lock"></i>
                    <span class="help-block">Mínimo 15 cracteres, máximo 20 caracteres.</span>

                        @if( $errors->has('password') )
                          @foreach($errors->get('password') as $error )
                            {{ $error }}</br>
                          @endforeach    
                        @endif

                </div><!-- end div col-lg-4 -->
              </div><!-- end div form-group 1 -->
                                 
              {{ Form::submit('Actualizar contraseña', array('class' => 'btn btn-primary')) }}

              <button type="reset" class="btn btn-default">
                <span class="glyphicon glyphicon-erase" ></span> Borrar
              </button>
                                 
              <a href="{{ URL::previous() }}">
                <button type="button" class="btn btn-default">
                  <span class="glyphicon glyphicon-arrow-left" ></span> Cancelar
                </button>
              </a>

          {{ Form::close() }}<!-- END FORM FOR EDIT PASSWORD CLIENTES -->
                   
                       

      </div><!-- end div panel-body -->
  </div><!-- end div panel-info -->
</div><!-- end div container -->

@stop