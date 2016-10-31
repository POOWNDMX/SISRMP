@extends('Layouts.BaseAdmin')

@section('titulo')
    Clientes | Create
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container"><!-- div container -->
  <div class="page-header"><!-- div page-header -->
    <center>
      <h4>
        <i class='glyphicon glyphicon-inbox'></i>
      </h4>
      <h5> Formulario para registro de Clientes</h5>
    </center>
  </div><!-- end div page-header -->

    @if (Session::get('mensaje') )
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-ok"></i> 
        {{Session::get('mensaje')}}
      </div>
     @endif
  

  <div class="panel panel-info" ><!-- div panel-info -->
    <div class="panel-heading">Ingresa los datos, todos los campos son obligatorios.</div>
      <div class="panel-body" ><!-- div panel-body -->
         
         <!-- FORM FOR CREATE CLIENTES -->          
        {{ Form::open( array('url' => 'admin/FrmRegis_Client', 'method' => 'POST', 'class' => 'form-horizontal'))}}

                       
            <fieldset>
              <legend><font size="2" color="#96BCC9" >Datos de la empresa</font></legend>
            
                <div class="form-group"><!-- div form-group 1 -->
                    {{ Form::label('', 'Nombre de la empresa:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-5"><!-- div col-lg-5 --> 
                    {{ Form::text('NombreEmpresa', null, array('class' => 'form-control', 'autocomplete'=>'off', Input::old('NombreEmpresa'), 'placeholder' => 'Nombre de la empresa')) }}

                      @if( $errors->has('NombreEmpresa') )          
                        @foreach($errors->get('NombreEmpresa') as $error )   
                          {{ $error }}</br>
                        @endforeach
                      @endif
                  </div><!-- end div col-lg-5 -->
                </div><!-- end div form-group 1 -->

                <div class="form-group"><!-- div form-group 2 -->
                    {{ Form::label('', 'RFC:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-3"><!-- div col-lg-4 -->
                    {{ Form::text('RFC', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'RFC', Input::old('RFC'))) }}

                        @if( $errors->has('RFC') )    
                          @foreach($errors->get('RFC') as $error )   
                            {{ $error }}</br>
                          @endforeach
                        @endif
                  </div><!-- end div col-lg-3 -->
                </div><!-- end div form-group 2 -->

                <div class="form-group"><!-- div form-group 3 -->
                    {{ Form::label('', 'Representante legal:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-4"><!-- div col-lg-4 -->
                    {{ Form::text('NombreRepLegal', null, array('class' => 'form-control', 'placeholder' => 'Nombre', 'autocomplete'=>'off', Input::old('NombreRepLegal'))) }}

                        @if( $errors->has('NombreRepLegal') )          
                          @foreach($errors->get('NombreRepLegal') as $error )   
                            {{ $error }}</br>
                          @endforeach
                        @endif
                  </div><!-- end div col-lg-4 -->
                  
                  <div class="col-lg-5"><!-- div col-lg-5 -->
                    {{ Form::text('ApellidosRepLegal', null, array('class' => 'form-control', 'placeholder' => 'Apellidos', 'autocomplete'=>'off', Input::old('ApellidosRepLegal'))) }}

                        @if( $errors->has('ApellidosRepLegal'))                       
                          @foreach($errors->get('ApellidosRepLegal') as $error )   
                            {{ $error }}</br>
                          @endforeach
                        @endif
                  </div><!-- end div col-lg-5 -->
                </div><!-- end div form-group-3 -->

                <div class="form-group"><!-- div form-group 4 -->
                    {{ Form::label('', 'Domicilio Fiscal:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-7"><!-- div col-lg-7 -->
                    {{ Form::textarea('DomicilioFiscal', null, array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'Domicilio fiscal', Input::old('DomicilioFiscal'))) }}

                        @if( $errors->has('DomicilioFiscal') )          
                          @foreach($errors->get('DomicilioFiscal') as $error )   
                            {{ $error }}</br>
                          @endforeach
                        @endif                             
                  </div><!-- end div col-lg-7 -->
                </div><!-- end div form-group 4 -->

                <!-- NUEVO CAMPO DOMICILIO -->
                <div class="form-group"><!-- div form-group 4 -->
                    {{ Form::label('', 'Domicilio:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-7"><!-- div col-lg-7 -->
                    {{ Form::textarea('Domicilio', null, array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'Domicilio', Input::old('Domicilio'))) }}
                          
                  </div><!-- end div col-lg-7 -->
                </div><!-- end div form-group 4 -->

                <!-- NUEVO CAMPO REGIMEN FISCAL -->
                <div class="form-group"><!-- div form-group 6 -->
                    {{ Form::label('', 'Régimen Fiscal:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-4"><!-- div col-lg-4 -->              
                    {{ Form::text('RegimenFiscal', null, array('class' => 'form-control',  'autocomplete'=>'off', 'placeholder' => 'Regimen Fiscal', Input::old('RegimenFiscal'))) }}

                  </div><!-- end div col-lg-4 -->
                </div><!-- end div forom-group 6 -->

            </fieldset><!-- END DIV FIELDSET DATOS DE LA EMPRESA -->

            <fieldset>
              <legend><font size="2" color="#96BCC9">Datos del contacto</font></legend>
                           
                <div class="form-group"><!-- div form-group 5-->
                    {{ Form::label('', 'Contacto:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-4"><!-- div col-lg-4 -->
                    {{ Form::text('NombreContacto', null, array('class' => 'form-control', 'placeholder' => 'Nombre', 'autocomplete'=>'off', Input::old('NombreContacto'))) }}

                        @if( $errors->has('NombreContacto') )          
                          @foreach($errors->get('NombreContacto') as $error )   
                            {{ $error }}</br>
                          @endforeach
                        @endif
                  </div><!-- end div col-lg-4 -->
                  
                  <div class="col-lg-5"><!-- div col-lg-5 -->
                    {{ Form::text('ApellidosContacto', null, array('class' => 'form-control', 'placeholder' => 'Apellidos', 'autocomplete'=>'off', Input::old('ApellidosContacto'))) }}

                        @if( $errors->has('ApellidosContacto') )          
                          @foreach($errors->get('ApellidosContacto') as $error )   
                            {{ $error }}</br>
                          @endforeach
                        @endif
                  </div><!-- end div col-lg-5 -->
                </div><!-- end div form-group 5 -->

                <div class="form-group has-feedback has-feedback-left"><!-- div form-group 6 -->
                    {{ Form::label('', 'Teléfono:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-4"><!-- div col-lg-4 -->              
                    {{ Form::text('Telefono', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Telefono', Input::old('Telefono'))) }}
                      <i class="form-control-feedback glyphicon glyphicon-earphone"></i>
                 
                        @if( $errors->has('Telefono') )          
                          @foreach($errors->get('Telefono') as $error )   
                            {{ $error }}</br>
                          @endforeach
                        @endif
                  </div><!-- end div col-lg-4 -->
                </div><!-- end div forom-group 6 -->

                <div class="form-group has-feedback has-feedback-left"><!-- div form-group 7 -->
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
                </div><!-- end div  form-grup 7 -->
                           
            </fieldset><!-- END FIELDSET DATOS DEL CONTACTO -->

            <fieldset>
              <legend><font size="2" color="#96BCC9">Datos de conexión</font></legend>
                           
                <div class="form-group has-feedback has-feedback-left"><!-- div form-group 8 -->
                    {{ Form::label('', 'Nombre de Usuario:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-4"><!-- div col-lg-4 -->
                    {{ Form::text('username', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Nombre de usuario', 'maxlength' => '13', Input::old('username'))) }}
                      <i class="form-control-feedback glyphicon glyphicon-user"></i>
                      <span class="help-block">Mínimo 12 cracteres, máximo 13 caracteres.</span>

                        @if( $errors->has('username') )         
                          @foreach($errors->get('username') as $error )   
                            {{ $error }}</br>
                          @endforeach
                        @endif
                  </div><!-- end div col-lg-4 -->
                </div><!-- end div form-group 8 -->

                <div class="form-group has-feedback has-feedback-left"><!-- div form-group 9 -->
                    {{ Form::label('', 'Contraseña:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-4"><!-- div col-lg-4 -->
                    <input name="password" type="password" value="" class="form-control" placeholder="Contraseña..." maxlength="15">
                      <i class="form-control-feedback glyphicon glyphicon-lock"></i>
                                       
                  </div><!-- end div col-lg-4 -->     
                </div><!-- end div form-group 9 -->

                <div class="form-group has-feedback has-feedback-left"><!-- div form-group 10 -->
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
                </div><!-- end div form-group 10 -->
                        
            </fieldset><!-- END FIELDSET DATOS DE CONEXION -->

            <fieldset>
              <legend><font size="2" color="#96BCC9">Datos extra y observaciones</font></legend>

                 <div class="form-group"><!-- div form-group 4 -->
                    {{ Form::label('', 'Obervaciones:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-7"><!-- div col-lg-7 -->
                    {{ Form::textarea('Observaciones', null, array('class' => 'form-control', 'rows' => '10', 'placeholder' => 'Observaciones', Input::old('Observaciones'))) }}

                  </div><!-- end div col-lg-7 -->
                </div><!-- end div form-group 4 -->


            </fieldset><!-- END FIELDSET OBSERVACIONES -->
                                 
                {{ Form::submit('Registrar', array('class' => 'btn btn-primary')) }}

                <button type="reset" class="btn btn-default">
                  <span class="glyphicon glyphicon-erase" ></span> Borrar
                </button>

                <a href="{{ URL::previous() }}">
                  <button type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-arrow-left" ></span> Cancelar
                  </button>
                </a>
        {{ Form::close() }}<!-- END DIV FORM FOR CREATE CLIENTES -->

      </div><!-- end div panel-body -->
  </div><!-- end div panel-info -->
</div><!-- end div container -->

@stop