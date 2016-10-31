<!DOCTYPE html>

<html lang="en">

<head>

	  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	  <title>@yield('titulo')</title>

    {{HTML::style('assets/css-bootstrap/bootstrap.min.css')}}
    {{HTML::style('assets/css-Login/boots-alter.css')}}

    @section('cabecera')

    @show

</head>

<body>
  <div class="page-header">
    <h4>
      <center>
       {{ HTML::image('assets/img/logo.png', "", array('width' => '25', 'height' => '25')) }} Ramírez Medellín, S.C.
      </center>
    </h4>
  </div>
      
  <nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Desplegar navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand">| Portal </a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
 
    <ul class="nav navbar-nav navbar-right">
    <li><a href="javascript:;" class="forget" data-toggle="modal" data-target=".forget-modal">Aviso de Privacidad</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Iniciar sesión <b class="caret"></b>
        </a>
        
        <ul class="dropdown-menu">
          <li>{{HTML::link('login/Login_Clientes', 'Acceso a Clientes')}}</li>
          <li>{{HTML::link('login/Login_Coordinadores', 'Acceso a Coordinadores')}}</li>
         
         {{-- <li class="divider"></li>
          <li><a href="#">Acción #4</a></li> --}}
        </ul>
      </li>
    </ul>
  </div>
  </nav>

     @yield('cuerpo')

     <footer id="footer">
      <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>Page © - 2016</p>
                <p>Developed by <strong>{{HTML::link('http://rmp.mx/', 'Ramírez Medellín, S.C.', 'target = _blank')}}</strong></p>
            </div>
        </div>
       </div>
     </footer>


     {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js') }}
     {{ HTML::script('assets/js-bootstrap/bootstrap.min.js') }}
     {{ HTML::script('assets/js-bootstrap/jquery.min.js') }}
     {{ html::script('assets/js-bootstrap/bootstrap-modal.js') }}
   

</body>
</html>