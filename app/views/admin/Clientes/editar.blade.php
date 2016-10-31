@extends('Layouts.BaseAdmin')

@section('titulo')
Edit | {{ $cliente -> NombreEmpresa }}
@endsection

@section('cabecera')  

@stop


@section('cuerpo')

<div class="container"><!-- div container -->
	<div class="page-header"><!-- div page header -->
    <h4>
      <span class="glyphicon glyphicon-edit" ></span> Editar el Cliente | 
        <small class="text-primary">
          <i>{{ $cliente -> NombreEmpresa }}</i>
        </small> 
    </h4>

    <p align="right">
      <font size="2" color="#BFBFBF"><i> Creado: </i></font>
      <font size="3"><span class="label label-info">{{ $cliente->created_at }}</span></font><br>

      <font size="2" color="#BFBFBF"><i>Ultima modificación: </i></font>
      <font size="3" ><span class="label label-info">{{ $cliente->updated_at }}</span> 
      </font>
    </p>

    </div>

      <!-- FORM FOR DELETE CLIENTES -->
      {{ Form::open(['method' => 'DELETE', 'route' => ['Cliente.delete', $cliente -> id]])}}
                   
          <span class="help-block">Se eliminará por completo el registro en la Base de Datos.</span>
          <button type="submit" class="btn btn-danger col-md-3" onclick="return confirm('¿Seguro de eliminar el registro? Si acepta, el registro se eliminará por completo de la Base de Datos.')" title="Eliminar registro">
            Eliminar el registro 
          </button>
            
      {{ Form::close() }} <!-- EDN FORM FOE DELETE CLIENTES -->

      <br>
        <br>
          <br>


    <div class="panel panel-warning" ><!-- div panel-warning -->
      <div class="panel-heading"><i class="glyphicon glyphicon-warning-sign"></i> Actualizar información del Cliente
        <strong class="text-success">
          {{ $cliente->NombreEmpresa }}
        </strong>.
      </div>
      
      <div class="panel-body" >

          {{ Form::model($cliente, ['method' => 'PUT', 'route' => ['Cliente.update', $cliente -> id], 'class' => 'form-horizontal'])}}
                  
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

                        @if( $errors->has('NombreRepLEgal') )          
                          @foreach($errors->get('NombreRepLEgal') as $error )   
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
                    {{ Form::text('RegimenFiscal', null, array('class' => 'form-control', 'placeholder' => 'Regimen Fiscal', Input::old('RegimenFiscal'))) }}

                  </div><!-- end div col-lg-4 -->
                </div><!-- end div forom-group 6 -->

              </fieldset><!-- end fieldset datos de la empresa -->

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
                           
              </fieldset><!-- end fieldset datos del contacto -->

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
                        
              </fieldset><!-- end fieldset datos de conexion-->

               <fieldset>
              <legend><font size="2" color="#96BCC9">Datos extra y observaciones</font></legend>

                 <div class="form-group"><!-- div form-group 4 -->
                    {{ Form::label('', 'Obervaciones:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-7"><!-- div col-lg-7 -->
                    {{ Form::textarea('Observaciones', null, array('class' => 'form-control', 'rows' => '10', 'placeholder' => 'Observaciones', Input::old('Observaciones'))) }}

                  </div><!-- end div col-lg-7 -->
                </div><!-- end div form-group 4 -->


            </fieldset><!-- END FIELDSET OBSERVACIONES -->

              <fieldset>
                <legend><font size="2" color="#96BCC9">Datos de creación</font></legend>

                <div class="form-group">
                    {{ Form::label('', 'Creado:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-5">
                    <input class="form-control" id="disabledInput" value="{{$cliente->created_at}}"type="text" disabled>
                  </div>
                </div>

                <div class="form-group">
                    {{ Form::label('', 'Modificado:', array('class' => 'col-lg-3 control-label')) }}
                  <div class="col-lg-5">
                    <input class="form-control" id="disabledInput" value="{{$cliente->updated_at}}"type="text" disabled>
                  </div>
                </div>

              </fieldset><!-- end fieldset datos de creación -->
                                 
              {{ Form::submit('Actualizar registro', array('class' => 'btn btn-primary')) }}
                                
                <a href="{{ URL::previous() }}">
                  <button type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-arrow-left" ></span> Cancelar
                  </button>
                </a>
              
          {{ Form::close() }}
                   
                       

      </div><!-- end div panel-body -->
    </div><!-- end div panel-warning -->
</div><!-- end div container -->

@stop