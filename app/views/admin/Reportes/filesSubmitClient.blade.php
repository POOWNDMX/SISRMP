@extends('Layouts.BaseReportsPDF')

@section('titulo')
Files enviados | {{  $cliente->NombreEmpresa }}
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de archivos enviados al {{ $dateAct }}.<br>
 Cliente : <font color ="#085263"><strong>{{  $cliente->NombreEmpresa }}</strong></font>
  
@endsection

<main>
  <p>
    Lista de archivos alojados en el sistema que fueron enviados por el cliente  
    {{  $cliente->NombreEmpresa }} hacia los coordinadores.<br>      
  </p>
  <p>
    Archivos en total: [{{ $viewSubmitClientFiles->count() }}] -- 
    Peso total de archivos [{{ $totalSizeFileSubmitClientMB }}] <strong>MB.</strong>
                           [{{ $totalSizeFileSubmitClientGB }}] <strong>GB.</strong>
  </p>

    <ul>
      <li>'submitCoord'  -> Emitió Coordinador</li>
      <li>'submitClient' -> Emitió Cliente</li>
    </ul>

   @if($viewSubmitClientFiles->count())
  <table class="tableizer-clientes">
  
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center>Id</center></th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Receptor</th>
                <th>Cliente</th>
                <th>Emite</th>                
                <th>Fecha Registro</th>
                <th>Modificación</th>

                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($viewSubmitClientFiles as $viewSubmitClientFile)
            <tr>
                
                <td><center><strong>{{ $viewSubmitClientFile->Id_File }}</strong></center></td>
                <td>{{ $viewSubmitClientFile->clientOriginalName }}</td>
                <td>
                  <strong>Tipo:</strong> 
                    <font color="#891010">{{ $viewSubmitClientFile->clientOriginalExtension }}</font><br>
                  <strong>Tamaño:</strong>  
                    <font color="#045665">{{ number_format(doubleval($viewSubmitClientFile->clientSize/1024),3,'.','')}}
                    </font> MB 
                </td>
                
                @if($viewSubmitClientFile->userSubmit == 'submitClient')
                  <td>
                    <strong>Id:</strong> {{ $viewSubmitClientFile->Id_Coordinador }}<br>
                    <strong>Nombre:</strong> {{ $viewSubmitClientFile->NombreCoordinador() }}
                  </td>
                  @else                  
                  <td>
                    <strong>Id:</strong> {{ $viewSubmitClientFile->Id_Cliente }}<br>
                    <strong>Nombre:</strong> {{ $viewSubmitClientFile->NombreCliente() }}
                  </td>
                @endif          
                  <td>
                    <strong>Id:</strong> {{ $viewSubmitClientFile->Id_Cliente }}<br>
                    <strong>Nombre:</strong> {{ $viewSubmitClientFile->NombreCliente() }}
                  </td>
                <td>{{ $viewSubmitClientFile->userSubmit }}</td>
                <td>{{ $viewSubmitClientFile->created_at }}</td>
                <td>{{ $viewSubmitClientFile->updated_at }}</td>
            </tr>
            @endforeach
            </tbody>
          </table>

        @else
          <br><div class="alert-SinData">No se encontro ningun dato disponible en la base de datos del sistema.</div>
        @endif <!-- end if $clientes->count() -->

        <br><br><br><br><br>
        <div id="notices">
        <center>
          <div>Reporte emitido por el Sistema <br><font size="1">{{ URL::current() }}</font><br> {{ $dateAct }}.</div>
          <div class="notice">Ramírez Medellín, S.C. Contadores públicos y Abogados</div>
        </center>
        </div>


       <hr>




</main>

@stop