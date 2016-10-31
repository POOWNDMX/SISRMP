@extends('Layouts.BaseAdmin')

@section('titulo')
Administrador | Create
@endsection

@section('cabecera')


@stop


@section('cuerpo')

<div class="container">
	<div class="page-header">
    <center>
      <h4>
        <i class='glyphicon glyphicon-inbox'></i>
      </h4>
      <h5> Formulario para registrar un nuevo usuario administrador</h5>
    </center>
  </div>

  @if (Session::get('mensaje') )
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <i class="glyphicon glyphicon-ok"></i> {{Session::get('mensaje')}}
    </div>
  @endif
  
  <div class="panel panel-primary" >
    <div class="panel-heading">Ingresa los datos, todos los campos son obligatorios.</div>
      <div class="panel-body" >

          {{ Form::open(array('url' => 'admin/FrmRegis_AdminUser', 'method' => 'POST', 'files' => true, 'class' => 'form-horizontal'))}}
                      
              <fieldset>
                <legend><font size="2" color="#96BCC9">Datos del nuevo usuario administrador</font></legend>
                           
                  <div class="form-group">
                      {{ Form::label('', 'Nombre:', array('class' => 'col-lg-3 control-label')) }}
                    <div class="col-lg-4">
                      {{ Form::text('first_name', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Nombre', Input::old('first_name'))) }}
                                      
                        @if( $errors->has('first_name') )          
                          @foreach($errors->get('first_name') as $error )   
                            {{ $error }}</br>
                          @endforeach       
                        @endif
                    </div>
                  </div>

                  <div class="form-group">
                      {{ Form::label('', 'Apellidos:', array('class' => 'col-lg-3 control-label')) }}
                    <div class="col-lg-4">
                      {{ Form::text('last_name', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Apellidos', Input::old('last_name'))) }}
                                      
                        @if( $errors->has('last_name') )          
                          @foreach($errors->get('last_name') as $error )   
                            {{ $error }}</br>
                          @endforeach      
                        @endif
                    </div>       
                  </div>

                  <div class="form-group">
                      {{ Form::label('', 'Usuario:', array('class' => 'col-lg-3 control-label')) }}
                    <div class="col-lg-4">
                      {{ Form::text('username', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Nombre de usuario...','maxlength' => '20', Input::old('username') )) }}
                    
                        @if( $errors->has('username') )
                          @foreach($errors->get('username') as $error )
                            {{ $error }}</br>
                          @endforeach
                        @endif
                    </div>     
                  </div>

                  <div class="form-group">
                      {{ Form::label('', 'Contraseña:', array('class' => 'col-lg-3 control-label')) }}
                    <div class="col-lg-4">
                      <input name="password" type="password" value="" class="form-control" placeholder="Contraseña..." maxlength="20">
                    </div>
                  </div>

                  <div class="form-group">
                      {{ Form::label('', 'Confirmación de contraseña:', array('class' => 'col-lg-3 control-label')) }}
                    <div class="col-lg-4">
                      <input name="password_confirmation" type="password" value="" class="form-control" placeholder="Repita la contraseña..." maxlength="20">

                        @if( $errors->has('password') )
                          @foreach($errors->get('password') as $error )
                            {{ $error }}</br>
                          @endforeach           
                        @endif
                    </div>
                  </div>
                          
                  {{ Form::submit('Registrar', array('class' => 'btn btn-primary')) }}

                  <button type="reset" class="btn btn-default">
                    <span class="glyphicon glyphicon-erase" ></span> Borrar
                  </button>

                  <a href="{{ URL::previous() }}">
                    <button type="button" class="btn btn-default">
                      <span class="glyphicon glyphicon-arrow-left" ></span> Cancelar
                    </button>
                  </a>
              </fieldset>

        {{ Form::close() }}

      </div><!-- end div pabel-body -->
  </div><!-- end div panel-primary -->
</div><!-- end div container -->

@stop

