@extends('Layouts.BaseAdmin')

@section('titulo')
Reportes 
@endsection

@section('cabecera')
@stop


@section('cuerpo')

<div class="container"><!-- div container-->
	<div class="page-header"><!-- div page-header -->
      <h3>REPORTES DEL SISTEMA -</h3>

          <!-- IMAGEN DE PERFILDEL ADMIN EN LINEA -->
          @if(!empty($imagen))
              {{ HTML::image('imagenPERFIL/'.$imagen, "", array('class' => 'img-sessionPerfil', 'width' => '55px', 'height' => '55px')) }} 
            @else
              {{ HTML::image('assets/img/user1.png', "", array('class' => 'img-sessionPerfil', 'width' => '55px', 'height' => '55px' )) }} 
          @endif
                    
      <h6><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Usuario autenticado</h6>
      <h6><font class="text-info"><strong><span class="glyphicon glyphicon-user" ></span> {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}</strong></font></h6><br>
   </div><!-- end div page-header  -->

      


    <div class="panel panel-info" ><!-- div panel-info-->
      <div class="panel-heading"><!-- div panel-heading-->
        <h5><i class='glyphicon glyphicon-print'></i> REPORTES DEL SISTEMA</h5>
      </div><!-- end div panel-heading-->

      <div class="panel-body" >
         
          <br>
            <br>
              <br>

          <div class="table-responsive"><!-- div table-responsibe --> 
            <table class="table table-bordered table-condensed table-hover"><!-- table -->
              <thead>
                <tr>
                
                  <th><center> ID </center></th>
                  <th><center> Nombre </center></th>
                  <th><center> Tipo </center></th>
                  <th><center> Ver </center></th>
                  <th><center> Descargar </center></th>
                </tr>
              </thead>

             

              <tbody>
                
                <!-- REPORTE DE ESTADISTICAS DE LA TABLA DE ARCHIVOS DE LA BASE DE DATOS -->
                <tr>
                <td><center><strong> 1 </strong></center></td>
                <td class="text-info">ESTADÍSTICAS DE LA TABLA DE ARCHIVOS</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('estadisticaFiles.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs">
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('estadisticaFiles.download') }}" title="Descargar reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>

                <!-- REPORTE DE ESTADISTICAS DE LA TABLA DE ARCHIVOS DE LA BASE DE DATOS -->
                <tr>
                <td><center><strong> 2 </strong></center></td>
                <td class="text-info"> LISTA DE ARCHIVOS ENVIADOS POR LOS CLIENTES</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('listaFilesEnviaCliente.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs">
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('listaFilesEnviaCliente.download') }}" title="Descargar reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>

                <!-- REPORTE DE ESTADISTICAS DE LA TABLA DE ARCHIVOS DE LA BASE DE DATOS -->
                <tr>
                <td><center><strong> 3 </strong></center></td>
                <td class="text-info">LISTA DE ARCHIVOS ENVIADOS POR LOS COORDINADORES</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('listaFilesEnviaCoordinador.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs">
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('listaFilesEnviaCoordinador.download') }}" title="Descargar reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>

                <!-- REPORTE DE ESTADISTICAS DE LA TABLA DE ARCHIVOS DE LA BASE DE DATOS -->
                <tr>
                <td><center><strong> 4 </strong></center></td>
                <td class="text-info">LISTA DE ARCHIVOS ELIMINADOS POR ALGUN USUARIO</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('listaFilesDeletedForUsers.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs">
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('listaFilesDeletedForUsers.download') }}" title="Descargar reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>

                <!-- REPORTE DE TODOS LOS ARCHIVOS POR POR NOMBRE, CLIENTE Y COORDINADOR -->
                <tr>
                <td><center><strong> 5 </strong></center></td>
                <td class="text-info">LISTA DE ARCHIVOS EXISTENTES EN LA TABLA DE ARCHIVOS</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('listaFiles.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs" >
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('listaFiles.download') }}" title="Descargar reporte"  target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>

                <!-- Reporte de lista de archivos nombre original y nombre encriptado -->
                <tr>
                <td><center><strong> 6 </strong></center></td>
                <td class="text-info">LISTA DE ARCHIVOS EXISTENTES NOMBRE ORIGINAL - NOMBRE ENCRIPTADO</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('listaFilesforName.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs" >
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('listaFilesforName.download') }}" title="Descargar reporte"  target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>

                <!-- REPORTE DE CARTELERA DE CLIENTES CON TODA SU INFORMACIÓN FISCAL-->
                <tr>
                <td><center><strong> 7 </strong></center></td>
                <td class="text-info">CARTELERA DE CLIENTES</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('listaCliente.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs">
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('listaCliente.download') }}" title="Descargar reporte"  target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>

                <!-- REPORTE DE COORDINADORES --> 
                <tr>
                <td><center><strong> 8</strong></center></td>
                <td class="text-info">CARTELERA DE COORDINADORES</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('listaCoord.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs" >
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('listaCoord.download') }}" title="Descargar reporte"  target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>

                <!-- REPORTE DE LAS RELACIONES O ASIGNACIONES ENTRE CLIENTE Y COOORDINADOR -->
                <tr>
                <td><center><strong> 9 </strong></center></td>
                <td class="text-info">LISTADO DE LAS RELACIONES CLIENTE COORDINADOR</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('listaRelacion.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs" >
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('listaRelacion.download') }}" title="Descargar reporte"  target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>

                <!-- REPORTE DE IMAGENES DE COORDINADORES -->
                <tr>
                <td><center><strong> 10 </strong></center></td>
                <td class="text-info">LISTADO DE LAS IMAGENES DE CUENTA DE COORDINADORES EN EL SERVIDOR Y DB</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('listaImagesCoord.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs" >
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('listaImagesCoord.download') }}" title="Descargar reporte"  target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>

                <!-- REPORTE DE IMAGENES DE CLIENTES -->
                <tr>
                <td><center><strong> 11 </strong></center></td>
                <td class="text-info">LISTADO DE LAS IMAGENES DE CUENTA DE CLIENTES EN EL SERVIDOR Y DB</td>
                <td><center> pdf &nbsp;<i class="glyphicon glyphicon-file"></i></center></td>
                <td>
                  <a href="{{ route('listaImagesClient.view') }}" title="Ver reporte" target="_blank">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs" >
                     <i class="glyphicon glyphicon-search"></i> VER</button>    
                  </a>
                </td>
                <td>
                  <a href="{{ route('listaImagesClient.download') }}" title="Descargar reporte"  target="_blank">
                    <button type="submit" class="btn btn-block btn-successReport btn-xs">
                     <i class="glyphicon glyphicon-cloud-download"></i> DESCARGAR</button>    
                  </a>
                </td>
                </tr>
               
              </tbody>
            </table><!-- end table -->
          </div><!-- end div table-responsible -->

        
      </div><!-- end div panel-body -->

              
    
    </div><!-- end div panel-info -->
</div><!-- end div container -->


@stop


