@extends('Layouts.BaseCoord')

@section('titulo')
         {{ Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos }} | Cambiar password
@endsection

@section('cabecera')
 

@stop


@section('cuerpo')

    

	@section('tituloPanel')
		Configuración de la contraseña
	@endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->


    <!-- Si se guardó correctamente l contraseña mostramos el mensaje -->
    @if (Session::has('messageSuccessPasswd'))
        <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert">&times;&nbsp;&nbsp;</button>
              <i class="glyphicon glyphicon-ok"></i>{{ Session::get('messageSuccessPasswd') }}
        </div>
    @endif

    <!-- Si la contraseña actual no es correcta muestra el mensaje -->
    @if (Session::has('messageWarningPasswd'))
        <div class="alert alert-dangerPasswd alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;&nbsp;&nbsp;</button>
          <h5><i class="glyphicon glyphicon-warning-sign"></i> Información...</h5>
            {{ Session::get('messageWarningPasswd') }}<br>
          <font size="2"><label class="text-primary">Verifica tus datos </label></font> 
        </div>
          <br>
    @endif

      <!-- SI NO SE EJECUTA ALGUNA OPERACION MUESTRA EL MENSAJE -->
    @if (Session::has('messageFallo'))
      <div class="alert alert-errorOperacion alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;&nbsp;&nbsp;</button>
          <i class="glyphicon glyphicon-remove"></i>{{ Session::get('messageFallo') }}
      </div>
    @endif
    
    <div class="panel panel-danger"> 
        <div class="panel-heading">
            <span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp; 
            <span class="glyphicon glyphicon-lock"></span> 
            - Cambiar la contraseña
        </div>
        <div class="panel-body">


            {{ Form::model($coordinador,['method' => 'PUT', 'route' => 'updateMyPassword.coordinador'])}}

            
               

                <div class="row"><!-- div row (1)-->
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><!-- div col-md-4(1) -->
                        <div class="form-group"><!-- div form group (1) -->
                            {{ Form::label('', 'Contraseña actual') }}
                            {{ Form::text('passwordAct', null, array('class' => 'form-control border-input', 'placeholder' => 'Contraseña actual', 'autocomplete' => 'off')) }}

                                @if( $errors->has('passwordAct') )  
                                    @foreach($errors->get('passwordAct') as $error )   
                                        {{ $error }}</br>
                                    @endforeach
                                @endif
                                    
                        </div><!-- end div class form group (1)  -->
                    </div><!-- end div class com-md-4 (1)  -->
                </div><!-- end div class row (1) -->
                           
                <div class="row"><!-- div class row (2) --> 
                    <div class="col-md-4"></div>   
                    <div class="col-md-4"><!-- div col-md-6 (2)-->
                        <div class="form-group"><!-- div form group (2) -->
                            {{ Form::label('', 'Nueva contraseña') }}
                            <input name="newPassword" type="password" value="" class="form-control border-input" placeholder="Nueva contraseña..." maxlength="20">
                                
                        </div><!-- end div class form group (2) -->
                    </div><!-- end div col-md-6 (2) -->
                </div><!-- end div class row (2) -->
                 
                <div class="row"><!-- div class row (3) --> 
                    <div class="col-md-4"></div>             
                    <div class="col-md-4"><!-- div col-md-6 (3) -->
                        <div class="form-group"><!-- div form group (3) -->
                            {{ Form::label('', 'Confirmación de contraseña') }}
                            <input name="newPassword_confirmation" type="password" value="" class="form-control border-input" placeholder="Repita la contraseña..." maxlength="20">
                                    
                                @if( $errors->has('newPassword') )  
                                    @foreach($errors->get('newPassword') as $error )   
                                        {{ $error }}</br>
                                    @endforeach
                                @endif
                                    
                        </div><!-- end div form group (3) -->
                    </div><!-- end div col-md-6 (3) -->
                </div><!-- end div class row (3) -->

                <br>
                <center>{{ Form::submit('Actualizar contraseña', array('class' => 'btn btn-primary')) }}</center>

            {{ Form::close() }}

        </div> <!-- end div panel panel-body -->

        <div class="panel-footer">
            <i class="glyphicon glyphicon-user"></i>
            {{ Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos }} \
            <label class="text-info">{{ $dateFormat }}</label>
        </div>
    </div><!-- end div panel panel-danger -->
    </div><!-- end div container-fluid -->
</div><!-- end div content (general) -->


@stop






