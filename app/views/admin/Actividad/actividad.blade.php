@extends('Layouts.BaseAdmin')

@section('titulo')
Portal | Actividad
@endsection

@section('cabecera')

{{HTML::style('assets/font-awesome/css/font-awesome.min.css')}}

{{ HTML::script('http://code.jquery.com/jquery-1.11.1.js') }}
 {{ HTML::style('assetsC/css-dropzone/dropzone.css') }}
 {{ HTML::script('assetsC/js-dropzone/dropzone.js') }}
@stop


@section('cuerpo')

<div class="container">
                       
  <h4>
    <i class="glyphicon glyphicon-ok"></i> 
    <i class="glyphicon glyphicon-user"></i>                   
    <i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Usuario autenticado...
  </h4>     
       
  <!-- IMAGEN DE PERFIL ADMINISTRADOR EN LINEA -->
  @if(!empty($imagen))
      {{ HTML::image('imagenPERFIL/'.$imagen, "", array('class' => 'img-infosession', 'width' => '55px', 'height' => '55px')) }}
    @else
      {{ HTML::image('assets/img/user1.png', "", array('class' => 'img-infosession', 'width' => '55px', 'height' => '55px' )) }} 
  @endif
                    
  <h5>
    <p class="text-primary">
      Bienvenido(a) <strong>{{ Auth::userAdmin()->get()->first_name.' '. Auth::userAdmin()->get()->last_name }}</strong>
    </p>
  </h5>

  <h6>
    <p class="text-success">
      Sesión activa - <strong>ADMINISTRADOR</strong>
    </p>
  </h6>
                        
  {{ Session::get('mensajeBienvenida') }}

    <div class="row">
      <br>
      <a href="{{ route('Admin.store') }}">
        <button type="button" class="btn btn-priCNew">
          <span class="glyphicon glyphicon-user" ></span> WEBMASTER'S
        </button>
      </a>
      
      <a href="{{ route('Admin.ver') }}">
        <button type="button" class="btn btn-priCA">
          <span class="glyphicon glyphicon-user" ></span> PERFIL WEBMASTER
        </button>
      </a>

      <a href="{{ route('Admin.create') }}">
        <button type="button" class="btn btn-priCPlus">
          <span class="glyphicon glyphicon-plus" ></span> NUEVO ADMIN
        </button>
      </a>
    </div>

    <div class="page-header">
      <h3><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Tablero de actividad</h3>
      </div>
    
    <div class="page-header">
      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="panel panel-blue">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-bars fa-4x"></i>
                </div>
      
                <div class="col-xs-9 text-right">
                  <div class="huge">{{ $totalDepto->count() }}</div>
                  <div>Departamentos en total!</div>
                </div>
              </div>
            </div>
            <a href="#">
              <div class="panel-footer">
                <a href="{{route('Departamento.create')}}">
                  <span class="pull-left"><span class="glyphicon glyphicon-plus" ></span> Nuevo departamento</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
                <div class="clearfix"></div>
               </div>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-user fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge">{{ $totalCoord->count() }}</div>
                  <div>Coordinadores en total!</div>
                </div>
              </div>
            </div>
            <a href="#">
              <div class="panel-footer">
                <a href="{{route('Coordinador.create')}}">
                  <span class="pull-left"><span class="glyphicon glyphicon-plus" ></span> Nuevo coordinador</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-user fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge">{{ $totalCliente->count() }}</div>
                  <div>Clientes en total!</div>
                </div>
              </div>
            </div>
            <a href="#">
              <div class="panel-footer">
                <a href="{{route('Cliente.create')}}">
                  <span class="pull-left"><span class="glyphicon glyphicon-plus" ></span> Nuevo cliente</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
                
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-gray">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-sitemap fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge">{{ $totalRelacion->count() }}</div>
                  <div>Relaciones en total!</div>
                </div>
              </div>
            </div>
            <a href="#">
              <div class="panel-footer">
                <a href="{{route('Asignar.create')}}">
                  <span class="pull-left"><span class="glyphicon glyphicon-plus" ></span> Relación Cliente-Coordinador</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
      </div>

      <div class="page-header">
      <h4><i class="fa fa-bar-chart-o fa-1x "></i> Estadísticas de la tabla de archivos ( DB ) - 
        <span class="label label-primary">{{ $totalFiles }}</span> en total.
      </h4>
      </div>

      @if($totalSizeFilesMB >50000 and $totalSizeFilesMB <=65000 )
        <div class="alert alert-infoSize alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>INFORMACIÓN: </strong>La tabla ha sobrepasado los 50 <strong>GB</strong>. 
            <h6><p class="text-danger">Es recomendable eliminar algunos archivos para liberar espacio </p></h6> 
        </div><br>
        @elseif($totalSizeFilesMB >65000)
          <div class="alert alert-dangerSize alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>AVISO: </strong>La tabla ha sbrepasado los 65 Gb  <strong>GB</strong>.
              <h6><p class="text-primary">Es recomendable eliminar algunos archivos para no agotar la memoria</p></h6> 
          </div><br>
      @endif

      <!-- TABLA DE ESTADISTICAS DE LA TABLA DE ARCHIVOS EN LA BASE DE DATOS -->
      <div class="table-responsive"><!-- div table-responsibe --> 
            <table class="table table-bordered table-condensed"><!-- table -->
              <thead>
                <tr style="background-color: #3492BE; color: #fff;">
                
                  <th><center> Archivos en total </center></th>
                  <th><center> Tamaño total ( Megabytes ) </center></th>
                  <th><center> Tamaño total ( Gigabytes ) </center></th>
                  <th><center> Acciones </center></th>
                  
                </tr>
              </thead>

              <tbody>
                  <td><center><span class="label label-primary">{{ $totalFiles }}</center></span></td>
                 <td><center>{{ $totalSizeFilesMB }} <span class="label label-default">Mb</span></center></td>
                  <td><center>{{ $totalSizeFilesGB }} <span class="label label-default">Gb</span></center></td>
                  <td>
                    <a href="{{ route('statisticPanel.Files') }}" title="Ver lista">
                      <button type="submit" class="btn btn-block btn-successReport btn-xs" >
                        Panel general de estadísticas de archivos
                      </button>    
                    </a>       
                  </td>
                <tr>
                
                </tr>
              </tbody>
            </table><!-- end table -->
          </div><!-- end div table-responsible -->

         
     
      
    </div><!--end div page-header -->
</div><!-- end div container -->


 



@stop