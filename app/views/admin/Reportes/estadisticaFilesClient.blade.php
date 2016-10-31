@extends('Layouts.BaseReportsPDF')

@section('titulo')
Estadísticas de archivos | {{ $cliente->NombreEmpresa }}
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Estadísticas de la tabla de archivos al {{ $dateAct }}.<br>
 <strong>Cliente: </strong> {{  $cliente->NombreEmpresa }}
@endsection

<main>
  <p>Estadísticas de la tabla de archivos en la base de datos del sistema del cliente 
  {{  $cliente->NombreEmpresa }}. - [ <strong>{{ $totalFiles }}</strong> ] archivos en total.</p>

  
  @if(!empty($totalFiles))
  <table class="tableizer-reports">

    <thead>
      <tr class="tableizer-firstrow">
        <th>Archivos en total</th>
        <th>Tamaño total ( Megabytes)</th>
        <th>Tamaño total ( Gigabytes)</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td><center> {{ $totalFiles }} </center></td>
        <td><center> {{ $totalSizeFilesMB }} &nbsp;<strong>[ MB ]</strong></center></td>
        <td><center> {{ $totalSizeFilesGB }} &nbsp;<strong>[ GB ]</strong></center></td>
      </tr>
    </tbody>

  </table>
  
  
  <br><br> <!--- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->

  
  <table class="tableizer-reports">

    <thead>
      <tr class="tableizer-firstrow">
        <th>Elementos recibidos</th>
        <th>Tamaño total ( Megabytes)</th>
        <th>Tamaño total ( Gigabytes)</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td><center> {{ $totalFilesReceived }} </center></td>
        <td><center> {{ $totalSizeFilesReceivedMB }} &nbsp;<strong>[ MB ]</strong></center></td>
        <td><center> {{ $totalSizeFilesReceivedGB }} &nbsp;<strong>[ GB ]</strong></center></td>
      </tr>
    </tbody>

  </table>
  
  
  <br><br><!--- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->

  
  <table class="tableizer-reports">

    <thead>
      <tr class="tableizer-firstrow">
        <th>Elementos enviados</th>
        <th>Tamaño total ( Megabytes)</th>
        <th>Tamaño total ( Gigabytes)</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td><center> {{ $totalFilesSubmit}} </center></td>
        <td><center> {{ $totalSizeFilesSubmitMB }} &nbsp;<strong>[ MB ]</strong></center></td>
        <td><center> {{ $totalSizeFilesSubmitGB }} &nbsp;<strong>[ GB ]</strong></center></td>
      </tr>
    </tbody>

  </table>
  
  
  <br><br> <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->

  
  <table class="tableizer-reports">

    <thead>
      <tr class="tableizer-firstrow">
        <th>Eliminados por algun usuario</th>
        <th>Tamaño total ( Megabytes)</th>
        <th>Tamaño total ( Gigabytes)</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td><center> {{ $totalFilesDeleted }} </center></td>
        <td><center> {{ $totalSizeFilesDeletedMB }} &nbsp;<strong>[ MB ]</strong></center></td>
        <td><center> {{ $totalSizeFilesDeletedGB }} &nbsp;<strong>[ GB ]</strong></center></td>
      </tr>
    </tbody>

  </table> 


  @else
   <br><div class="alert alert-SinData">No se encontro ningun dato disponible</div>
  @endif  

  <br><br><br><br><br>
  <div id="notices">
    <center>
      <div>Reporte emitido por el Sistema <br><font size="1">{{ URL::current() }}</font><br> {{ $dateAct }}.</div>
      <div class="notice">Ramírez Medellín, S.C. Contadores públicos y Abogados</div>
    </center>
  </div>



</main>

@stop