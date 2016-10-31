@extends('Layouts.BaseReportsPDF')

@section('titulo')
Lista de relaciones
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de relaciones cliente coordinador al {{ $dateAct }}.
@endsection

<main>
  <p>Lista de relaciones cliente coordinador registradas en el sistema. - [ {{ $asignaciones->count() }} ] registros en total.</p>

  @if($asignaciones->count()) 
  <table class="tableizer-clientes">
  
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center>Id</center></th>
                <th>Coordinador</th>
                <th>Cliente</th>
                <th>Fecha Registro</th>
                
                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($asignaciones as $asignacion)
            <tr>
                
                <td><center><strong>{{ $asignacion->Id_FolioCC }}</strong></center></td>
                <td>
                  <strong>Id de coordinador: </strong>{{ $asignacion->Id_Coordinador }}<br>
                  {{ $asignacion->Coordinador_Name() }}<br>
                </td>
                <td>
                  <strong>Id de cliente: </strong>{{ $asignacion->Id_Cliente }}<br>
                  {{ $asignacion->Cliente_Name() }}<br>
                </td>
                <td>{{ $asignacion->created_at }}</td>
                
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