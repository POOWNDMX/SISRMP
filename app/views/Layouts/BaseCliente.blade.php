<!DOCTYPE html>

<html lang="en">

<head>

	   <!--meta charset="UTF-8"-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>@yield('titulo')</title>

    
    
    {{ HTML::style('assetsC/css-uploadimg/fileinput.min.css') }}<!-- css fileinput -->
    {{ HTML::style('assetsC/css/bootstrap.min.css') }}
    {{ HTML::style('assetsC/css/animate.min.css') }}<!-- Animation library for notifications   -->
    {{ HTML::style('assetsC/css/paper-dashboard.css') }}<!-- Estilo de toda la página -->
    {{ HTML::style('assetsC/css/demo.css') }}
    
    {{HTML::style('assets/css-bootstrap/bootstrap-select.css')}}<!-- Boootstrap select -->
    <!-- FONTS AND ICONS -->
    {{ HTML::style('http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css') }}
    {{ HTML::style('https://fonts.googleapis.com/css?family=Muli:400,300') }}
    {{ HTML::style('assetsC/css/themify-icons.css') }}
   

    <!-- js FILEINPUT  -->
    {{HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js')}}
    {{HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js')}}
    
    {{HTML::script('assetsC/js-uploadimg/fileinput.js')}}
    {{HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}

    @section('cabecera')

	@show

</head>

<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="info"><!-- div sidebar -->

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->
    <div class="sidebar-wrapper"><!-- div sidebar-wrapper -->
            <div class="logo">
                <a href="" class="simple-text">
                    Portal Cliente
                </a>
                <center>
                    <label class="text-primary">{{ Auth::userCliente()->get()->NombreEmpresa }}</label>
                </center>
                <br>
                @if(!empty($imagenPerfil))
                    <center>{{ HTML::image('imagenPERFILcliente/'.$imagenPerfil, "", array('class' => 'thumbnail', 'width' => '60px', 'height' => '62px')) }}</center>
                @else
                    <center>{{ HTML::image('assetsC/img/user.png', "", array('class' => 'thumbnail', 'width' => '50px', 'height' => '52px' )) }}</center>
                @endif
            </div>

            <ul class="nav"><!-- div nav -->
                <!--<li @yield('li-Actividad')>
                    <a href="{{ route('Actividad.coordinador') }}">
                        <i class="ti-panel"></i>
                        <p>Actividad</p>
                    </a>
                </li> -->
                <li @yield('li-FilesIn')>
                    <a href="{{ route('viewFilesIn.cliente') }}">
                        <i class="glyphicon glyphicon-save-file"></i>
                        <p>Elementos recibidos</p>
                    </a>
                </li>
                <li @yield('li-FilesOut')>
                    <a href="{{ route('viewFilesout.cliente') }}">
                        <i class="glyphicon glyphicon-open-file"></i>
                        <p>Elementos enviados</p>
                    </a>
                </li>
                <li @yield('li-myClients')>
                    <a href="{{ route('contactsView.cliente') }}">
                        <i class="ti-view-list-alt"></i>
                        <p>Contactos</p>
                    </a>
                </li>
                <li @yield('li-Statistics')>
                    <a href="{{ route('viewStatistics.cliente') }}">
                        <i class="glyphicon glyphicon-stats"></i>
                        <p>Mis estadísticas</p>
                    </a>
                </li>
                 <li @yield('li-userProfile')>
                    <a href="{{ route('userProfile.cliente') }}">
                        <i class="ti-user"></i>
                        <p>Perfil de usuario</p>
                    </a>
                </li>
                <li @yield('li-NewFile')>
                    <a href="{{ route('Logout.cliente') }}">
                        <i class="glyphicon glyphicon-log-out"></i>
                        <p>Cerrar sesión</p>
                    </a>
                </li>
                
            </ul><!-- end div navr -->
        </div><!-- end div sidebar-wrapper -->
    </div><!-- end div sidebar -->

    <div class="main-panel"><!-- div main-panel -->
        <nav class="navbar navbar-default"><!-- nav navbar navbar-default -->
            <div class="container-fluid"><!-- div container-fluid -->
                <div class="navbar-header"><!-- div navbar-header -->
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" >
                        <font color="#01AFCE">PORTAL
                        <i class="glyphicon glyphicon-chevron-right"></i></font>
                         @yield('tituloPanel')</a>
                </div><!-- end div navbar-header -->

                <div class="collapse navbar-collapse"><!-- div collapse navbar-collapse -->
                    <ul class="nav navbar-nav navbar-right"><!-- ul nav  navbar-nav navbar-right-->

                        <li>
                            <a href="{{ route('userProfile.cliente') }}" title="Autenticado">
                                <font color="#28B592"><i class="ti-user"></i>
                                <p>{{ Auth::userCliente()->get()->NombreEmpresa }}</p>
                                </font>
                            </a>
                        </li>                        
                        <li>
                            <a href="{{ route('changeMyPassword.cliente') }}" title="Configuración de la contraseña">
                                <i class="ti-settings"></i>
                                <p>Ajustes </p>
                            </a>
                        </li>
                        <li>
                             <a href="{{ route('Logout.cliente') }}">
                                <i class="glyphicon glyphicon-log-out"></i>
                                <p>Cerrar sesión</p>
                            </a>
                        </li>
                    </ul><!-- end ul nav navbar-nav navbar-right -->

                </div><!-- end div collapse navbar-collapse -->
            </div><!-- end div container-fluid -->
        </nav><!-- end nav navbar navbar-default  -->


        @yield('cuerpo')


        <footer class="footer">
            <div class="container-fluid"><!-- div container-fluid -->

                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, developed  by 
                    <a href="{{ route('acercaDeveloped.Cliente') }}">Ramírez Medellín, S.C. - TIC's</a>
                </div>
            </div><!-- end div container-fluids -->
        </footer>

    </div><!-- end div main-panel  -->
</div><!-- end div wrapper -->
    
</body>
{{-- with <i class="fa fa-heart heart"></i> --}}
<!--   Core JS Files   -->

   

    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js') }}
    {{ HTML::script('assets/js-bootstrap/bootstrap-select.js') }}<!-- BOOTSTRAP SELECT -->

    {{ HTML::script('assetsC/js/jquery-1.10.2.js') }}<!--   Core JS Files   -->
    {{ HTML::script('assetsC/js/bootstrap.min.js') }}<!--   Core JS Files   -->
    {{ HTML::script('assetsC/js/botstrap-checkbox-radio.js') }}<!--  Checkbox, Radio & Switch Plugins -->
    {{ HTML::script('assetsC/js/chartist.min.js') }} <!--  Charts Plugin -->
    {{ HTML::script('assetsC/js/bootstrap-notify.js') }}<!--  Notifications Plugin    -->
    {{ HTML::script('https://maps.googleapis.com/maps/api/js') }}<!--  Google Maps Plugin    -->
    {{ HTML::script('assetsC/js/paper-dashboard.js') }}<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    {{ HTML::script('assetsC/js/demo.js') }}<!-- Paper Dashboard DEMO methods, don't include it in your project! -->

    

    @yield('message')
    @yield('panel-dropzone')
    

</html>