@extends('Layouts.BaseAdmin')

@section('titulo')
Edit Passwd | {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}
@endsection

@section('cabecera')


@stop


@section('cuerpo')

                          {{-- FORMULARIO PARA EDITAR CONTRASEÑA DE USUARIO ADMINISTRADOR AUTH --}}
<div class="container">
	 <div class="page-header">
      <center>
      <h5>Configuración de la contraseña </h5>
        <h4>
          <font class="text-primary">
            <strong><i class="glyphicon glyphicon-edit"></i>
              {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}
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

      <!-- SI NO SE EJECUTA ALGUNA OPERACION MUESTRA EL MENSAJE -->
    @if (Session::has('messageFallo'))
      <div class="alert alert-errorOperacion alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <i class="glyphicon glyphicon-remove"></i>{{ Session::get('messageFallo') }}
      </div>
    @endif
        

  <div class="panel panel" >
    <div class="panel-body" >

        {{ Form::model($administrador,['method' => 'PUT', 'route' => 'Admin.updatePasswd', 'class' => 'form-horizontal'])}}
                           
            <div class="form-group">
                {{ Form::label('', 'Contraseña actual:', array('class' => 'col-lg-3 control-label')) }}
              <div class="col-lg-4">
                {{ Form::text('passwordAct', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Contraseña actual...', Input::old('passwordAct'))) }}
                                      
                    @if( $errors->has('passwordAct') )          
                      @foreach($errors->get('passwordAct') as $error )   
                        {{ $error }}</br>
                      @endforeach            
                    @endif
              </div>
            </div>

            <div class="form-group">
                {{ Form::label('', 'Nueva Contraseña:', array('class' => 'col-lg-3 control-label')) }}
              <div class="col-lg-4">
                <input name="newpassword" type="password" value="" class="form-control" placeholder="Nueva contraseña..." maxlength="20">
              </div>
            </div>
                          
            <div class="form-group">
                {{ Form::label('', 'Confirmación de contraseña:', array('class' => 'col-lg-3 control-label')) }}
              <div class="col-lg-4">
                <input name="newpassword_confirmation" type="password" value="" class="form-control" placeholder="Repita la contraseña..." maxlength="20">

                    @if( $errors->has('newpassword') )
                      @foreach($errors->get('newpassword') as $error )
                        {{ $error }}</br>
                      @endforeach           
                   @endif
              </div>
            </div>          

            {{ Form::submit('Actualizar contraseña', array('class' => 'btn btn-primary')) }}
                                 
            <button type="reset" class="btn btn-default">
              <span class="glyphicon glyphicon-erase" ></span> Borrar
            </button>

            <a href="{{ URL::previous() }}">
              <button type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-arrow-left" ></span> Cancelar
              </button>
            </a>
      
        {{ Form::close() }}

    </div><!-- end div panel-body -->
  </div><!-- end div panel-panel -->
</div><!-- end div container -->

@stop

