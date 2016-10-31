@extends('Layouts.BaseReportsPDF')

@section('titulo')
Lista de coordinadores
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de coordinadores al {{ $dateAct }}.
@endsection

<main>
  <p>Lista de coordinadores registrados en el sistema. - [ {{ $coordinadores->count() }} ] registros en total.</p>

  @if($coordinadores->count())
  <table class="tableizer-clientes">
   
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center>Id</center></th>
                <th>Coordinador</th>
                <th>Detalle</th>
                <th>Usuario</th>
                <th>Fecha Registro</th>
                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($coordinadores as $coordinador)
            <tr>
                
                <td><center><strong>{{ $coordinador->id }}</strong></center></td>
                <td>{{ $coordinador->Nombre.' '.$coordinador->Apellidos }}</td>
                <td>
                  <strong>Correo:</strong> {{ $coordinador->Correo }}<br>
                  <strong>Id departamento:</strong> {{ $coordinador->Id_Depto }}<br>
                  <strong>Departamento:</strong> {{ $coordinador->Departamento_name() }}<br>
                </td>
                <td>{{ $coordinador->username }}</td>
                
                <td>{{ $coordinador->created_at }}</td>
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