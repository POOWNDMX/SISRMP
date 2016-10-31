@extends('Layouts.BaseReportsPDF')

@section('titulo')
Files recibidos | {{  $coordinador->Nombre.' '.$coordinador->Apellidos}}
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de archivos recibidos al {{ $dateAct }}.<br>
 Coordinador : <font color ="#085263"><strong>{{  $coordinador->Nombre.' '.$coordinador->Apellidos}}</strong></font>
  
@endsection

<main>
  <p>
    Lista de archivos alojados en el sistema que fueron enviados por los clientes hacia el coordinador 
    {{  $coordinador->Nombre.' '.$coordinador->Apellidos}}.<br>      
  </p>
  <p>
    Archivos en total: [{{ $viewReceivedCoordFiles->count() }}] -- 
    Peso total de archivos [{{ $totalSizeFileReceivedCoordMB }}] <strong>MB.</strong>
                           [{{ $totalSizeFileReceivedCoordGB }}] <strong>GB.</strong>
  </p>

    <ul>
      <li>'submitCoord'  -> Emitió Coordinador</li>
      <li>'submitClient' -> Emitió Cliente</li>
    </ul>

   @if($viewReceivedCoordFiles->count())
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
            @foreach($viewReceivedCoordFiles as $viewReceivedCoordFile)
            <tr>
                
                <td><center><strong>{{ $viewReceivedCoordFile->Id_File }}</strong></center></td>
                <td>{{ $viewReceivedCoordFile->clientOriginalName }}</td>
                <td>
                  <strong>Tipo:</strong> 
                    <font color="#891010">{{ $viewReceivedCoordFile->clientOriginalExtension }}</font><br>
                  <strong>Tamaño:</strong>  
                    <font color="#045665">{{ number_format(doubleval($viewReceivedCoordFile->clientSize/1024),3,'.','')}}
                    </font> MB 
                </td>
                
                @if($viewReceivedCoordFile->userSubmit == 'submitClient')
                  <td>
                    <strong>Id:</strong> {{ $viewReceivedCoordFile->Id_Cliente }}<br>
                    <strong>Nombre:</strong> {{ $viewReceivedCoordFile->NombreCliente() }}
                  </td>
                  @else                  
                  <td>
                    <strong>Id:</strong> {{ $viewReceivedCoordFile->Id_Coordinador }}<br>
                    <strong>Nombre:</strong> {{ $viewReceivedCoordFile->NombreCoordinador() }}
                  </td>
                @endif

                 @if($viewReceivedCoordFile->userSubmit == 'submitCoord')
                  <td>
                    <strong>Id:</strong> {{ $viewReceivedCoordFile->Id_Cliente }}<br>
                    <strong>Nombre:</strong> {{ $viewReceivedCoordFile->NombreCliente() }}
                  </td>
                  @else                  
                  <td>
                    <strong>Id:</strong> {{ $viewReceivedCoordFile->Id_Coordinador }}<br>
                    <strong>Nombre:</strong> {{ $viewReceivedCoordFile->NombreCoordinador() }}
                  </td>
                @endif


                <td>{{ $viewReceivedCoordFile->userSubmit }}</td>
                <td>{{ $viewReceivedCoordFile->created_at }}</td>
                <td>{{ $viewReceivedCoordFile->updated_at }}</td>
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