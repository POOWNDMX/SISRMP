@extends('Layouts.BaseAdmin')

@section('titulo')
  Departamentos | Create
@endsection

@section('cabecera')
@stop


@section('cuerpo')

<div class="container"><!-- div container -->
	<div class="page-header"><!-- div page-header 1 -->
      <center>
        <h4><i class='glyphicon glyphicon-inbox'></i></h4>
          <h5> Formulario para registro de Departamentos</h5>
      </center>
  </div><!-- end div page-header 1 -->

      @if (Session::get('mensaje') )
        <div class="alert alert-success alert-dismissable"><!-- div alert-success -->
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="glyphicon glyphicon-ok"></i> {{Session::get('mensaje')}}
        </div><!-- end div alert-success-->
      @endif
  
  <div class="panel panel-info" >
    <div class="panel-heading">Ingresa los datos, todos los campos son obligatorios.</div>
      <div class="panel-body" >
                   
        <!-- FORM FOR CREATE DEPARTAMENTS-->
        {{ Form::open( array('url' => 'admin/FrmRegis_Dpto', 'method' => 'POST', 'class' => 'form-horizontal'))}}
                      
            <fieldset>
              <legend><font size="2" color="#96BCC9">Datos del Departamento</font></legend>
                           
              <div class="form-group"><!-- div group 1 -->
                  {{ Form::label('', 'Departamento:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4">
                  {{ Form::text('Nombre', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Nombre del departamento...', Input::old('Nombre'))) }}
                                      
                      @if( $errors->has('Nombre') )          
                        @foreach($errors->get('Nombre') as $error )   
                          {{ $error }}</br>
                        @endforeach
                      @endif

                </div><!-- end div col-lg-4 -->
              </div><!-- end div form-group 1-->

              <div class="form-group"><!-- div group 2 -->
                  {{ Form::label('', 'Firma:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-4"><!-- div col-lg-4 -->
                  {{ Form::text('Firma', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Nombre de la firma...', Input::old('Firma') )) }}
                                           
                      @if( $errors->has('Firma') )
                        @foreach($errors->get('Firma') as $error )
                          {{ $error }}</br>
                        @endforeach
                      @endif

                </div><!-- end div col-lg-4 -->
              </div><!-- end div form-gorup 2 -->

              <div class="form-group"><!-- div form-goup 3 -->
                  {{ Form::label('', 'Descripción:', array('class' => 'col-lg-3 control-label')) }}
                <div class="col-lg-5"><!-- ediv col-lg-5 -->
                  {{ Form::textarea('Comentarios', null, array('class' => 'form-control', 'autocomplete'=>'off', 'rows' => '4', 'placeholder' => 'Comentarios...', 'maxlength' => '255', Input::old('Comentarios') )) }}
                                           
                      @if( $errors->has('Comentarios') )
                        @foreach($errors->get('Comentarios') as $error )
                          {{ $error }}</br>
                        @endforeach
                      @endif
                      
                </div><!-- end div col-lg-5 -->
              </div><!-- end div form-goup 3 -->

                  
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

        {{ Form::close() }}<!-- END FORM FOR CREATE DEPARTAMENTS-->
        
      </div><!-- end div panel-body -->
  </div><!-- end div panel-info -->
</div><!-- end div container -->



@stop