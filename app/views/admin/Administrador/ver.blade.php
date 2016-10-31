@extends('Layouts.BaseAdmin')

@section('titulo')
Perfil Admin | {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}
@endsection

@section('cabecera')


@stop


@section('cuerpo')

<div class="container">
  <div class="page-header">
    <center>
      <h5>Webmaster </h5>
        <h4>
          <font class="text-primary">
            <strong><i class="glyphicon glyphicon-user"></i>
              {{ $userAdmin->first_name.' '.$userAdmin->last_name }}
            </strong>
          </font>
        </h4>
    </center>
      @if (Session::has('message'))
        <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="glyphicon glyphicon-ok"></i>{{ Session::get('message') }}
        </div>
      @endif
       @if (Session::has('messageSuccessPasswd'))
        <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="glyphicon glyphicon-ok"></i>{{ Session::get('messageSuccessPasswd') }}
        </div>
      @endif
       <!-- SI NO SE EJECUTA ALGUNA OPERACION MUESTRA EL MENSAJE -->
      @if (Session::has('messageFallo'))
        <div class="alert alert-errorOperacion alert-dismissable">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="glyphicon glyphicon-remove"></i>{{ Session::get('messageFallo') }}
        </div>
      @endif
      
  </div>

  @if(!empty($imagen))
      <center>
        {{ HTML::image('imagenPERFIL/'.$imagen, "", array('class' => 'img-perfil')) }} 
      </center>
    @else
      <center>
        {{ HTML::image('assets/img/user1.png', "", array('class' => 'img-perfil' )) }}
      <center>
  @endif
   
  <center>
    <div class="panel panel-perfil">
      <div class="panel-heading">TU INFORMACION</div>
      
        <div class="panel-body">
          <p><strong>Id de usuario:</strong> {{ $userAdmin->id }}</p>
        </div>
       
        <ul class="list-group">
          <li class="list-group-item">
            <strong>Nombre:</strong> {{ $userAdmin->first_name.' '.$userAdmin->last_name }}
          </li>
          <li class="list-group-item">
            <strong>Usuario:</strong> {{ $userAdmin->username }}
          </li>
          <li class="list-group-item">
            <strong>Contraseña:</strong> ******
          </li>
          <li class="list-group-item">
            <strong>Usuario creado el:</strong> {{ $userAdmin->created_at }}
          </li>
          <li class="list-group-item">
            <strong>Ultima modificación:</strong> {{ $userAdmin->last_modification }}
          </li>
          <li class="list-group-item">
            <strong>Ultimo inicio de sesión:</strong> {{ $userAdmin->updated_at }}
          </li>
        </ul>
    </div>
  </center>

  <a href="{{ route('Admin.editPasswd') }}">
    <button type="button" class="btn btn-priCPlus">
      <span class="glyphicon glyphicon-edit" ></span> Cambiar contraseña
    </button>
  </a>
   <a href="{{ route('Admin.edit') }}" title="Editar mi perfil"> 
    <button type="button" class="btn btn-priCEdit">
      <span class="glyphicon glyphicon-edit" ></span> Configuración
    </button>
  </a>
  <a href="{{ URL::previous() }}"  title="Regresar">
    <button type="button" class="btn btn-priCReturn">
      <span class="glyphicon glyphicon-arrow-left" ></span> Regresar
    </button>
  </a>

</div>
<br>
@stop

