@extends('Layouts.BaseCoord')

@section('titulo')
         {{ Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos }} | Estadisticas
@endsection

@section('cabecera')

@stop


@section('cuerpo')

    @section('li-Statistics')
        class="active"
    @endsection

	@section('tituloPanel')
		Estadísticas
	@endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->

    	<div class="panel panel-info"><!-- PANEL INFO -->
            
            <div class="panel-heading">
                <i class="glyphicon glyphicon-stats"></i> ESTADISTICAS DE LA CUENTA -
            </div>
            
            <div class="panel-body">
                <center>
                    <div class="row"><!-- ROW 1 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
                        <div class="col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">Archivos en total</div>
                                <div class="panel-body">
                                    <font size="5" color="#00B1EB"><i class="glyphicon glyphicon-file"></i></font><br> 
                                    {{ $totalFiles }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">Archivos enviados</div>
                                <div class="panel-body">
                                    <font size="5" color="#00B1EB"><i class="glyphicon glyphicon-open-file"></i></font><br> 
                                    {{ $totalFilesOut }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">Archivos recibidos</div>
                                <div class="panel-body">
                                    <font size="5" color="#00B1EB"><i class="glyphicon glyphicon-save-file"></i></font><br> 
                                    {{ $totalFilesIn }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"><!-- ROW 2 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->
                        <div class="col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">Tamaño total de archivos</div>
                                <div class="panel-body">
                                    <font size="5" color="#00698B">
                                        <i class="glyphicon glyphicon-file"></i>
                                        <i class="glyphicon glyphicon-hdd"></i>
                                    </font><br> 
                                        {{ $totalSizeColumnMb }} <strong>Mb</strong><br>
                                        {{ $totalSizeColumnGb }} <strong>Gb</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">Tamaño total de archivos enviados</div>
                                <div class="panel-body">
                                     <font size="5" color="#00698B">
                                        <i class="glyphicon glyphicon-open-file"></i>
                                        <i class="glyphicon glyphicon-hdd"></i>
                                    </font><br>  
                                    {{ $totalSizeFilesOutMb }} <strong>Mb</strong><br>
                                    {{ $totalSizeFilesOutGb }} <strong>Gb</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">Tamaño total de archivos recibidos</div>
                                <div class="panel-body">
                                     <font size="5" color="#00698B">
                                        <i class="glyphicon glyphicon-save-file"></i>
                                        <i class="glyphicon glyphicon-hdd"></i>
                                    </font><br>  
                                    {{ $totalSizeFilesInMb }} <strong>Mb</strong><br>
                                    {{ $totalSizeFilesInGb }} <strong>Gb</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"><!-- ROW 3 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->
                        <div class="col-md-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">Mis clientes asignados</div>
                                <div class="panel-body">
                                    <font size="5">
                                        <font color="#A71C00"><i class="glyphicon glyphicon-user"></i></font>
                                        <i class="glyphicon glyphicon-random"></i>
                                        <font color="#A71C00"><i class="glyphicon glyphicon-user"></i></font>
                                    </font><br> 
                                    {{ $totalClients }}
                                </div>
                            </div>
                        </div>
                        
                    </div>
                       
                </center>
            </div>
            <div class="panel-footer">
                <i class="glyphicon glyphicon-user"></i>
                {{ Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos }} \
                <label class="text-info">{{ $dateFormat }}</label>
            </div>
        </div><!-- END PANEL INFO -->

    </div><!-- end div container-fluid -->
</div><!-- end div content (general) -->


@stop





