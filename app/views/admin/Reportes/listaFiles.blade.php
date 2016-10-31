@extends('Layouts.BaseReportsPDF')

@section('titulo')
Lista de archivos
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de archivos al {{ $dateAct }}.
@endsection

<main>
  <p>Lista de archivos alojados en el sistema. - [ {{ $archivos->count() }} ] archivos en total.</p>
  <ul>
    <li>'submitCoord'  -> Emitió Coordinador</li>
    <li>'submitClient' -> Emitió Cliente</li>
  </ul>

          @if($archivos->count()) 
          <table class="tableizer-clientes">
          
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center>Id</center></th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Cliente</th>
                <th>Coordinador</th>
                <th>Emitió</th>
                <th>Fecha</th>
                <th>Modif.</th>
                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($archivos as $archivo)
            <tr>
                
                <td><center><strong>{{ $archivo->Id_File }}</strong></center></td>
                <td>{{ $archivo->clientOriginalName }}</td>
                <td>
                  <strong>Tipo:</strong> <font color="#891010">{{ $archivo->clientOriginalExtension }}</font><br>
                  <strong>Tamaño:</strong> 
                        <font color="#045665">
                          {{ number_format(doubleval($archivo->clientSize/1024),3,'.','')}}
                        </font> MB
                </td>
                <td>{{ $archivo->NombreCliente() }}</td>
                <td>{{ $archivo->NombreCoordinador() }}</td>
                <td>{{ $archivo->userSubmit }}</td>
                <td>{{ $archivo->created_at }}</td>
                <td>{{ $archivo->updated_at }}</td>
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