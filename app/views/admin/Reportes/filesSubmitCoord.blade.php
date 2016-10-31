@extends('Layouts.BaseReportsPDF')

@section('titulo')
Files enviados | {{  $coordinador->Nombre.' '.$coordinador->Apellidos}}
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de archivos enviados al {{ $dateAct }}.<br>
 Coordinador : <font color ="#085263"><strong>{{  $coordinador->Nombre.' '.$coordinador->Apellidos}}</strong></font>
  
@endsection

<main>
  <p>
    Lista de archivos alojados en el sistema que fueron enviados por el coordinador  
    {{  $coordinador->Nombre.' '.$coordinador->Apellidos}} hacia los clientes.<br>      
  </p>
  <p>
    Archivos en total: [{{ $viewSubmitCoordFiles->count() }}] -- 
    Peso total de archivos [{{ $totalSizeFileSubmitCoordMB }}] <strong>MB.</strong>
                           [{{ $totalSizeFileSubmitCoordGB }}] <strong>GB.</strong>
  </p>

    <ul>
      <li>'submitCoord'  -> Emitió Coordinador</li>
      <li>'submitClient' -> Emitió Cliente</li>
    </ul>

   @if($viewSubmitCoordFiles->count())
  <table class="tableizer-clientes">
  
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center>Id</center></th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Receptor</th>
                <th>Coordinador</th>
                <th>Emite</th>                
                <th>Fecha Registro</th>
                <th>Modificación</th>

                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($viewSubmitCoordFiles as $viewSubmitCoordFile)
            <tr>
                
                <td><center><strong>{{ $viewSubmitCoordFile->Id_File }}</strong></center></td>
                <td>{{ $viewSubmitCoordFile->clientOriginalName }}</td>
                <td>
                  <strong>Tipo:</strong> 
                    <font color="#891010">{{ $viewSubmitCoordFile->clientOriginalExtension }}</font><br>
                  <strong>Tamaño:</strong>  
                    <font color="#045665">{{ number_format(doubleval($viewSubmitCoordFile->clientSize/1024),3,'.','')}}
                    </font> MB 
                </td>
                
                @if($viewSubmitCoordFile->userSubmit == 'submitCoord')
                  <td>
                    <strong>Id:</strong> {{ $viewSubmitCoordFile->Id_Cliente }}<br>
                    <strong>Nombre:</strong> {{ $viewSubmitCoordFile->NombreCliente() }}
                  </td>
                  @else                  
                  <td>
                    <strong>Id:</strong> {{ $viewSubmitCoordFile->Id_Coordinador }}<br>
                    <strong>Nombre:</strong> {{ $viewSubmitCoordFile->NombreCoordinador() }}
                  </td>
                @endif          
                  <td>
                    <strong>Id:</strong> {{ $viewSubmitCoordFile->Id_Coordinador }}<br>
                    <strong>Nombre:</strong> {{ $viewSubmitCoordFile->NombreCoordinador() }}
                  </td>
                <td>{{ $viewSubmitCoordFile->userSubmit }}</td>
                <td>{{ $viewSubmitCoordFile->created_at }}</td>
                <td>{{ $viewSubmitCoordFile->updated_at }}</td>
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