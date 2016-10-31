@extends('Layouts.BaseReportsPDF')

@section('titulo')
Lista de imagenes Cuenta Coordinador
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de imágenes cuenta Coordinador al {{ $dateAct }}.
@endsection

<main>
  <p>Lista de imágenes de cuenta de coordinador.</p>

  @if($imagenCoords->count()) 
  <table class="tableizer-clientes">
  
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center>Id</center></th>
                <th>Coordinador</th>
                <th>Imágen perfil</th>
                
                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($imagenCoords as $imagenCoord)
            <tr>
                
                <td><center><strong>{{ $imagenCoord->id }}</strong></center></td>
                <td>{{ $imagenCoord->Nombre.' '.$imagenCoord->Apellidos }}</td>
                @if (!empty($imagenCoord->imgperfil))
                  <td>{{ $imagenCoord->imgperfil }}</td>
                  @else
                  <td><center> <font color="#BF0606">Ninguna imágen </font></center></td>
                @endif
                
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