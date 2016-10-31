@extends('Layouts.BaseAdmin')

@section('titulo')
    Perfil | {{ $coordinador -> Nombre. ' ' .$coordinador -> Apellidos }}
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container"><!-- div container-->
	<div class="page-header"><!-- div page-header 1 -->
     <center>
      <h5>Perfil de usuario coordinador </h5>
        <h4>
          <font class="text-primary">
              {{ $coordinador->Nombre. ' ' .$coordinador->Apellidos }}
            </strong>
          </font>
        </h4>
    </center>
      @if(!empty($imgPerfilCoord))
        <center>
          <a href="{{ route('imagePerfilCoord.view', [$coordinador->id]) }}" title="Ver imagen">{{ HTML::image('imagenPERFILcoord/'.$imgPerfilCoord, "", array('class' => 'img-perfil')) }}</a> 
        </center>
        @else
        <center>
          {{ HTML::image('assets/img/user2.png', "", array('class' => 'img-perfil' )) }}
        <center>
      @endif

      <p align="right">
        <a href="{{ route('detalleCoordinador.download', [$coordinador->id]) }}" title="Exportar a PDF" target="_blank" class="linkShow">
          <i class="glyphicon glyphicon-cloud-download"></i> Exportar a PDF    
        </a>
      </p>

  </div><!--end div page-header 1 -->

  <div class="page-header"><!-- div page-header 2 -->
    <dl class="dl-horizontal">
        <dt>Creado:</dt>
          <dd>
            <font color="#BFBFBF">
              <i>{{ $coordinador->created_at }} - por -</i>
            </font> 
            <font color="#A9BF92">
            <i>{{ $coordinador->AdminCreated }}</i>
            </font>
          </dd>

        <dt>Última modificación:</dt>
          <dd>
            <font color="#BFBFBF">
              <i>{{ $coordinador->last_modification}} - por -</i>
            </font>  
            <font color="#A9BF92">
            <i>{{ $coordinador->UserUpdated }}</i>
            </font>
          </dd>

        <dt>Última sesión:</dt>
          <font color="#BFBFBF"><i><dd>{{ $coordinador->updated_at}}</dd></i></font>
    </dl>

    <div class="panel panel-success" ><!-- div panel-success -->
      <div class="panel-heading"><!-- div panel-heading -->
        <h5>
          <i class='glyphicon glyphicon-list-alt'></i> Detalle Coordinador
          <strong>{{ $coordinador->Nombre. ' ' .$coordinador->Apellidos }}</strong>
        </h5>
      </div><!-- end div panel-heading -->
     
      <div class="panel-body" ><!-- div panel-body -->
        <dl class="dl-horizontal"><!-- dl-horizontal -->

          <fieldset>
            <legend><font size="2" color="#96BCC9" >Datos del coordinador</font></legend>
          
            <dt>Id:</dt>
            <font color="#BFBFBF"><i><dd>{{ $coordinador->id }}</dd></i></font>

            <dt>Nombre:</dt>
            <font color="#BFBFBF"><i><dd>{{ $coordinador->Nombre. ' ' .$coordinador->Apellidos }}</dd></i></font>
  
            <dt>E-mail:</dt>
            <font color="#BFBFBF"><i><dd>{{ $coordinador->Correo }}</dd></i></font>
                                
            <dt>Id de Departamento:</dt>
            <font color="#BFBFBF"><i><dd>{{ $coordinador->Id_Depto }}</dd></i></font>
                     
            <dt>Nombre departamento:</dt>
            <a href="{{ route('Departamento.ver', [$departamento->Id_Depto]) }}">
              <i>
                <dd>
                  <font size="3" color="#029C57">{{ $departamento->Nombre }}</font>
                </dd>
              </i>
            </a>
          </fieldset>
          <br>
          <fieldset>
            <legend><font size="2" color="#96BCC9" >Datos de conexión</font></legend>

              <dt>Usuario - <i class="glyphicon glyphicon-user"></i>:</dt>
              <i class="text-primary"><dd>{{ $coordinador->username }}</dd></i></font>
             
          </fieldset>
          <br>
          <fieldset>
            <legend><font size="2" color="#96BCC9" >Clientes asignados</font></legend>

              @if( $clientes->count() )
                  @foreach($clientes as $cliente)
                    <li><font color="#007FB2">{{ $cliente->Cliente_Name() }}</font></li>
                  @endforeach
                @else
                  <br>
                  <div class="alert alert-SinData">No hay clientes asignados aun... </div>
              @endif

             
          </fieldset>

        </dl><!-- end dl-horizontal -->
      </div><!-- end div panel-body -->
    </div><!-- end div panel-success -->
    
    <a href="{{ URL::previous() }}"  title="Regresar">
      <button type="button" class="btn btn-primaryReturn">
        <span class="glyphicon glyphicon-arrow-left" ></span> Regresar
      </button>
    </a>
  </div><!--end div page-header 2 -->
</div><!--end div container -->


@stop