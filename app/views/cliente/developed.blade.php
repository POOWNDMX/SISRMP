@extends('Layouts.BaseCliente')

@section('titulo')
         {{ Auth::userCliente()->get()->NombreEmpresa }} | 
         Acerca de este portal
@endsection

@section('cabecera')

@stop


@section('cuerpo')

    @section('li-FilesOut')
        
    @endsection

    @section('tituloPanel')
         Acerca de
    @endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->
        
        <center><h3><font color="#000"><strong>Acerca de este portal</strong></font></h3></center>
        <hr>
        <br>
            

        <div class="panel panel-default">
            <div class="panel-body">
                   
                <h3>
                    {{ HTML::image('assets/img/logo.png', "", array('class' => 'img-thumbnailLogo')) }}
                    <font color="#00145C"><strong>Ramírez Medellín, S.C.</strong></font>
                </h3>
                <hr>
                <font color="#00B0CB" size="3">
                    <strong>Departamento de Tecnologías de la Información y Comunicación - TIC's</strong>
                </font>

                <br>
                    <br>

                <p><font size="2">Este portal fué desarrolldo por el departamento de Tecnologías de la Información y Comunicación de la firma Ramírez Medellín, S.C.</font></p><br><br>

                <p align="right">
                    <font color="#00B0CB"size="2">administrador@rmp.mx</font><br>
                    <font size="2">Versión <script>document.write(new Date().getFullYear())</script></font>
                </p>
                          
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





