@extends('Layouts.BaseAdmin')

@section('titulo')
  Edit | {{ $coordinador -> Nombre. ' ' .$coordinador -> Apellidos }}
@endsection

@section('cabecera')   

<script>
    function habilitar(value)
    {
      if(value==false)
      {
        // habilitamos
        document.getElementById("Nuevo_Id_Depto").disabled=false;
      }else if(value==true){
        // deshabilitamos
        document.getElementById("Nuevo_Id_Depto").disabled=true;
      }
    }
  </script>

@stop


@section('cuerpo')

<div class="container"><!-- div container -->
	<div class="page-header"><!-- div page-header -->
    <h4>
      <span class="glyphicon glyphicon-edit" ></span> 
        Editar el Coordinador | 
          <small class="text-primary">
            <i>{{ $coordinador -> Nombre. ' ' .$coordinador -> Apellidos }}</i>
          </small> 
    </h4>
  
    <p align="right">
      <font size="2" color="#BFBFBF"><i> Creado: </i></font>
      <font size="3"><span class="label label-info">{{ $coordinador->created_at }}</span></font>
        <br>
      <font size="2" color="#BFBFBF"><i>Ultima modificación: </i></font>
      <font size="3" ><span class="label label-info">{{ $coordinador->updated_at }}</span> 
      </font>
    </p>
  </div>
                             <!--   FORM FOR DELETE COORDINADOR   -->

  {{ Form::open(['method' => 'DELETE', 'route' => ['Coordinador.delete', $coordinador ->id]])}}
        
      <span class="help-block">Se eliminará por completo el registro en la Base de Datos.</span>
        <button type="submit" class="btn btn-danger col-md-3" onclick="return confirm('¿Seguro de eliminar el registro? Si acepta, el registro se eliminará por completo de la Base de Datos.')" title="Eliminar registro">
        Eliminar el registro 
        </button> 
          
        
  {{ Form::close() }}        <!--  END FORM FOR DELETE COORDINADOR   -->
                            
    <br>
      <br>
        <br>


  <div class="panel panel-warning" ><!-- div panel-warning -->
    <div class="panel-heading"><!-- panel-heading -->
      <i class="glyphicon glyphicon-warning-sign"></i> 
        Actualizar información del Coordinador
          <strong class="text-success">
            {{ $coordinador->Nombre. ' ' .$coordinador -> Apellidos }}
          </strong>.
    </div>
                         
    <div class="panel-body" ><!-- div panel-body -->

        <!-- FORM FOR EDIT COORDINADORES -->               
        {{ Form::model($coordinador, ['method' => 'PUT', 'route' => ['Coordinador.update', $coordinador -> id], 'class' => 'form-horizontal'])}}
                      
            <fieldset>
              <legend><font size="2" color="#96BCC9">Datos del Coordinador</font></legend>
                           
              <div class="form-group"><!-- div form-group 1-->
                  {{ Form::label('', 'Coordinador:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!--div col-lg-4-->
                  {{ Form::text('Nombre', null, array('class' => 'form-control', 'autocomplete'=>'off', Input::old('Nombre'))) }}
                      
                      @if( $errors->has('Nombre') )  
                        @foreach($errors->get('Nombre') as $error )   
                          {{ $error }}</br>
                        @endforeach
                     @endif

                </div><!-- end div col-lg-4-->
                
                <div class="col-lg-5"><!-- div col-lg-5-->
                  {{ Form::text('Apellidos', null, array('class' => 'form-control', 'autocomplete'=>'off', Input::old('Apellidos'))) }}
                      
                      @if( $errors->has('Apellidos') ) 
                        @foreach($errors->get('Apellidos') as $error )   
                          {{ $error }}</br>
                        @endforeach
                      @endif

                </div><!-- edn div col-lg-5-->
              </div><!-- end div form-group-2-->

              <div class="form-group has-feedback has-feedback-left"><!-- div form-group-2-->
                  {{ Form::label('', 'Correo electrónico:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4-->
                  {{ Form::email('Correo', null, array('class' => 'form-control', 'autocomplete'=>'off', Input::old('Correo'))) }}
                    <i class="form-control-feedback glyphicon glyphicon-envelope"></i>
                      
                      @if( $errors->has('Correo') ) 
                        @foreach($errors->get('Correo') as $error )   
                          {{ $error }}</br>
                        @endforeach
                      @endif

                </div><!-- end div col-lg-4-->
              </div><!-- end div form-group-2-->

                        
              <div class="form-group"><!-- div form-group 4 -->
                {{ Form::label('Id_Depto', 'Departamento:', array('class' => 'col-lg-3 control-label')) }}    
                <div class="col-lg-4"><!-- div col-lg-4 -->
                {{ Form::text('', $departamento->Nombre, array('class' => 'form-control', 'disabled' => 'disabled')) }}
                </div><!-- end div col-lg-4 -->
              </div><!-- end div  form group 4-->

              <!-- PODEMOS CAMBIAR EL DEPARTAMENTO -->           
              <div class="form-group"><!-- div form-group 5 -->
                {{ Form::label('', 'Cambiar el departamento:', array('class' => 'col-lg-3 control-label')) }}    
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  <select name="Nuevo_Id_Depto" class="form-control" id="Nuevo_Id_Depto">
                    @foreach($departamentos as $departamento)
                      <option value="{{$departamento->Id_Depto}}">{{$departamento->Nombre}}</option>
                    @endforeach 
                  </select>
                  <input type="checkbox" id="check" onchange="habilitar(this.checked);" unchecked> 
                   <font color="#0B96D7" size="2">No deseo cambiar el departamento</font>
                    
                </div><!-- end div col-lg-4 -->
              </div><!-- end div  form group 5-->
                        
            </fieldset>

            <fieldset>
              <legend><font size="2" color="#96BCC9">Datos de conexión</font></legend>
                           
              <div class="form-group has-feedback has-feedback-left"><!-- div form-group 6-->
                  {{ Form::label('', 'Nombre de Usuario:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  {{ Form::text('username', null, array('class' => 'form-control', 'autocomplete'=>'off', 'maxlength' => '15', Input::old('username'))) }}
                    <i class="form-control-feedback glyphicon glyphicon-user"></i>
                    <span class="help-block">Mínimo 9 cracteres, máximo 15 caracteres.</span>
              
                      @if( $errors->has('username') )
                        @foreach($errors->get('username') as $error )   
                          {{ $error }}</br>
                        @endforeach
                      @endif
                </div><!--end  div col-lg-4 -->
              </div><!-- end div form-group 6-->                   

            </fieldset>

            <fieldset>
              <legend><font size="2" color="#96BCC9">Datos de creación</font></legend>

              <div class="form-group">
                  {{ Form::label('', 'Creado:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-5">
                  {{ Form::text('created_at', null, array('class' => 'form-control', 'autocomplete'=>'off', 'disabled' => 'disabled')) }}
                </div>
              </div>

              <div class="form-group">
                  {{ Form::label('', 'Modificado:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-5">
                  {{ Form::text('updated_at', null, array('class' => 'form-control', 'autocomplete'=>'off', 'disabled' => 'disabled')) }}
                </div>
              </div>

            </fieldset>
                               
                  {{ Form::submit('Actualizar registro', array('class' => 'btn btn-primary')) }}
                                
                  <a href="{{ URL::previous() }}">
                    <button type="button" class="btn btn-default">
                      <span class="glyphicon glyphicon-arrow-left" ></span> Cancelar
                    </button>
                  </a>

        {{ Form::close() }}<!-- END FORM FOR EDIT COORDINADORES -->

    </div><!--end div panel-body -->
  </div><!-- end div panel-warning -->  
</div><!-- end div container-->

@stop