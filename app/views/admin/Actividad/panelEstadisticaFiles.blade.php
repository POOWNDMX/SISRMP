@extends('Layouts.BaseAdmin')

@section('titulo')
Panel de archivos
@endsection

@section('cabecera')
@stop


@section('cuerpo')

<div class="container"><!-- div container-->
  <div class="page-header"><!-- div page-header -->
      <h3>Panel general de archivos -</h3>

          <!-- IMAGEN DE PERFILDEL ADMIN EN LINEA -->
          @if(!empty($imagen))
              {{ HTML::image('imagenPERFIL/'.$imagen, "", array('class' => 'img-sessionPerfil', 'width' => '55px', 'height' => '55px')) }} 
            @else
              {{ HTML::image('assets/img/user1.png', "", array('class' => 'img-sessionPerfil', 'width' => '55px', 'height' => '55px' )) }} 
          @endif
                    
      <h6><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Usuario autenticado</h6>
      <h6><font class="text-info"><strong><span class="glyphicon glyphicon-user" ></span> {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}</strong></font></h6><br>
   </div><!-- end div page-header  -->

    
    @if (Session::has('message'))
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="glyphicon glyphicon-ok"></i> 
        {{ Session::get('message') }}
      </div>
    @endif

    <!-- SI NO SE EJECUTA ALGUNA OPERACION MUESTRA EL MENSAJE -->
    @if (Session::has('messageFallo'))
      <div class="alert alert-errorOperacion alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <i class="glyphicon glyphicon-remove"></i>{{ Session::get('messageFallo') }}
      </div>
    @endif


    <div class="panel panel-info" ><!-- div panel-info-->
      <div class="panel-heading"><!-- div panel-heading-->
        <h5><i class='glyphicon glyphicon-file'></i> ESTADISTICAS DE ARCHIVOS</h5>
      </div><!-- end div panel-heading-->

      <div class="panel-body" >
         
          <div class="row">

            <div class="col-md-3"><!-- COL 1 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-success">

                <div class="panel-heading">
                  <i class="glyphicon glyphicon-file"></i> - Archivos en total
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $totalFiles->count() }} en total
                        </span>
                      </h3>
                      {{ $totalSizeFilesMB }} <strong>Mb</strong><br>
                      {{ $totalSizeFilesGB }} <strong>Gb</strong>
                    </center>
                </div>

                <div class="panel-footer">
                  <center>
                    <a href="{{ route('Files.store') }}" class="linkShow">
                      Ir a lista <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 2 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-success">

                <div class="panel-heading">
                  <i class="glyphicon glyphicon-open-file"></i> - Enviados por cliente
                </div>

                <div class="panel-body">
                  <center>
                      <h3>
                        <span class="label label-default">{{ $filesOutClients->count() }} en total
                        </span>
                      </h3>                      
                      {{ $totalSizeFileOutCLientsMB }} <strong>Mb</strong><br>
                      {{ $totalSizeFileOutCLientsGB }} <strong>Gb</strong><br>
                  </center>
                </div>

                <div class="panel-footer">
                  <center>
                    <a href="{{ route('Files.submitCliente') }}" class="linkShow">
                      Ir a lista <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 3 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-success">

                <div class="panel-heading">
                  <i class="glyphicon glyphicon-open-file"></i> - Enviados por coordinador
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $filesOutCoords->count() }} en total
                        </span>
                      </h3>
                      {{ $totalSizeFileOutCoordsMB }} <strong>Mb</strong><br>
                      {{ $totalSizeFileOutCoordsGB }} <strong>Gb</strong><br>
                    </center>
                </div>

                <div class="panel-footer">
                  <center>
                    <a href="{{ route('Files.submitCoordinador') }}" class="linkShow">
                      Ir a lista <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 4 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-success">

                <div class="panel-heading">
                  <i class="glyphicon glyphicon-trash"></i> - Eliminados por algun usuario
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $filesDeletedForUsers->count() }} en total
                        </span>
                      </h3>
                      {{ $totalSizeFileDeletedForUsersMB }} <strong>Mb</strong><br>
                      {{ $totalSizeFileDeletedForUsersGB }} <strong>Gb</strong><br>
                    </center> 
                </div>
                <div class="panel-footer">
                  <center>
                    <a href="{{ route('Files.deletedForUSer') }}" class="linkShow">
                      Ir a lista <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>              
          </div>
                   
          
          

        
      </div><!-- end div panel-body -->
      <div class="panel-footer">
        Estadísticas de archivos - <label class="text-info">{{ $dateAct }}</label>
      </div>
              
    
    </div><!-- end div panel-info -->

    

</div><!-- end div container -->


@stop


