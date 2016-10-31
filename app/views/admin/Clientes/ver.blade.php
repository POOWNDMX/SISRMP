@extends('Layouts.BaseAdmin')

@section('titulo')
    Perfil | {{ $cliente -> NombreEmpresa }}
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container"><!-- div container -->
  <div class="page-header"><!-- div page-header 1 -->
     <center>
      <h5>Perfil de usuario cliente </h5>
        <h4>
          <font class="text-primary">
              {{ $cliente->NombreEmpresa }}
            </strong>
          </font>
        </h4>
    </center>
       @if(!empty($imgperfil))
      <center>
        <a href="{{ route('imagePerfilClient.view', [$cliente->id]) }}" title="Ver imagen">
        {{ HTML::image('imagenPERFILcliente/'.$imgperfil, "", array('class' => 'img-perfil')) }}
        </a> 
      </center>
    @else
      <center>
        {{ HTML::image('assets/img/user.png', "", array('class' => 'img-perfil' )) }}
      <center>
  @endif
  <p align="right">
    <a href="{{ route('detalleCliente.download', [$cliente->id]) }}" title="Descargar en pdf" target="_blank" class="linkShow">
      <i class="glyphicon glyphicon-cloud-download"></i> Exportar a PDF
    </a>
  </p>
  </div><!--end div page-header 1 -->

  <dl class="dl-horizontal"><!-- dl-horizontal -->

     <dt>Creado:</dt>
          <dd>
            <font color="#BFBFBF">
              <i>{{ $cliente->created_at }} - por -</i>
            </font> 
            <font color="#A9BF92">
            <i>{{ $cliente->AdminCreated }}</i>
            </font>
          </dd>

        <dt>Última modificación:</dt>
          <dd>
            <font color="#BFBFBF">
              <i>{{ $cliente->last_modification }} - por -</i>
            </font>  
            <font color="#A9BF92">
            <i>{{ $cliente->UserUpdated }}</i>
            </font>
          </dd>

        <dt>Última sesión:</dt>
          <font color="#BFBFBF"><i><dd>{{ $cliente->updated_at}}</dd></i></font>

  </dl><!-- end dl-horizontal -->

  <div class="panel panel-perfil" ><!-- div panel-success -->
    <div class="panel-heading"><!-- div panel-heading -->
      <h5><i class='glyphicon glyphicon-list-alt'></i> Detalle Cliente</h5>
    </div><!-- end div panel-heading -->
    
    <div class="panel-body" ><!-- div panel-body -->

      <dl class="dl-horizontal">
   
        <fieldset>
          <legend><font size="2" color="#96BCC9" >Datos de la empresa</font></legend>
      
            <dt>Id de cliente:</dt>
            <font color="#BFBFBF"><i><dd>{{ $cliente->id }}</dd></i></font>

            <dt>Empresa:</dt>
            <font color="#BFBFBF"><i><dd>{{ $cliente->NombreEmpresa }}</dd></i></font>
  
            <dt>RFC:</dt>
            <font color="#BFBFBF"><i><dd>{{ $cliente->RFC }}</dd></i></font>

            <dt>Representante legal:</dt>
            @if($cliente->NombreRepLegal == null)
              <font color="#BFBFBF"><i><dd>- ESTE CLIENTE ES PERSONA FISICA -</dd></i></font>
              @else
              <font color="#BFBFBF">
                <i><dd>{{ $cliente->NombreRepLegal. ' ' .$cliente->ApellidosRepLegal }}</dd></i>
              </font>
            @endif

            <dt>Domicilio fiscal:</dt>
            <font color="#BFBFBF"><i><dd>{{ $cliente->DomicilioFiscal }}</dd></i></font>

            <dt>Domicilio</dt>
            <font color="#BFBFBF"><i><dd>{{ $cliente->Domicilio }}</dd></i></font>

            <dt>Régimen Fiscal:</dt>
            <font color="#BFBFBF"><i><dd>{{ $cliente->RegimenFiscal }}</dd></i></font>
        </fieldset>

        <br>

        <fieldset>
          <legend><font size="2" color="#96BCC9" >Datos del contacto</font></legend>

            <dt>Contacto:</dt>
            <font color="#BFBFBF"><i><dd>{{ $cliente->NombreContacto. ' ' .$cliente->ApellidosContacto }}</dd></i></font>

            <dt>Teléfono:</dt>
            <font color="#BFBFBF"><i><dd>{{ $cliente->Telefono }}</dd></i></font>

            <dt>Correo:</dt>
            <font color="#BFBFBF"><i><dd>{{ $cliente->Correo }}</dd></i></font>
        </fieldset> 

        <br>

        <fieldset>
          <legend><font size="2" color="#96BCC9" >Datos de conexión</font></legend>

            <dt>Usuario - <i class="glyphicon glyphicon-user"></i>:</dt>
            <dd><span class="text-primary">{{ $cliente->username }}</span></dd>

        </fieldset>

        <fieldset>
          <legend><font size="2" color="#96BCC9" >Observaciones</font></legend>

            <dt>Observaciones:</dt>
            <dd><span class="text-primary">{{ $cliente->Observaciones }}</span></dd>

        </fieldset>


        <br>

        <fieldset>
            <legend><font size="2" color="#96BCC9" >Coordinadores en relación</font></legend>

             @if( $coordinadores->count() )
                  @foreach($coordinadores as $coordinador)
                    <li><font color="#007FB2">{{ $coordinador->Coordinador_Name() }}</font></li>
                  @endforeach
                @else
                  <br>
                  <div class="alert alert-SinData">No hay coordinadores en relación aun... </div>
              @endif
             
          </fieldset>

            <a href="{{ URL::previous() }}">
              <button type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-arrow-left" ></span> Atrás
              </button>
            </a>

      </dl>
    </div><!-- end div panel-body -->
  </div><!-- end div panel-perfil -->
</div><!-- end div container -->


@stop