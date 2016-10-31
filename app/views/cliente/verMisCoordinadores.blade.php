@extends('Layouts.BaseCliente')

@section('titulo')
         {{ Auth::userCliente()->get()->NombreEmpresa }} | Contactos
@endsection

@section('cabecera')

@stop


@section('cuerpo')

    @section('li-myClients')
        class="active"
    @endsection

    @section('tituloPanel')
        Mis contactos
    @endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->

    <div class="table-responsive">
        <table class="table table table-condensed table-hover">
        
            <thead>
                <tr style="background-color: #3492BE; color: #fff;">
                    <th><center>Id</center></th>
                    <th><center>Contacto</center></th>
                    <th><center>Correo</center></th>
                    <th><center>Perfil</center></th>
                    <th><center>Enviar informacion</center></th>
                    
                   
                </tr>
            </thead>

            @if($viewMyCoords->count())

            <tbody style="background-color: #fff;">
                @foreach($viewMyCoords as $viewMyCoord)
                    <tr>
                        <th style="color: #BC0707;"><center>{{ $viewMyCoord->Coordinador_Id() }}</center></th>
                        <td>{{ $viewMyCoord->Coordinador_Name() }}</td>
                        <td>{{ $viewMyCoord->Correo() }}</td>
                        <td>
                        <a href="{{ route('detalleMyCoord.Cliente', [$viewMyCoord->Coordinador_Id()]) }}">
                            <button type="button" class="btn btn-block btn-defaultShow btn-xs" title="Ver mi cliente">
                                <span class="glyphicon glyphicon-eye-open"></span> Ver  
                            </button>
                        </a> 
                        </td>
                        <td>
                        <a href="{{ route('viewPanelUpload.cliente', [$viewMyCoord->Coordinador_Id()]) }}" 
                                title="Cargar files"> 
                            <button type="button" class="btn btn-block btn-warningEdit btn-xs" title="Enviarle archivos">
                                <i class="glyphicon glyphicon-cloud-upload"></i> Cargar archivos  
                            </button> 
                        </a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @else
                <font color="#B50000" size="3">No se encontro ningun dato disponible en esta tabla.</font><br><br>
            @endif
  
        </table>

    </div>

            
   

    </div><!-- end div container-fluid -->
</div><!-- end div content (general) -->





@stop





