@extends('Layouts.BaseCoord')

@section('titulo')
         {{ Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos }} | Mis clientes
@endsection

@section('cabecera')

@stop


@section('cuerpo')

    @section('li-myClients')
        class="active"
    @endsection

    @section('tituloPanel')
        Mis clientes 
    @endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->

    <div class="table-responsive">
        <table class="table table table-condensed table-hover">
        
            <thead>
                <tr style="background-color: #3492BE; color: #fff;">
                    <th><center>Id</center></th>
                    <th><center>Empresa</center></th>
                    <th><center>Contacto</center></th>
                    <th><center>Perfil</center></th>
                    <th><center>Enviar informacion</center></th>
                    
                   
                </tr>
            </thead>

            @if($viewMyClients->count())

            <tbody style="background-color: #fff;">
                @foreach($viewMyClients as $viewMyClient)
                    <tr>
                        <th style="color: #BC0707;"><center>{{ $viewMyClient->Cliente_Id() }}</center></th>
                        <td>{{ $viewMyClient->Cliente_Name() }}</td>
                        <td>{{ $viewMyClient->Cliente_Contacto() }}</td>
                        <td>
                        <a href="{{ route('detalleMyCliente.Coordinador', [$viewMyClient->Cliente_Id()]) }}">
                            <button type="button" class="btn btn-block btn-defaultShow btn-xs" title="Ver mi cliente">
                                <span class="glyphicon glyphicon-eye-open"></span> Ver  
                            </button>
                        </a> 
                        </td>
                        <td>
                        <a href="{{ route('viewPanelUpload.coordinador', [$viewMyClient->Cliente_Id()]) }}" 
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





