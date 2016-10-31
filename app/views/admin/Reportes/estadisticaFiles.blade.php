@extends('Layouts.BaseReportsPDF')

@section('titulo')
Estadísticas de la tabla de archivos
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Estadísticas de la tabla de archivos al {{ $dateAct }}.
@endsection

<main>
  <p>Estadísticas de la tabla de archivos en la base de datos del sistema. - [ <strong>{{ $totalFiles }}</strong> ] registros en total.</p>

  
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
        <th>Enviados por coordinadores</th>
        <th>Tamaño total ( Megabytes)</th>
        <th>Tamaño total ( Gigabytes)</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td><center> {{ $totalFilesEnviaCoords }} </center></td>
        <td><center> {{ $totalSizeFilesEnviaCoordsMB }} &nbsp;<strong>[ MB ]</strong></center></td>
        <td><center> {{ $totalSizeFilesEnviaCoordsGB }} &nbsp;<strong>[ GB ]</strong></center></td>
      </tr>
    </tbody>

  </table>
  
  
  <br><br><!--- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->

  
  <table class="tableizer-reports">

    <thead>
      <tr class="tableizer-firstrow">
        <th>Enviados por clientes</th>
        <th>Tamaño total ( Megabytes)</th>
        <th>Tamaño total ( Gigabytes)</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td><center> {{ $totalFilesEnviaClients }} </center></td>
        <td><center> {{ $totalSizeFilesEnviaClientsMB }} &nbsp;<strong>[ MB ]</strong></center></td>
        <td><center> {{ $totalSizeFilesEnviaClientsGB }} &nbsp;<strong>[ GB ]</strong></center></td>
      </tr>
    </tbody>

  </table>
  
  
  <br><br> <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->

  
  <table class="tableizer-reports">

    <thead>
      <tr class="tableizer-firstrow">
        <th>Eliminados por usuarios</th>
        <th>Tamaño total ( Megabytes)</th>
        <th>Tamaño total ( Gigabytes)</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td><center> {{ $totalFilesDeletedForUsers }} </center></td>
        <td><center> {{ $totalSizeFilesDeletedForUsersMB }} &nbsp;<strong>[ MB ]</strong></center></td>
        <td><center> {{ $totalSizeFilesDeletedForUsersGB }} &nbsp;<strong>[ GB ]</strong></center></td>
      </tr>
    </tbody>

  </table>


  <br><br> <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->


  <table class="tableizer-reports">

    <thead>
      <tr class="tableizer-firstrow">
        <th>Eliminados (Enviados por clientes)</th>
        <th>Eliminados (Enviados por coordinadores)</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <center> 
            {{ $totalFilesDeletedEnviaClients }} en total <br>
            {{ $totalSizeFilesDeletedEnviaClientsMB }}<strong>[ MB ]</strong><br>
            {{ $totalSizeFilesDeletedEnviaClientsGB }}<strong>[ GB ]</strong>
        </td>
        <td>
          <center> 
            {{ $totalFilesDeletedEnviaCoords }} en total <br>
            {{ $totalSizeFilesDeletedEnviaCoordsMB }}<strong>[ MB ]</strong><br>
            {{ $totalSizeFilesDeletedEnviaCoordsGB }}<strong>[ GB ]</strong>
        </td>
        
      </tr>
    </tbody>

  </table>


  @else
   <br><div class="alert alert-SinData">No se encontro ningun dato disponible en esta tabla.</div>
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