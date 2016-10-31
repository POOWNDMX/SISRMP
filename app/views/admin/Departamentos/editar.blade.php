@extends('Layouts.BaseAdmin')

@section('titulo')
Edit | {{ $departamento->Nombre }}
@endsection

@section('cabecera') 
@stop


@section('cuerpo')

<div class="container"><!-- div container-->
	  <div class="page-header"><!-- div page-header 1-->
      <h4>
        <span class="glyphicon glyphicon-edit" ></span> Editar el departamento | 
          <small class="text-primary"><i>{{ $departamento->Nombre }} </i></small>
      </h4>

      <p align="right">
        <font size="2" color="#BFBFBF"><i> Creado: </i></font>
        <font size="3"><span class="label label-info">{{ $departamento->created_at }}</span></font><br>

        <font size="2" color="#BFBFBF"><i>Ultima modificación: </i></font>
        <font size="3" ><span class="label label-info">{{ $departamento->updated_at }}</span></font>

        
      </p>

    </div><!-- end div page-header-->

    <!-- FORM FOR DELETE DEPARTAMENTS-->
    {{ Form::open(['method' => 'DELETE', 'route' => ['Departamento.delete', $departamento -> Id_Depto]])}}
                   
      <span class="help-block">Se eliminará por completo el registro en la Base de Datos.</span>
      <button type="submit" class="btn btn-danger col-md-3" onclick="return confirm('¿Seguro de eliminar el registro? Si acepta, el registro se eliminará por completo de la Base de Datos.')" title="Eliminar registro">Eliminar el registro 
      </button> 
          
    {{ Form::close() }}
    <!--END FORM FOR DELETE DEPARTAMENTS -->
      <br>
        <br>
          <br>
  
    <div class="panel panel-warning" ><!-- div panel-warning-->
      <div class="panel-heading"><!-- div panel-heading-->
        <i class="glyphicon glyphicon-warning-sign"></i> 
          Actualizar información del departamento 
            <strong class="text-success"><i>{{ $departamento->Nombre }}.</i></strong>
      </div><!-- div panel-heading-->

      <div class="panel-body" ><!-- div panel-body-->
                    
        <!-- FORM FOR EDIT DEPARTAMENTS-->
        {{ Form::model($departamento, ['method' => 'PUT', 'route' => ['Departamento.update', $departamento -> Id_Depto], 'class' => 'form-horizontal'])}}
                      
            <fieldset>
              <legend><font size="2" color="#96BCC9">Datos del Departamento</font></legend>
                           
              <div class="form-group"><!-- div form-group 1-->
                  {{ Form::label('', 'Departamento:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4-->
                  {{ Form::text('Nombre', null, array('class' => 'form-control', 'autocomplete'=>'off', Input::old('Nombre'))) }}
                      
                    @if( $errors->has('Nombre') )          
                      @foreach($errors->get('Nombre') as $error )   
                        {{ $error }}</br>
                      @endforeach                                        
                    @endif

                </div><!-- end div col-lg-4-->                      
              </div><!-- end div form-group 1-->

              <div class="form-group"><!-- div form-goup 2-->
                  {{ Form::label('', 'Firma:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4-->
                  {{ Form::text('Firma', null, array('class' => 'form-control', 'autocomplete'=>'off', Input::old('Firma'))) }}
              
                    @if( $errors->has('Firma') )
                      @foreach($errors->get('Firma') as $error )
                        {{ $error }}</br>
                      @endforeach
                    @endif

                </div><!-- end div col-lg-4-->     
              </div><!-- end div form-group 2-->

              <div class="form-group"><!-- div form-group 3-->
                  {{ Form::label('', 'Descrpción:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-5"><!-- div col-lg-5-->
                  {{ Form::textarea('Comentarios', null, array('class' => 'form-control', 'autocomplete'=>'off', 'rows' => '4', 'maxlength' => '255', Input::old('Comentarios'))) }}
                
                    @if( $errors->has('Comentarios') )                                
                      @foreach($errors->get('Comentarios') as $error )
                        {{ $error }}</br>
                      @endforeach                         
                    @endif
                    
                </div><!-- end div col-lg-5-->
              </div><!-- end div form-group-->

              <!-- TIMESTAMPS CREATED_AT UPDATED_AT DISABLED -->
              <div class="form-group">
                  {{ Form::label('', 'Creado:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-5">
                  <input class="form-control" id="disabledInput" value="{{$departamento->created_at}}" type="text" disabled>
                </div>
              </div>

              <div class="form-group">
                  {{ Form::label('', 'Modificado:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-5">
                  <input class="form-control" id="disabledInput" value="{{$departamento->updated_at}}" type="text" disabled>
                </div>
              </div>
                         
              {{ Form::submit('Actualizar registro', array('class' => 'btn btn-primary')) }}
              
              <a href="{{ URL::previous() }}">
                <button type="button" class="btn btn-default">
                  <span class="glyphicon glyphicon-arrow-left" ></span> Cancelar
                </button>
              </a> 
                                
            </fieldset>

        {{ Form::close() }}<!-- END FORM FOR EDIT DEPARTAMENTS-->
        
      </div><!-- end div panel-body-->
    </div><!-- end div panel warning-->
 </div><!-- end div container-->

      

@stop