<!DOCTYPE html>

<html lang="en">

<head>

	   <!--meta charset="UTF-8"-->
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
	  <title>@yield('titulo')</title>

    {{HTML::style('assets/css-bootstrap/bootstrap.min.css')}}
    {{HTML::style('assets/css-uploadimg/fileinput.min.css') }} <!-- CARGA DE IMÁGENES -->
    {{HTML::style('assets/css-bootstrap/bootstrap-select.css')}}
    {{HTML::style('assets/css-Admin/boots-alter.css')}}
    {{HTML::style('assets/font-awesome/css/font-awesome.min.css')}}
    {{HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js')}}
    {{HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js')}}<!---->
    {{HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}<!-- CARGA DE IMÁGENES -->
    {{HTML::script('assets/js-uploadimg/fileinput.js')}} <!-- CARGA DE IMÁGENES -->
    {{--HTML::script('assets/js-uploadimg/fileinput.min.js')--}} <!---->
    {{HTML::script('assets/js-bootstrap/bootstrap-select.js')}}

    @section('cabecera')

	  @show

</head>

<body>

  <nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Desplegar navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{ HTML::image('assets/img/logo.png', "", array('class' => 'logo-sesion')) }}</a>
    </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
   
 
    
 
    <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route('Actividad.store') }}"><i class='glyphicon glyphicon-dashboard'></i> ACTIVIDAD</a></li>
        
      <li class="dropdown">
        <a href="{{ route('Departamento.store') }}">
          <i class='glyphicon glyphicon-object-align-left'></i> DEPARTAMENTOS 
        </a>
        <!--     MENU DEPARTAMENTOS    -->
        {{--
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <b class="caret"></b>
        <ul class="dropdown-menu">
          <li>{{HTML::link('admin/Departamentos/create', 'Crear nuevo departamento')}}</li>
          <li>{{HTML::link('admin/Departamentos/store', 'Lista de departamentos')}}</li>
        </ul>--}}

      </li>
      <li class="dropdown">
        <a href="{{ route('Coordinador.store') }}" >
          <i class='glyphicon glyphicon-user'></i> COORDINADORES
        </a>
        <!--   MENU COORDINADORES   -->
        {{--<ul class="dropdown-menu">
          <li>{{HTML::link('admin/Coordinadores/create', 'Crear nuevo coordinador')}}</li>
          <li>{{HTML::link('admin/Coordinadores/store', 'Lista de coordinadores')}}</li>
        </ul>--}}

      </li>
      <li class="dropdown">
        <a href="{{ route('Cliente.store') }}">
          <i class='glyphicon glyphicon-user'></i> CLIENTES
        </a>
        <!-- MENU CLIENTES -->
        {{--<ul class="dropdown-menu">
          <li>{{HTML::link('admin/Clientes/create', 'Crear nuevo cliente')}}</li>
          <li>{{HTML::link('admin/Asignar/create', 'Asignar clientes')}}</li>
          <li>{{HTML::link('admin/Clientes/store', 'Cartelera de clientes')}}</li>
          <li>{{HTML::link('admin/Asignar/store', 'Lista de clientes asignados')}}</li>
        </ul>--}}
      </li>
       <li class="dropdown">
        <a href="{{ route('Asignar.store') }}">
          <i class="glyphicon glyphicon-random"></i> &nbsp;RELACIONES 
        </a>
       </li>
       <li><a href="{{ route('Reportes.view') }}"><i class="glyphicon glyphicon-print"></i> &nbsp;REPORTES </a></li>
       <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        
            @if(!empty($imagen))
                {{ HTML::image('imagenPERFIL/'.$imagen, "", array('class' => 'img-encabezado', 'width' => '30px', 'height' => '30px')) }}
              @else
                {{ HTML::image('assets/img/user1.png', "", array('class' => 'img-encabezado', 'width' => '30px', 'height' => '30px')) }}
            @endif
            
            {{ Auth::userAdmin()->get()->first_name.' '. Auth::userAdmin()->get()->last_name }} <b class="caret"></b>
          </a>
                    
          <ul class="dropdown-menu dropdown-user">
            <li><a href="{{ route('Admin.ver') }}"><i class="fa fa-user fa-fw"></i> Mi perfil</a></li>
            <li><a href="{{ route('Admin.editPasswd') }}"><i class="fa fa-gear fa-fw"></i> Configuracion de la contraseña</a></li>
            <li><a href="{{ route('Admin.create') }}"><i class="fa fa-plus fa-fw"></i> Nuevo Administrador</a></li>
            <li class="divider"></li>
             <li><a href="{{ route('Admin.logs') }}"><i class="glyphicon glyphicon-wrench"></i> Registro de logs</a></li>             
             <li><a href="{{ route('login.truncate') }}"><i class="glyphicon glyphicon-hdd"></i> Truncate DB</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('Logout.administrador') }}"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a></li>
          </ul>
                    <!-- /.dropdown-user -->
      </li>
    </ul>
  </div>
</nav>



    @yield('cuerpo')



    

     
     {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js') }}
     {{ HTML::script('assets/js-bootstrap/bootstrap.min.js') }}
     {{ HTML::script('assets/js-bootstrap/jquery.min.js') }}
     <!---->
     {{ HTML::script('assets/js-bootstrap/bootstrap-modal.js') }}
     {{ HTML::script('assets/js-bootstrap/bootstrap-select.js') }}
     {{ HTML::script('assets/js/jquery-ui.js') }}
     {{ HTML::script('assets/js/jquery.js') }}
     {{ HTML::script('assets/js/jquery-1.7.1.min.js') }}


   




     


</body>
</html>