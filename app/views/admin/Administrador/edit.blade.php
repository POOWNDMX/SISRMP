@extends('Layouts.BaseAdmin')

@section('titulo')
Edit perfil | {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}
@endsection

@section('cabecera')


@stop


@section('cuerpo')

<div class="container">
	 <div class="page-header">
      <center>
      <h5>Configuración general de la cuenta </h5>
        <h4>
          <font class="text-primary">
            <strong><i class="glyphicon glyphicon-edit"></i>
              {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}
            </strong>
          </font>
        </h4>
    </center>
  </div>

  <!-- IMAGEN DE EPRFIL ADMINISTRADOR EN LINEA -->
  @if(!empty($imagen))
      <center>
        {{ HTML::image('imagenPERFIL/'.$imagen, "", array('width' => '120', 'height' => '120', 'align' => 'center', 'class' => 'img-perfil')) }} 
      </center>
    @else
      <center>
        {{ HTML::image('assets/img/user1.png', "", array('width' => '120', 'height' => '120',  'class' => 'img-perfil' )) }}
      <center>
  @endif
   

  @if (Session::get('mensaje') )
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <i class="glyphicon glyphicon-ok"></i> {{Session::get('mensaje')}}
    </div>
  @endif

  <div class="panel panel" >
    <div class="panel-body" >
                        
        {{ Form::model($administrador,['method' => 'PUT', 'route' => 'Admin.update', 'class' => 'form-horizontal', 'files' => true])}}
                           
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
                {{ Form::text('username', null, array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Nombre de usuario...', 'maxlength' => '20', Input::old('username') )) }}
            
                    @if( $errors->has('username') )
                      @foreach($errors->get('username') as $error )
                        {{ $error }}</br>
                      @endforeach
                    @endif
              </div>
            </div>

            <div class="form-group">
                {{ Form::label('', 'Incluir una nueva imágen de perfil:', array('class' => 'col-lg-3 control-label')) }}
              <div class="col-lg-5">
                <input id="imgperfil" name="imgperfil" type="file" class="file" data-preview-file-type="any" multiple>
                <span class="help-block">Extensiones soportadas: [.jpg, .png, .gif].</span>
                
                <a href="{{ route('userAdminImage.delete') }}">
                  <font color="#BF0606" size="2"> 
                    <i class="glyphicon glyphicon-trash"></i> Quitar imágen del perfil
                  </font>
                </a> 

              </div>
            </div>

                              
            {{ Form::submit('Guardar cambios', array('class' => 'btn btn-primary')) }}

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
  </div><!-- end div panel-panel-->
</div><!-- end div container -->

<script>
  $("#imgperfil").fileinput({
      uploadAsync: false,
      minFileCount: 1,
      maxFileCount: 1,
      allowedFileExtensions : ['jpg', 'jpeg', 'png','gif'],
      showUpload: false,
      maxFileSize: 2000,
      removeClass: 'btn btn-defaultImg',
      browseClass: 'btn btn-primaryImg',
      showRemove: true,
  });
</script>

@stop

