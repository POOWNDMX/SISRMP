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
  <p>Lista de archivos alojados en el sistema, mostrados por nombre original y nombre encriptado en la carpeta del servidor "public/files/*". - [ {{ $archivos->count() }} ] archivos en total.</p>
 

           @if($archivos->count()) 
          <table class="tableizer-clientes">
         
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center>Id</center></th>
                <th>Nombre original</th>
                <th>Encriptación</th>
                <th>Fecha</th>
                <th>Modif.</th>
                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($archivos as $archivo)
            <tr>
                <td><center><strong>{{ $archivo->Id_File }}</strong></center></td>
                <td>{{ $archivo->clientOriginalName }}</td>
                <td>{{ $archivo->nameEncrypt }}</td>
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