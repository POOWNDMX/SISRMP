@extends('Layouts.BaseAdmin')

@section('titulo')
Panel de estadisticas de {{ $coordinador->Nombre.' '.$coordinador->Apellidos }}
@endsection

@section('cabecera')
@stop


@section('cuerpo')

<div class="container"><!-- div container-->
  <div class="page-header"><!-- div page-header -->
      <h3>Panel general de archivos - Coordinador</h3>

          <!-- IMAGEN DE PERFILDEL ADMIN EN LINEA -->
          @if(!empty($imagen))
              {{ HTML::image('imagenPERFIL/'.$imagen, "", array('class' => 'img-sessionPerfil', 'width' => '55px', 'height' => '55px')) }} 
            @else
              {{ HTML::image('assets/img/user1.png', "", array('class' => 'img-sessionPerfil', 'width' => '55px', 'height' => '55px' )) }} 
          @endif
                    
      <h6><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Usuario autenticado</h6>
      <h6><font class="text-info"><strong><span class="glyphicon glyphicon-user" ></span> {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}</strong></font></h6><br>

      <center><label class="label label-file"> {{ $coordinador->Nombre.' '.$coordinador->Apellidos }}</label></center>
   </div><!-- end div page-header  -->

      


    <div class="panel panel-primaryStatistics" ><!-- div panel-info-->
      <div class="panel-heading"><!-- div panel-heading-->
        <h5><i class='glyphicon glyphicon-file'></i> Estadísticas de archivos del coordinador <strong>{{ $coordinador->Nombre.' '.$coordinador->Apellidos }}</strong></h5>
      </div><!-- end div panel-heading-->

      <div class="panel-body" >
         
          <div class="row">

            <div class="col-md-3"><!-- COL 1 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-default">

                <div class="panel-heading">
                  <i class="glyphicon glyphicon-file"></i> - Archivos en total
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $totalFiles }} en total
                        </span>
                      </h3>
                       {{ $totalSizeFilesMB }}<strong>Mb</strong><br>
                       {{ $totalSizeFilesGB }}<strong>Gb</strong>
                    </center>
                </div>

                <div class="panel-footer">
                  <center>
                    <a href="{{ route('Coordinador.filesMine', [$coordinador->id]) }}" class="linkShow">
                      Ir a lista <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 2 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-default">

                <div class="panel-heading">
                  <i class="glyphicon glyphicon-open-file"></i> - Elementos recibidos
                </div>

                <div class="panel-body">
                  <center>
                      <h3>
                        <span class="label label-default">{{ $totalFilesReceived }} en total
                        </span>
                      </h3>                      
                       {{ $totalSizeFilesReceivedMB }}<strong>Mb</strong><br>
                       {{ $totalSizeFilesReceivedGB }}<strong>Gb</strong><br>
                  </center>
                </div>

                <div class="panel-footer">
                  <center>
                    <a href="{{ route('Coordinador.filesReceived', [$coordinador->id]) }}" class="linkShow">
                      Ir a lista <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 3 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-default">

                <div class="panel-heading">
                  <i class="glyphicon glyphicon-open-file"></i> - Elementos enviados
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $totalFilesSubmit }} en total
                        </span>
                      </h3>
                       {{ $totalSizeFilesSubmitMB }}<strong>Mb</strong><br>
                       {{ $totalSizeFilesSubmitGB }}<strong>Gb</strong><br>
                    </center>
                </div>

                <div class="panel-footer">
                  <center>
                    <a href="{{ route('Coordinador.filesSubmit', [$coordinador->id]) }}" class="linkShow">
                      Ir a lista <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 4 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-default">

                <div class="panel-heading">
                  <i class="glyphicon glyphicon-trash"></i> - Eliminados por algun usuario
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $totalFilesDeleted }} en total
                        </span>
                      </h3>
                       {{ $totalSizeFilesDeletedMB }}<strong>Mb</strong><br>
                       {{ $totalSizeFilesDeletedGB }}<strong>Gb</strong><br>
                    </center> 
                </div>
                <div class="panel-footer">
                  <center>
                    <a href="{{ route('Coordinador.filesDeleted', [$coordinador->id]) }}" class="linkShow">
                      Ir a lista <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>            
          </div>
          

          <center>
            <a href="{{ route('estadisticaFilesCoordReport.download', [$coordinador->id]) }}" class="linkShow" target="_blank">
              Generar y descargar reporte PDF &nbsp;<i class="glyphicon glyphicon-print"></i>
            </a>
          </center>         

        
      </div><!-- end div panel-body -->
      <div class="panel-footer">
        Estadísticas de archivos - <label class="text-info">{{ $dateAct }}</label>
      </div>
              
    
    </div><!-- end div panel-info -->

     <a href="{{ URL::previous() }}"  title="Regresar">
      <button type="button" class="btn btn-primaryReturn">
        <span class="glyphicon glyphicon-arrow-left" ></span> Regresar
      </button>
    </a>
    <br><br>

</div><!-- end div container -->


@stop


