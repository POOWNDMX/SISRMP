@extends('Layouts.BaseReportsPDF')

@section('titulo')
Lista de clientes
@endsection

@section('cabecera')
@stop


@section('cuerpo')

@section('tituloReport')
 <strong>Reporte:</strong><br> Lista de clientes al {{ $dateAct }}.
@endsection

<main>
  <p>Lista de clientes registrados en el sistema. - [ {{ $clientes->count() }} ] registros en total.</p>

  @if($clientes->count())
  <table class="tableizer-clientes">
   
           
            <thead>
              <tr  class="tableizer-firstrowClientes">
                
                <th><center>Id</center></th>
                <th>Cliente</th>
                <th>RFC / Usuario</th>
                <th>Rep. legal</th>
                <th>Detalle</th>
                <th>Fecha Registro</th>
                
                
              </tr>
            </thead>
            
            <tbody>
            @foreach($clientes as $cliente)
            <tr>
                
                <td><center><strong>{{ $cliente->id }}</strong></center></td>
                <td>{{ $cliente->NombreEmpresa }}</td>
                <td>{{ $cliente->RFC }}</td>
                  @if($cliente->NombreRepLegal == null)
                    <td>
                      <font color="#CCCCCE" size="2"><center><i>PERSONA FISICA</i></center></font>
                    </td>
                     @else
                    <td>{{ $cliente->NombreRepLegal. ' ' .$cliente->ApellidosRepLegal }}</td>
                  @endif
                <td>
                  <strong>Contacto:</strong> {{ $cliente->NombreContacto.' '.$cliente->ApellidosContacto }}<br>
                  <strong>Telefono:</strong> {{ $cliente->Telefono }}<br>
                  <strong>Correo:</strong>   {{ $cliente->Correo }}<br>
                  <strong>DomicilioFiscal:</strong> {{ $cliente->DomicilioFiscal }}<br>
                  
                  <strong>Domicilio:</strong> 
                    @if($cliente->Domicilio == null)
                      <font color="#9F2626">Sin otro domicilio</font><br>
                      @else
                      {{ $cliente->Domicilio }}<br>
                    @endif

                  <strong>Régimen Fiscal:</strong>                  
                    @if($cliente->Observaciones == null)
                      <font color="#9F2626">Sin observaciones</font><br>
                      @else
                      {{ $cliente->RegimenFiscal }}<br>
                    @endif

                </td>
                
                <td>{{ $cliente->created_at }}</td>
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