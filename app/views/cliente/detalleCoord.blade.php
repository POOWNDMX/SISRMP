@extends('Layouts.BaseCliente')

@section('titulo')
         {{ Auth::userCliente()->get()->NombreEmpresa }} | 
         Detalle contacto [ {{ $coordinador->Nombre.' '.$coordinador->Apellidos }} ]
@endsection

@section('cabecera')

@stop


@section('cuerpo')

    @section('li-FilesOut')
        
    @endsection

    @section('tituloPanel')
         Consultar Contacto
    @endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->
        
        <center><label class="label label-file">{{ $coordinador->Nombre.' '.$coordinador->Apellidos }}</label></center>
        <br>
            <br>
            

        <div class="panel panel-defaultDetallePerfil">
            <div class="panel-body">
                   
                <div class="row">
                <div class="col-md-3"></div>
                <div class="col-lg-6 col-md-5"><!-- div col-lg-4 col-md-5 -->
                    <br>
                    <div class="card card-user"><!-- div card card-user -->     
                
                        <div class="image">
                            {{ HTML::image('assetsC/img/background.jpg') }} 
                        </div>
                    
                        <div class="content"><!-- div content (1) -->
                            <div class="author">
                                @if(!empty($imagen))
                                    @if(file_exists($imagenPerfilPath))
                                        <center>
                                            {{ HTML::image('imagenPERFILcoord/'.$imagen, "", array('class' => 'avatar border-gray')) }}
                                        </center>
                                        @else
                                        <center>
                                           {{ HTML::image('assets/img/user.png', "", array('class' => 'avatar border-gray')) }}
                                        </center>
                                    @endif
                                @else
                                    <center>
                                        {{ HTML::image('assets/img/user.png', "", array('class' => 'avatar border-gray')) }}
                                    </center>
                                @endif

                                <h4 class="title">
                                    {{ $coordinador->Nombre.' '.$coordinador->Apellidos }}<br>
                                    <small>{{ $coordinador->Correo }}</small><br>
                                    <small>{{ $departamento->Nombre }}</small><br>
                                    <small><font color="#9BCAD2">{{ $departamento->Firma }}</font></small>
                                </h4>
                            </div>
                        </div><!-- end div content (1) -->
                        <hr>
                        <div class="text-center"></div>
                    </div><!--end div card card-user -->
                </div><!-- end div col-lg-4 col-md-5 -->
                </div><!--  end div row -->            
            </div><!-- end div panel-body -->
        </div><!-- end div panel-defaultDetallePerfil -->

        <center>
          <a href="{{ URL::previous() }}" class="linkShow">
            <i class="glyphicon glyphicon-arrow-left"></i> Ir a la vista anterior 
          </a>
        </center>
  


        
    </div><!-- end div container-fluid -->
</div><!-- end div content (general) -->


@stop





