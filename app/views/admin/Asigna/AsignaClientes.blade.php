@extends('Layouts.BaseAdmin')

@section('titulo')
Asigna | Clientes
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
      <h5> Formulario para asignar clientes</h5>
    </center>
  </div><!-- end div page-header -->

  @if (Session::get('mensaje') )
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;
      </button><i class="glyphicon glyphicon-ok"></i> {{Session::get('mensaje')}}
    </div>
  @endif

  <!-- SI NO SE EJECUTA ALGUNA OPERACION MUESTRA EL MENSAJE -->
  @if (Session::has('messageFallo'))
    <div class="alert alert-errorOperacion alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-remove"></i>{{ Session::get('messageFallo') }}
    </div>
  @endif

  <div class="panel panel-info" ><!-- div panel-info -->
    <div class="panel-heading">Selecciona los datos, todos los campos son obligatorios.</div>
      <div class="panel-body" ><!--div panel-body -->

          
                   
          {{ Form::open( array('url' => 'admin/FrmRegis_Asignacion', 'method' => 'POST', 'class' => 'form-inline'))}}

              <fieldset>
                <legend><font size="2" color="#96BCC9">Datos de Asignacion</font></legend>

                    @if( $errors->has('Id_Coordinador') )          
                      @foreach($errors->get('Id_Coordinador') as $error )   
                        {{ $error }}</br>
                      @endforeach          
                    @endif
                    
                    @if( $errors->has('Id_Cliente') )          
                      @foreach($errors->get('Id_Cliente') as $error )   
                        {{ $error }}</br>
                      @endforeach            
                    @endif
                                          
                    <br>
                      <br>

                    <div class="form-group">
                        {{ Form::label('', 'Coordinador:', array('class' => 'col-md-2 control-label')) }}
                      </div>

                      <div class="form-group">
                        <select  class="selectpicker" data-live-search="true" title="Selecciona un Coordinador ..." name="Id_Coordinador">
                          @foreach($coordinadores as $coordinador)
                            <option value="{{$coordinador->id}}">{{$coordinador->Apellidos.' '.$coordinador->Nombre}}</option>
                          @endforeach   
                        </select>
                      </div>


                    <div class="form-group">
                        {{ Form::label('', 'Cliente:', array('class' => 'col-md-2 control-label')) }}
                      </div>

                      <div class="form-group">
                          <select  class="selectpicker" data-live-search="true" title="Selecciona un Cliente ..." name="Id_Cliente">
                          @foreach($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->NombreEmpresa}}</option>
                          @endforeach 
                        </select>
                      </div>
                                 
                    {{ Form::submit('Registrar', array('class' => 'btn btn-primary')) }}

                    <a href="{{ URL::previous() }}">
                      <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-arrow-left" ></span> Cancelar
                      </button>
                    </a>
                                 
              </fieldset><!-- END FIELDSET DATOS DE ASIGNACION -->

          {{ Form::close() }}<!-- end form for create asignaciones -->

      </div><!-- end div panel-body -->
  </div><!-- end div panel-info -->
</div><!-- end div container -->

@stop