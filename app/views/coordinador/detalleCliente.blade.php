@extends('Layouts.BaseCoord')

@section('titulo')
         {{ Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos }} | 
         Detalle cliente [ {{ $cliente->NombreEmpresa }} ]
@endsection

@section('cabecera')

@stop


@section('cuerpo')

    @section('li-FilesOut')
        
    @endsection

    @section('tituloPanel')
         Consultar Cliente
    @endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->
        
        <center><label class="label label-file">{{ $cliente->NombreEmpresa }}</label></center>
        <br>
            <br>
            

        <div class="panel panel-default">
            <div class="panel-body">
                        
            @if(!empty($imagen))
                @if(file_exists($imagenPerfilPath))
                    <center>
                       {{ HTML::image('imagenPERFILcliente/'.$imagen, "", array('class' => 'img-thumbnailImgPerfil')) }}
                    </center>
                @else
                     <center>
                       {{ HTML::image('assets/img/EmptyFileExists.png', "", array( 'class' => 'img-rounded')) }}<br><br>
                       <strong>La imagen de perfil fue eliminada del servidor</strong>
                     </center>
                @endif
                @else
                    <center>
                        {{ HTML::image('assets/img/user.png', "", array('class' => 'img-thumbnailImgPerfil')) }}
                    </center>
            @endif
            
            <br>
                <br>
                    <center>
                        <strong><font size="2">Empresa:</font></strong>
                        <font color="#009CC3">{{ $cliente->NombreEmpresa }}</font><br>

                        <strong><font size="2">RFC:</font></strong>
                        <font color="#009CC3" size="3">{{ $cliente->RFC }}</font><br>

                        <strong><font size="2">Representante legal:</font></strong>
                        
                        @if($cliente->NombreRepLegal == null and $cliente->ApellidosRepLegal == null)
                            <font color="#989898" size="3"> Persona física </font><br>
                            @else
                            <font color="#009CC3" size="3">
                                {{ $cliente->NombreRepLegal.' '.$cliente->ApellidosRepLegal }}
                            </font>
                            <br>
                        @endif

                        <strong><font size="2">Contacto:</font></strong>
                        <font color="#009CC3" size="3">
                            {{ $cliente->NombreContacto.' '.$cliente->ApellidosContacto }}
                        </font>
                        <br>

                        <strong><font size="2">Telefono:</font></strong>
                        <font color="#009CC3" size="3">
                            {{ $cliente->Telefono }}
                        </font>
                        <br>

                        <strong><font size="2">Correo:</font></strong>
                        <font color="#009CC3" size="3">
                            {{ $cliente->Correo }}
                        </font>
                        <br>

                        <strong><font size="2">Domicilio fiscal:</font></strong>
                        <font color="#009CC3" size="3">
                            {{ $cliente->DomicilioFiscal }}
                        </font>
                        <br>

                        <strong><font size="2">Domicilio:</font></strong>
                        @if($cliente->Domicilio == null)
                            <font color="#989898" size="3">
                                Sin otro domicilio
                            </font>
                            <br>
                            @else
                            <font color="#009CC3" size="3">
                                {{ $cliente->Domicilio }}
                            </font>
                            <br>
                        @endif

                        <strong><font size="2">Régimen Fiscal:</font></strong>
                        <font color="#009CC3" size="3">
                            {{ $cliente->RegimenFiscal }}
                        </font>
                        <br>


                    </center> 
            </div>
        </div>

        <center>
          <a href="{{ URL::previous() }}" class="linkShow">
            <i class="glyphicon glyphicon-arrow-left"></i> Ir a la vista anterior 
          </a>
        </center>
  


        
    </div><!-- end div container-fluid -->
</div><!-- end div content (general) -->


@stop





