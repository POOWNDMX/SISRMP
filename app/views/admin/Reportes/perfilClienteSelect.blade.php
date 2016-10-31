@extends('Layouts.BaseReportsPDF')

@section('titulo')
Perfil Cliente
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Detalle del cliente al {{ $dateAct }}.<br>
 Cliente : <font color ="#085263"><strong>{{ $cliente->NombreEmpresa }}</strong></font>
@endsection

<main>
  <p>Información detallada del cliente {{ $cliente->NombreEmpresa }} registrado en el sistema.</p>
  
  <table class="tableizer-perfil">
           
    <thead>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Id</strong></th>
        <th><font color="#0099E6">{{ $cliente->id }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Nombre</strong></th>
        <th><font color="#0099E6">{{ $cliente->NombreEmpresa }}</font></th>
      </tr>

       <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>RFC</strong></th>
        <th><font color="#0099E6">{{ $cliente->RFC }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Representante legal</strong></th>

        @if($cliente->NombreRepLEgal == null and $cliente->ApellidosRepLegal == null)
          <th><font color="#9EA0A1"> PERSONA FISICA</font></th>
          @else
          <th><font color="#0099E6">{{ $cliente->NombreRepLegal.' '.$cliente->ApellidosRepLegal }}</font></th>
        @endif

      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Domicilio Fiscal</strong></th>
        <th><font color="#0099E6">{{ $cliente->DomicilioFiscal }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Domicilio</strong></th>
        @if($cliente->Domicilio == null)
          <th><font color="#9EA0A1">SIN OTRO DOMICILIO</font></th>
          @else
          <th><font color="#0099E6">{{ $cliente->Domicilio }}</font></th>
        @endif
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Régimen Fiscal</strong></th>
        <th><font color="#0099E6">{{ $cliente->RegimenFiscal }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Contacto</strong></th>
        <th><font color="#0099E6">{{ $cliente->NombreContacto.' '.$cliente->ApellidosContacto }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Teléfono</strong></th>
        <th><font color="#0099E6">{{ $cliente->Telefono }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Correo</strong></th>
        <th><font color="#0099E6">{{ $cliente->Correo }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
         <th align="right"><strong>Usuario</strong></th>
        <th><font color="#0099E6">{{ $cliente->username }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Fecha de ingreso al sistema</strong></th>
        <th><font color="#0099E6">{{ $cliente->created_at }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Ultima modificación</strong></th>
        <th><font color="#0099E6">{{ $cliente->last_modification }}</font> 
          <font color="#9EA0A1">por</font> {{ $cliente->UserUpdated }}</th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Observaciones</strong></th>
        @if($cliente->cliente == null)
          <th><font color="#9EA0A1">SIN OBSERVACIONES</font></th>
          @else
          <th><font color="#0099E6">{{ $cliente->Observaciones }}</font></th>
        @endif
      </tr>

    </thead>
            
  </table>

  <br>

  @if($coords->count() == 1)
    <h4>{{ $coords->count() }} Coordinador a cargo de este cliente.</h4>
    @else
    <h4>{{ $coords->count() }} Coordinadores a cargo de este cliente.</h4>
  @endif

    @if($coords->count())

      @foreach($coords as $coord)

        - <font color="#0099E6">{{ $coord->Coordinador_Name() }}.</font><br>

      @endforeach

    @else
        <br><div class="alert-SinData">No hay coordinadores a cargo de este cliente.</div>
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