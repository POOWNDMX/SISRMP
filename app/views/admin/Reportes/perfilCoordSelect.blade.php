@extends('Layouts.BaseReportsPDF')

@section('titulo')
Perfil Coordinador
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Detalle del coordinador al {{ $dateAct }}.<br>
 Coordinador : <font color ="#085263"><strong>{{ $coordinador->Nombre.' '.$coordinador->Apellidos }}</strong></font>
@endsection

<main>
  <p>
    Información detallada del coordinador {{ $coordinador->Nombre.' '.$coordinador->Apellidos }} registrado en el sistema
  </p>
  
  <table class="tableizer-perfil">
           
    <thead>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Id</strong></th>
        <th><font color="#0099E6">{{ $coordinador->id }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Nombre</strong></th>
        <th><font color="#0099E6">{{ $coordinador->Nombre.' '.$coordinador->Apellidos }}</font></th>
      </tr>

       <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Email</strong></th>
        <th><font color="#0099E6">{{ $coordinador->Correo }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Departamento</strong></th>
        <th>Id: <font color="#0099E6">{{ $coordinador->Id_Depto }}</font> - Nombre: <font color="#0099E6">{{ $coordinador->Departamento_Name() }}</font></th>
      </tr>

      <tr class="tableizer-firstrowperfil">
        <th align="right"><strong>Usuario</strong></th>
        <th><font color="#0099E6">{{ $coordinador->username }}</font></th>
      </tr>

    </thead>
            
  </table>

  <br>

  @if($clientes->count() == 1)
    <h4>{{ $clientes->count() }} Cliente en relación.</h4>
    @else
    <h4>{{ $clientes->count() }} Clientes en relación.</h4>
  @endif

    @if($clientes->count())

      @foreach($clientes as $cliente)

        - <font color="#0099E6">{{ $cliente->Cliente_Name() }}.</font><br>

      @endforeach

    @else
        <br><div class="alert-SinData">No hay clientes en relación con este coordinador.</div>
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