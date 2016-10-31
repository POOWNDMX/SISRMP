@extends('Layouts.BaseReportsPDF')

@section('titulo')
Files eliminados | {{ $cliente->NombreEmpresa }}
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de archivos eliminados al {{ $dateAct }}.<br>
 Cliente : <font color ="#085263"><strong>{{ $cliente->NombreEmpresa }}</strong>
  
@endsection

<main>
  <p>
    Lista de archivos eliminados por algun usuario cliente o usuario coordinador dueños de ese archivo, pero que estan en el sistema como inactivos, hasta que puedan volver a ser activos o eliminados totalmente del sistema por el administrador. Mismos archivos le pertenecen al cliente <strong>{{ $cliente->NombreEmpresa }}</strong>.<br>      
  </p>
  <p>
    Archivos en total: [{{ $archivos->count() }}] -- 
    Peso total de archivos [{{ $totalSizeDeletedFilesClientMB }}] <strong>MB.</strong>
                           [{{ $totalSizeDeletedFilesClientGB }}] <strong>GB.</strong>
  </p>

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
                <th>Emisor</th>
                <th>Receptor</th>
                <th>Emite</th>                
                <th>Fecha Registro</th>
                <th>Acción</th>

                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($archivos as $archivo)
            <tr>
                
                <td><center><strong>{{ $archivo->Id_File }}</strong></center></td>
                <td><font color="#BF0000">{{ $archivo->clientOriginalName }}</font></td>
                <td>
                  <strong>Tipo:</strong> 
                    <font color="#891010">{{ $archivo->clientOriginalExtension }}</font><br>
                  <strong>Tamaño:</strong>  
                    <font color="#045665">{{ number_format(doubleval($archivo->clientSize/1024),3,'.','')}}
                    </font> MB 
                </td>
                
                @if($archivo->userSubmit == 'submitClient')
                  <td>
                    <strong>Id:</strong> {{ $archivo->Id_Cliente }}<br>
                    <strong>Nombre:</strong> {{ $archivo->NombreCliente() }}
                  </td>
                  @else                  
                  <td>
                    <strong>Id:</strong> {{ $archivo->Id_Coordinador }}<br>
                    <strong>Nombre:</strong> {{ $archivo->NombreCoordinador() }}
                @endif

                @if($archivo->userSubmit == 'submitClient')
                  <td>
                    <strong>Id:</strong> {{ $archivo->Id_Coordinador }}<br>
                    <strong>Nombre:</strong> {{ $archivo->NombreCoordinador() }}
                  </td>
                  @else                  
                  <td>
                    <strong>Id:</strong> {{ $archivo->Id_Cliente }}<br>
                    <strong>Nombre:</strong> {{ $archivo->NombreCliente() }}
                @endif          
                  
                <td>{{ $archivo->userSubmit }}</td>
                <td>{{ $archivo->created_at }}</td>
                <td>
                   <center><strong>Eliminado por el usuario:</strong></center>
                    <center><font color="#B70000">{{ $archivo->userDelete }}</font></center>
                    <center> {{ $archivo->updated_at }} </center>
                </td>
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