@extends('Layouts.BaseCoord')

@section('titulo')
         {{ Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos }} | Archivos recibidos
@endsection

@section('cabecera')

@stop


@section('cuerpo')

    @section('li-FilesIn')
        class="active"
    @endsection

	@section('tituloPanel')
		Archivos recibidos
	@endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->

    	<!-- FORM FOR SEARCH COORDINADORES -->
        {{ Form::open(['route' => 'viewFilesIn.coordinador', 'method' => 'GET', 'class' => 'pull-right', 'role' => 'search']) }}

            <center><label align="right">

              <font size="2">
              <button type="button" class="btn btn-warning" onclick="demo.showNotification('top','center')">
                <i class='glyphicon glyphicon-question-sign'></i> Mostrar ayuda
              </button>&nbsp;&nbsp; | &nbsp;&nbsp; 
              
                Página <span class="label label-success">{{ $inFiles->getCurrentPage() }}</span> 
                de <span class="label label-success">{{ $inFiles->getLastPage() }}</span> 
                &nbsp;&nbsp;|&nbsp;&nbsp;
                Elementos encontrados en esta página 
                  <span class="label label-success">{{ $inFiles->count() }} </span>&nbsp;&nbsp;
              </font>
            </label></center><hr>

                         <!-- MENSAJE DE EXITO EN LA OPERACION -->
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;&nbsp;&nbsp;</button>
                    <i class="glyphicon glyphicon-ok"></i>{{ Session::get('message') }}
                </div>
            @endif

            <!-- SI NO SE EJECUTA ALGUNA OPERACION MUESTRA EL MENSAJE -->
            @if (Session::has('messageFallo'))
                <div class="alert alert-errorOperacion alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;&nbsp;&nbsp;</button>
                    <i class="glyphicon glyphicon-remove"></i>{{ Session::get('messageFallo') }}
                </div>
            @endif

           
            <div class="input-group">
              {{ Form::text('buscar', Input::get('buscar'), array('class' => 'form-control', 'autocomplete'=>'off', 'placeholder' => 'Buscar archivo de entrada...', 'aria-describedby' => 'search')) }}

              <span class="input-group-addon" id="search">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              </span>
            </div>
             
        {{ Form::close() }} <!-- END FORM FOR SEARCH COORDINADORES -->

        <div class="table-responsive">
        <table class="table table table-condensed table-hover">
        
            @if($inFiles->count())

            <thead>
                <tr style="background-color: #ffffff; color: #000;">
                    
                    <th><center>Archivo</center></th>
                    <th></th>
                    <th><center>Tamaño</center></th>
                    <th><center>Cliente emisor</center></th>
                    <th><center>Fecha</center></th>
                    <th></th>

                </tr>
            </thead>

            

            <tbody style="background-color: #fff;">
                @foreach($inFiles as $inFile)
                    <tr>
                        <td style="color: #00768B;">
                            <a href="{{ route('detalleArchivo.coordinador', [$inFile->Id_File]) }}" 
                                        title="Ver archivo" style="cursor:pointer; cursor: hand">
                                {{ $inFile->clientOriginalName }}</td>
                            </a>                       
                        </td>
                        <td>
                            <a href="{{ route('detalleArchivo.coordinador', [$inFile->Id_File]) }}" 
                                        title="Ver archivo" style="cursor:pointer; cursor: hand">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </a>
                        </td>
                        <td><center>
                                <label class="label label-primarySize"> 
                                    {{ number_format(doubleval($inFile->clientSize/1024),3,'.','')}} MB 
                                </label>
                            </center>
                        </td>
                        <td><center>{{ $inFile->NombreCliente() }}</center></td>
                        <td><center>{{ $inFile->created_at }}</center></td>
                        <td>
                            <a href="{{ route('FileDeleted.Coordinador', [$inFile->Id_File]) }}" title="Eliminar archivo" style="cursor:pointer; cursor: hand" onclick="return confirm('¿Seguro de eliminar el archivo?')">
                                <font color="#D00000">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </font>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @else
                
                <font color="#B50000" size="3">No se encontro ningun dato disponible.</font>
            @endif
  
        </table>
            <br><br>
        </div><!-- div table responsive -->
            {{ $inFiles->appends(array('buscar' => Input::get('buscar')))->links() }}

    </div><!-- end div container-fluid -->
</div><!-- end div content (general) -->


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




