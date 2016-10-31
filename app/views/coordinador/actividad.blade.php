@extends('Layouts.BaseCoord')

@section('titulo')
Coordinador | Dashboard
@endsection

@section('cabecera')
@stop


@section('cuerpo')

    @section('li-Actividad')
        class="active"
    @endsection
	
    @section('tituloPanel')
		Dashboardli
	@endsection

<div class="content">
            <div class="container-fluid">
            <a href="{{ route('Logout.coordinador') }}">cerrar sesion</a>

               
            </div>
        </div>



@stop

@section('message')

		<script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();

            $.notify({
                icon: 'ti-wand',
                message: "¡Hola! Bienvenido a tu cuenta de <b>coordinador</b> - Te recomendamos cambiar tu contraseña constantemente."

            },{
                type: 'success',
                timer: 4000
            });

        });
    </script>

@endsection






