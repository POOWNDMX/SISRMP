@extends('Layouts.BaseAdmin')

@section('titulo')
Index | Truncate DB
@endsection

@section('cabecera')


@stop


@section('cuerpo')

<div class="container">
	 <div class="page-header">
      <center>
      <h5>{{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}</h5>
        <h4>
          <font class="text-primary">
            <strong><i class="glyphicon glyphicon-hdd"></i>
              Truncar Base de datos
            </strong>
          </font>
        </h4>
    </center>
  </div>

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

  <div class="row">

            <div class="col-md-3"><!-- COL 1 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-danger">

                <div class="panel-heading">
                  <font size="2"><i class="glyphicon glyphicon-hdd"></i> - Truncar Departamentos</font> 
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $departamentos }} en total
                        </span>
                      </h3>
                      
                    </center>
                </div>

                <div class="panel-footer">
                  <center>
                    <a href="{{ route('DeptoTruncate.truncar') }}" onclick="return confirm('¿Seguro de truncar la tabla? Si acepta, se eliminaran todos los registros de la tabla departamento en la base de datos del sistema.')" class="linkShow">
                      Vaciar y poner a 0 <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 2 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-danger">

                <div class="panel-heading">
                  <font size="2"><i class="glyphicon glyphicon-hdd"></i> - Truncar Coordinadores</font>
                </div>

                <div class="panel-body">
                  <center>
                      <h3>
                        <span class="label label-default">{{ $coordinadores }} en total
                        </span>
                      </h3>                      
                     
                  </center>
                </div>

                <div class="panel-footer">
                  <center>
                    <a href="{{ route('CoordTruncate.truncar') }}" onclick="return confirm('¿Seguro de truncar la tabla? Si acepta, se eliminaran todos los registros de la tabla coordinador en la base de datos del sistema.')" class="linkShow">
                      Vaciar y poner a 0 <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 3 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-danger">

                <div class="panel-heading">
                  <font size="2"><i class="glyphicon glyphicon-hdd"></i> - Truncar clientes</font>
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $clientes }} en total
                        </span>
                      </h3>
                      
                    </center>
                </div>

                <div class="panel-footer">
                  <center>
                    <a href="{{ route('ClientTruncate.truncar') }}" onclick="return confirm('¿Seguro de truncar la tabla? Si acepta, se eliminaran todos los registros de la tabla cliente en la base de datos del sistema.')" class="linkShow">
                      Vaciar y poner a 0 <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 4 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-danger">

                <div class="panel-heading">
                  <font size="2"><i class="glyphicon glyphicon-hdd"></i> - Truncar relaciones</font>
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $relaciones }} en total
                        </span>
                      </h3>
                      
                    </center> 
                </div>
                <div class="panel-footer">
                  <center>
                    <a href="{{ route('RelationTruncate.truncar') }}" onclick="return confirm('¿Seguro de truncar la tabla? Si acepta, se eliminaran todos los registros de la tabla clientecoord en la base de datos del sistema.')" class="linkShow">
                      Vaciar y poner a 0 <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 4 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-danger">

                <div class="panel-heading">
                  <font size="2"><i class="glyphicon glyphicon-hdd"></i> - Truncar Archivos</font>
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $archivos }} en total
                        </span>
                      </h3>
                      
                    </center> 
                </div>
                <div class="panel-footer">
                  <center>
                    <a href="{{ route('FilesTruncate.truncar') }}" onclick="return confirm('¿Seguro de truncar la tabla? Si acepta, se eliminaran todos los registros de la tabla archivos en la base de datos del sistema.')" class="linkShow">
                      Vaciar y poner a 0 <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>   

            <div class="col-md-3"><!-- COL 4 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-primary">

                <div class="panel-heading">
                  <font size="2"><i class="glyphicon glyphicon-folder-open"></i> - Carpeta del servidor (Archivos)</font>
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $totalFilesServer }} en total
                        </span>
                      </h3>
                      
                    </center> 
                </div>
                <div class="panel-footer">
                  <center>
                    <a href="{{ route('fileServerTruncate.truncar') }}" onclick="return confirm('¿Seguro de truncar la carpeta? Si acepta, se eliminaran todos los archivos que contiene la carpeta en el servidor.')" class="linkShow">
                      Vaciar <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>  

            <div class="col-md-3"><!-- COL 4 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-info">

                <div class="panel-heading">
                  <font size="1"><i class="glyphicon glyphicon-folder-open"></i> - Imágen perfil coordinador (carpeta servidor)</font>
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $totalImagePerfilCoord }} en total
                        </span>
                      </h3>
                      
                    </center> 
                </div>
                <div class="panel-footer">
                  <center>
                    <a href="{{ route('fileImgPerfilServerTruncate.coordinador') }}" onclick="return confirm('¿Seguro de truncar la carpeta? Si acepta, se eliminaran todas las imágenes del perfil coordinador en el servidor.')" class="linkShow">
                      Vaciar <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

            <div class="col-md-3"><!-- COL 4 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-info">

                <div class="panel-heading">
                  <font size="1"><i class="glyphicon glyphicon-folder-open"></i> - Imágen perfil cliente (carpeta servidor)</font>
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $totalImagePerfilClient }} en total
                        </span>
                      </h3>
                      
                    </center> 
                </div>
                <div class="panel-footer">
                  <center>
                    <a href="{{ route('fileImgPerfilServerTruncate.cliente') }}" onclick="return confirm('¿Seguro de truncar la carpeta? Si acepta, se eliminaran todas las imágenes del perfil cliente en el servidor.')" class="linkShow">
                      Vaciar <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>

             <div class="col-md-3"><!-- COL 4 &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
              <div class="panel panel-info">

                <div class="panel-heading">
                  <font size="1"><i class="glyphicon glyphicon-folder-open"></i> - Imágen perfil admin (carpeta servidor)</font>
                </div>

                <div class="panel-body">
                    <center>
                      <h3>
                        <span class="label label-default">{{ $totalImagePerfilAdmin }} en total
                        </span>
                      </h3>
                      
                    </center> 
                </div>
                <div class="panel-footer">
                  <center>
                    <a href="{{ route('fileImgPerfilServerTruncate.administrador') }}" onclick="return confirm('¿Seguro de truncar la carpeta? Si acepta, se eliminaran todas las imágenes del perfil administrador en el servidor.')" class="linkShow">
                      Vaciar <i class="glyphicon glyphicon-circle-arrow-right"></i>
                    </a>
                  </center>
                </div>

              </div>
            </div>


          </div>
                   


 
    
</div><!-- end div container -->


@stop

