@extends('Layouts.BaseReportsPDF')

@section('titulo')
Files | {{ $coordinador->Nombre.' '.$coordinador->Apellidos }}
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de archivos al {{ $dateAct }}.<br>
 Coordinador : <font color ="#085263">{{ $coordinador->Nombre.' '.$coordinador->Apellidos }}</font>
@endsection

<main>
  <p>
    Lista de archivos alojados en el sistema del coordinador 
      <strong>{{ $coordinador->Nombre.' '.$coordinador->Apellidos }}</strong>.</p>
      <p>Archivos en total: [ {{ $viewMyFiles->count() }} ]. -- Peso total de archivos: 
            [{{ $totalSizeFileMB }}] <strong>Mb</strong>. 
            [{{ $totalSizeFileGB }}] <strong>Gb</strong>. </p>


  @if($viewMyFiles->count())
  <table class="tableizer-clientes">
   
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center>Id</center></th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Cliente receptor</th>
                <th>Coordinador</th>
                <th>Fecha Registro</th>

                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($viewMyFiles as $viewMyFile)
            <tr>
                
                <td><center><strong>{{ $viewMyFile->Id_File }}</strong></center></td>
                <td>{{ $viewMyFile->clientOriginalName }}</td>
                <td>
                  <strong>Tipo:</strong> <font color="#891010">{{ $viewMyFile->clientOriginalExtension }}</font><br>
                  <strong>Tamaño:</strong>  <font color="#045665">{{ number_format(doubleval($viewMyFile->clientSize/1024),3,'.','')}}</font> MB 
                </td>
                <td>
                  <strong>Id:</strong> {{ $viewMyFile->Id_Cliente }}<br>
                  <strong>Nombre:</strong> {{ $viewMyFile->NombreCliente() }}
                </td>
                <td>
                  <strong>Id:</strong> {{ $viewMyFile->Id_Coordinador }}<br>
                  <strong>Nombre:</strong> {{ $viewMyFile->NombreCoordinador() }}
                </td>
                <td>{{ $viewMyFile->created_at }}</td>
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