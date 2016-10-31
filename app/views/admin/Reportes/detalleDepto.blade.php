@extends('Layouts.BaseReportsPDF')

@section('titulo')
Detalle departamento {{ $departamento->Nombre }}
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Detalle del departamento al {{ $dateAct }}.<br>
 departamento : <font color ="#085263"><strong>{{ $departamento->Nombre }}</strong></font>
@endsection

<main>
  <p>Información detallada del departamento {{ $departamento->Nombre }} registrado en el sistema.</p>
  
  <table class="tableizer-perfil">
           
    <thead>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Id</strong></th>
        <th><font color="#0099E6">{{ $departamento->Id_Depto }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Nombre</strong></th>
        <th><font color="#0099E6">{{ $departamento->Nombre }}</font></th>
      </tr>

       <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Firma</strong></th>
        <th><font color="#0099E6">{{ $departamento->Firma }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Observaciones</strong></th>
        @if($departamento->Comentarios == null)
          <th><font color="#9EA0A1">No hay Observaciones</font></th>
          @else
          <th><font color="#0099E6">{{ $departamento->Comentarios }}</font></th>
        @endif
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Creado</strong></th>
        <th><font color="#0099E6">{{ $departamento->created_at }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Última modificación</strong></th>
        <th><font color="#0099E6">{{ $departamento->updated_at }}</font></th>
      </tr>     

    </thead>
            
  </table>

  <br>  

  <p class="pclass">Se encontraron ( {{ $departamento->coordinadores->count() }} ) coordinadores registrados en este departamento.</p>
  
  @if($departamento->coordinadores->count())
    <ul class="list-group">
      @foreach($departamento->coordinadores as $coordinador)
        <li class="list-group-item">
          <font color="#0099E6">
            {{ $coordinador->Nombre .' '. $coordinador->Apellidos}} - ( {{ $coordinador->Correo }} )
          </font>
        </li>
      @endforeach
    </ul>
    @else
      <br>
        <div class="alert alert-SinData">No se encontro ningun dato disponible en este departamento.</div>
  @endif

       

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