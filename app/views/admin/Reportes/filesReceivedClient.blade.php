@extends('Layouts.BaseReportsPDF')

@section('titulo')
Files recibidos | {{  $cliente->NombreEmpresa }}
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de archivos recibidos al {{ $dateAct }}.<br>
 Cliente : <font color ="#085263"><strong> {{  $cliente->NombreEmpresa }}</strong></font>
  
@endsection

<main>
  <p>
    Lista de archivos alojados en el sistema que fueron enviados por los coordinadores hacia el cliente 
    {{  $cliente->NombreEmpresa }}.<br>      
  </p>
  <p>
    Archivos en total: [{{ $viewReceivedClientFiles->count() }}] -- 
    Peso total de archivos [{{ $totalSizeFileReceivedClientMB }}] <strong>MB.</strong>
                           [{{ $totalSizeFileReceivedClientGB }}] <strong>GB.</strong>
  </p>

    <ul>
      <li>'submitCoord'  -> Emitió Coordinador</li>
      <li>'submitClient' -> Emitió Cliente</li>
    </ul>

   @if($viewReceivedClientFiles->count())
  <table class="tableizer-clientes">
  
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center>Id</center></th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Emisor</th>
                <th>Receptor</th>
                <th>Emite</th>                
                <th>Fecha Registro</th>
                <th>Modificación</th>

                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($viewReceivedClientFiles as $viewReceivedClientFile)
            <tr>
                
                <td><center><strong>{{ $viewReceivedClientFile->Id_File }}</strong></center></td>
                <td>{{ $viewReceivedClientFile->clientOriginalName }}</td>
                <td>
                  <strong>Tipo:</strong> 
                    <font color="#891010">{{ $viewReceivedClientFile->clientOriginalExtension }}</font><br>
                  <strong>Tamaño:</strong>  
                    <font color="#045665">{{ number_format(doubleval($viewReceivedClientFile->clientSize/1024),3,'.','')}}
                    </font> MB 
                </td>
                
                @if($viewReceivedClientFile->userSubmit == 'submitCoord')
                  <td>
                    <strong>Id:</strong> {{ $viewReceivedClientFile->Id_Coordinador }}<br>
                    <strong>Nombre:</strong> {{ $viewReceivedClientFile->NombreCoordinador() }}
                  </td>
                  @else                  
                  <td>
                    <strong>Id:</strong> {{ $viewReceivedClientFile->Id_Cliente }}<br>
                    <strong>Nombre:</strong> {{ $viewReceivedClientFile->NombreCliente() }}
                  </td>
                @endif

                 @if($viewReceivedClientFile->userSubmit == 'submitCoord')
                  <td>
                    <strong>Id:</strong> {{ $viewReceivedClientFile->Id_Cliente }}<br>
                    <strong>Nombre:</strong> {{ $viewReceivedClientFile->NombreCliente() }}
                  </td>
                  @else                  
                  <td>
                    <strong>Id:</strong> {{ $viewReceivedClientFile->Id_Coordinador }}<br>
                    <strong>Nombre:</strong> {{ $viewReceivedClientFile->NombreCoordinador() }}
                  </td>
                @endif


                <td>{{ $viewReceivedClientFile->userSubmit }}</td>
                <td>{{ $viewReceivedClientFile->created_at }}</td>
                <td>{{ $viewReceivedClientFile->updated_at }}</td>
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