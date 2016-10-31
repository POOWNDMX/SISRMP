@extends('Layouts.BaseAdmin')

@section('titulo')
    Coordinadores | Create
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container"><!-- div container -->
	<div class="page-header"><!-- div page-header 1 -->
        <center>
          <h4><i class='glyphicon glyphicon-inbox'></i></h4>
          <h5> Formulario para registro de Coordinadores</h5>
        </center>
  </div><!-- end div page-header -->

  @if (Session::get('mensaje') )
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <i class="glyphicon glyphicon-ok"></i> {{Session::get('mensaje')}}
    </div>
  @endif
  
  <div class="panel panel-info" ><!-- div panel-info -->
    <div class="panel-heading">Ingresa los datos, todos los campos son obligatorios.</div>
      <div class="panel-body" ><!-- div pane-body -->
                   
        <!-- FORM FOR CREATE COORDINATORS -->
        {{ Form::open( array('url' => 'admin/FrmRegis_Coordi', 'method' => 'POST', 'class' => 'form-horizontal'))}}
                      
            <fieldset>
              <legend><font size="2" color="#96BCC9">Datos del Coordinador</font></legend>
                           
              <div class="form-group"><!-- div form-group 1 -->
                  {{ Form::label('', 'Coordinador:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  {{ Form::text('Nombre', null, array('class' => 'form-control', 'placeholder' => 'Nombre', 'autocomplete'=>'off', Input::old('Nombre'))) }}
                                          
                    @if( $errors->has('Nombre') )          
                      @foreach($errors->get('Nombre') as $error )   
                        {{ $error }}</br>
                      @endforeach
                    @endif
                </div><!-- end div col-lg-4 -->

                <div class="col-lg-5"><!-- div col-lg-5 -->
                  {{ Form::text('Apellidos', null, array('class' => 'form-control', 'placeholder' => 'Apellidos', 'autocomplete'=>'off', Input::old('Apellidos'))) }}
                  
                    @if( $errors->has('Apellidos') )          
                      @foreach($errors->get('Apellidos') as $error )   
                        {{ $error }}</br>
                      @endforeach
                    @endif
                </div><!-- end div col-lg-5 -->
              </div><!-- end div form-group 1 -->

              <div class="form-group has-feedback has-feedback-left"><!-- div form-group 2 -->
                  {{ Form::label('', 'Correo electrónico:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  {{ Form::email('Correo', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Email', Input::old('Correo'))) }}
                  <i class="form-control-feedback glyphicon glyphicon-envelope"></i>
                  
                    @if( $errors->has('Correo') )          
                      @foreach($errors->get('Correo') as $error )   
                        {{ $error }}</br>
                      @endforeach
                    @endif
                </div><!-- end div col-lg-4 -->
              </div><!-- end div form-group 2 -->
              
              <!-- CREAMOS UN SELECT PARA ASIGNARLO A UN DEPARTAMENTO -->           
              <div class="form-group"><!-- div form-group 3 -->
                {{ Form::label('Id_Depto', 'Departamento:', array('class' => 'col-lg-3 control-label')) }}    
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  <select name="Id_Depto" class="form-control">
                    @foreach($departamentos as $departamento)
                      <option value="{{$departamento->Id_Depto}}">{{$departamento->Nombre}}</option>
                    @endforeach 
                  </select>
                           
                    @if( $errors->has('Id_Depto') )
                      <div class="alert alert-danger">
                        @foreach($errors->get('Id_Depto') as $error )   
                          {{ $error }}</br>
                        @endforeach
                      </div>
                    @endif
                </div><!-- end div col-lg-4 -->
              </div><!-- end div  form group 3-->
                           
            </fieldset>

            <fieldset>
              <legend><font size="2" color="#96BCC9">Datos de conexión</font></legend>
                           
              <div class="form-group has-feedback has-feedback-left"><!-- div form group-4 -->
                  {{ Form::label('', 'Nombre de Usuario:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  {{ Form::text('username', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Nombre de Usuario', 'maxlength' => '15', Input::old('username'))) }}
                    <i class="form-control-feedback glyphicon glyphicon-user"></i>
                    <span class="help-block">Mínimo 9 cracteres, máximo 15 caracteres.</span>
                                              
                      @if( $errors->has('username') )          
                        @foreach($errors->get('username') as $error )   
                          {{ $error }}</br>
                        @endforeach
                      @endif
                </div><!-- div col-lg-4 -->
              </div><!-- div col-lg-4 -->

              <div class="form-group has-feedback has-feedback-left"><!-- div form group-5 -->
                  {{ Form::label('', 'Contraseña', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  <input name="password" type="password" value="" class="form-control" placeholder="Contraseña..." maxlength="15">
                    <i class="form-control-feedback glyphicon glyphicon-lock"></i>
                </div><!-- end div col-lg-4 -->        
              </div><!-- end div form group-5 -->

              <div class="form-group has-feedback has-feedback-left"><!-- div form group-6 -->
                  {{ Form::label('', 'Confirmación de contraseña:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  <input name="password_confirmation" type="password" value="" class="form-control" placeholder="Repita la contraseña..." maxlength="15">
                    <i class="form-control-feedback glyphicon glyphicon-lock"></i>
                      <span class="help-block">Mínimo 10 cracteres, máximo 15 caracteres.</span>

                        @if( $errors->has('password') )
                          @foreach($errors->get('password') as $error )
                            {{ $error }}</br>
                          @endforeach
                        @endif
                </div><!-- end div col-lg-4 -->
              </div><!-- end div form group-4 -->
                        
            </fieldset>
                                 
                  {{ Form::submit('Registrar', array('class' => 'btn btn-primary')) }}
                                 
                  <button type="reset" class="btn btn-default">
                    <span class="glyphicon glyphicon-erase" ></span> Borrar
                  </button>

                  <a href="{{ URL::previous() }}">
                    <button type="button" class="btn btn-default">
                      <span class="glyphicon glyphicon-arrow-left" ></span> Cancelar
                    </button>
                  </a>

        {{ Form::close() }}<!-- END FORM CREATE COORDINADORES -->

      </div><!-- end div panel body -->
  </div> <!-- div panel-info -->
</div><!-- div container -->


@stop