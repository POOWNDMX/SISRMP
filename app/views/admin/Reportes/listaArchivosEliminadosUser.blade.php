@extends('Layouts.BaseReportsPDF')

@section('titulo')
Files | Enviados por Clientes
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de archivos eliminados por algun usuario al {{ $dateAct }}.<br>
  
@endsection

<main>
  <p>
    Lista de archivos que fueron eliminados por algun usuario, pero
    que aún pueden ser recuperados por el administrador. - [{{ $archivos->count() }}] en total
  </p>

    

   @if($archivos->count())
  <table class="tableizer-clientes">
  
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center> Id </center></th>
                <th><center> Nombre </center></th>
                <th><center> Detalle </center></th>
                <th><center> Emisor </center></th>
                <th><center> Receptor </center></th>
                <th><center> Emite </center></th> 
                <th><center> Fecha registro </center></th>

                
              </tr>
            </thead>
            
            <tbody>
            @foreach($archivos as $archivo)
            <tr>
                
                <td><center><strong> {{ $archivo->Id_File }} </strong></center></td>
                <td>
                  <font color="#9B0000">{{ $archivo->clientOriginalName }}</font><br>                  
                   Eliminado por <font color="#B70000">{{ $archivo->userDelete }}</font><br>                   
                   el día  {{ $archivo->updated_at }}
                </td>                
                <td>
                  <strong>Tipo:</strong>
                      <font color="#C65509">
                        {{ $archivo->clientOriginalExtension }} </center><br>
                      </font>
                  <strong>Tamaño:</strong>&nbsp;&nbsp;
                      <font color="#09ADC6"> 
                        {{ number_format(doubleval($archivo->clientSize/1024),3,'.','')}} MB 
                      </font>
                </td>

                @if($archivo->userSubmit == 'submitCoord')                
                  <td>
                      <strong>Coordinador:</strong><br>
                        <span class="label label-info">
                          Id: {{ $archivo->Id_Coordinador}}
                        </span><br> 
                      {{ $archivo->NombreCoordinador() }} 
                  </td>
                  @else
                  <td>
                      <strong>Cliente:</strong><br>
                        <span class="label label-info">
                          Id: {{ $archivo->Id_Cliente}}
                        </span><br>
                          {{ $archivo->NombreCliente() }}
                  </td>
                @endif

                 @if($archivo->userSubmit == 'submitClient')                
                  <td>
                    <strong>Coordinador:</strong><br>
                      <span class="label label-info">
                        Id: {{ $archivo->Id_Coordinador}}
                      </span><br>
                        {{ $archivo->NombreCoordinador() }} 
                  </td>
                  @else
                  <td>
                    <strong>Cliente:</strong><br>
                      <span class="label label-info">
                        Id: {{ $archivo->Id_Cliente}}
                      </span><br>
                        {{ $archivo->NombreCliente() }}
                  </td>
                @endif
                <td>{{ $archivo->userSubmit }}</td>               
                <td>{{ $archivo->created_at }}</td>
               
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