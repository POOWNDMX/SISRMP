@extends('Layouts.BaseAdmin')

@section('titulo')
Users Admin | Store
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container">
	<div class="page-header">
    <h3><span class="glyphicon glyphicon-bookmark"></span> Webmaster's -</h3>

    <!-- IMAGEN PERFIL DE ADMINISTRADOR EN LINEA -->       
    @if(!empty($imagen))
        {{ HTML::image('imagenPERFIL/'.$imagen, "", array('class' => 'img-sessionPerfil')) }} 
      @else
        {{ HTML::image('assets/img/user1.png', "", array('class' => 'img-sessionPerfil' )) }} 
    @endif
                    
    <h6><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Usuario autenticado</h6>
    <h6>
      <font class="text-info">
        <strong>
          <span class="glyphicon glyphicon-user" ></span> 
          {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}
        </strong>
      </font>
    </h6>
      <br>
  </div><!-- end div panel-header  -->

  @if (Session::has('message'))
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <i class="glyphicon glyphicon-ok"></i> 
      {{ Session::get('message') }}
    </div>
  @endif 

  <!-- SI NO SE EJECUTA ALGUNA OPERACION MUESTRA EL MENSAJE -->
  @if (Session::has('messageFallo'))
    <div class="alert alert-errorOperacion alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-remove"></i>{{ Session::get('messageFallo') }}
    </div>
  @endif

  <a href="{{ route('Admin.create') }}">
    <button type="button" class="btn btn-priCPlus">
      <span class="glyphicon glyphicon-plus" ></span> NUEVO ADMIN
    </button>
  </a>

  <div class="panel panel-info" >
    <div class="panel-heading">
      <h5><i class='glyphicon glyphicon-user'></i> Webmaster´s</h5>
    </div>
   
    <div class="panel-body" >

      <div class="table-responsive"> 
        <table class="table table-bordered table-condensed table-hover">

          @if($userAlls->count())
           
            <thead>
              <tr style="background-color: #A4BBA9; color: #000;">
                
                <th><center>Id</center></th>
                <th><center>Imagen</center></th>
                <th><center>Nombre</center></th>
                <th><center>Usuario</center></th>
                <th><center>Creado</center></th>
                <th><center>Acciones</center></th>
                <th><center>Eliminar webmaster</center></th>
                <th><center>Última sesión</center></th>
              </tr>
            </thead>
            <tbody>
              @foreach($userAlls as $userAll)
            <tr>
                
                <td><center><strong>{{ $userAll->id }}</strong></center></td>
                <td>
                @if(!empty($userAll->imgperfil))
                    <center>
                      {{ HTML::image('imagenPERFIL/'.$userAll->imgperfil, "", array('class' => 'img-storePerfil', 'title' => $userAll->imgperfil)) }}
                    </center>
                  @else
                    <center>
                      {{ HTML::image('assets/img/user.png', "", array('class' => 'img-storePerfil', 'title' => 'User webmaster' )) }}
                    </center> 
                @endif
                </td>
                <td>{{ $userAll->first_name.' '.$userAll->last_name }}</td>
                <td>{{ $userAll->username }}</td>
                <td><center>{{ $userAll->created_at }}</center></td>
                <td>
                <a href="{{ route('userAdmin.editPasswd', [$userAll->id]) }}" > 
                  <button type="button" class="btn btn-block btn-successWebmaster btn-xs" title="Modificar contraseña">
                    <span class="glyphicon glyphicon-cog"></span>   
                  </button> 
                </a>
                </td>
                <td>
                {{ Form::open(['method' => 'DELETE', 'route' => ['userAdmin.delete', $userAll -> id]])}}
           
                  <button type="submit" class="btn btn-block btn-dangerWebmaster btn-xs" onclick="return confirm('¿Seguro de eliminar el registro?. Si acepta, el registro se eliminará por completo de la Base de Datos.')" title="Eliminar registro"> 
                   <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar
                  </button>
            
                {{ Form::close() }}
                </td>
                <td><center>{{ $userAll->updated_at }}</center></td>

                
            </tr>
              @endforeach
          
            </tbody>
        </table>
      </div><!-- end div table-responsive -->
    </div><!-- end div panel-body -->

          @else
            <br><div class="alert alert-SinData">No se encontro ningun dato disponible en esta tabla.</div>
          @endif

  </div><!-- end div panel-info -->
</div><!-- ed div container -->

@stop