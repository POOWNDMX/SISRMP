@extends('Layouts.BaseAdmin')

@section('titulo')
Asignados | Store
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container"><!-- div container -->
	<div class="page-header"><!-- div page-header -->
    <center>
      <h3>
        <i class='glyphicon glyphicon-user'></i> 
        <i class="glyphicon glyphicon-resize-horizontal"></i> 
        <i class='glyphicon glyphicon-user'></i>
      </h3>
    </center>

    <h3>Listado de relaciones cliente - coordinador</h3>
      <!-- IMAGEN DE PERFILDEL ADMIN EN LINEA -->
      @if(!empty($imagen))
          {{ HTML::image('imagenPERFIL/'.$imagen, "", array('class' => 'img-sessionPerfil', 'width' => '55px', 'height' => '55px')) }} 
        @else
          {{ HTML::image('assets/img/user1.png', "", array('class' => 'img-sessionPerfil', 'width' => '55px', 'height' => '55px' )) }} 
      @endif
                    
    <h6>Usuario autenticado</h6>
    <h6>
      <font class="text-info">
        <strong>
          <span class="glyphicon glyphicon-user" ></span> 
          {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}
        </strong>
      </font>
    </h6>
      <br>

  </div><!-- end div page-header -->

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


  <a href="{{route('Asignar.create')}}">
    <button type="button" class="btn btn-priC">
      <span class="glyphicon glyphicon-plus" ></span> Crear nueva asignación
    </button>
  </a>

  <div class="panel panel-info" ><!-- div panel-info  -->
    <div class="panel-heading"><!-- div panel-heading  -->
      <h5><i class='glyphicon glyphicon-search'></i> Buscar relación</h5>
    </div><!--  -->
    
    <div class="panel-body" ><!-- div panel-body  -->

      {{ Form::open(['route' => 'Asignar.store', 'method' => 'GET', 'class' => 'navbar-form pull-right', 'role' => 'search']) }}
           
            <label align="right">
        <font size="2">
          <button type="button" class="btn btn-warningHelp" data-toggle="modal" data-target="#dataDepto" data-id="Id_Depto">
                <i class='glyphicon glyphicon-question-sign'></i> Mostrar ayuda
          </button> &nbsp;&nbsp; | &nbsp;&nbsp;
          Página <span class="label label-success">{{ $asignados->getCurrentPage() }}</span> 
          de <span class="label label-success">{{ $asignados->getLastPage() }}</span> &nbsp;&nbsp;|&nbsp;&nbsp;
          Elementos encontrados en esta página <span class="label label-success">{{ $asignados->count() }} </span>&nbsp;&nbsp;
        </font>
      </label>
            
            <div class="input-group"><!-- div input-group -->
              {{ Form::text('buscar', Input::get('buscar'), array('class' => 'form-control', 'placeholder' => 'Id de Coordinador...', 'aria-describedby' => 'search')) }}

                <span class="input-group-addon" id="search">
                   <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
              
            </div><!-- end div input-group -->

      {{ Form::close() }} <!-- END FORM FOR SEARCH DEPARTAMENTS -->

      <br>
        <br>
          <br>
    
      <div class="table-responsive"> 
        <table class="table table-bordered table-condensed table-hover">

          <thead>
            <tr style="background-color: #3492BE; color: #fff;">

              <th><center>Id</center></th>
              <th>Coord ID</th>
              <th>Coordinador</th>
              <th>Cliente ID</th>
              <th>Cliente</th>
              <th>Creado</th>
              <th>Creado por admin</th>
              <th>Modificado</th>
              <th>Acciones</th>

            </tr>
          </thead>

          @if($asignados->count())
          <tbody>
          @foreach($asignados as $asignado)

            <tr>
              <td><center><strong>{{ $asignado->Id_FolioCC }}</strong></center></td>
              <td style="background-color: #E0E7B1; color: #BC0707;"><center>{{ $asignado->Id_Coordinador }}</center></td>
              <td style="background-color: #F1F6CE; color: #000;">{{ $asignado->Coordinador_Name() }}</td>
              <td style="background-color: #C5DEC2; color: #BC0707;"><center>{{ $asignado->Id_Cliente }}</center></td>
              <td style="background-color: #E8F6E6; color: #000;">{{ $asignado->Cliente_Name() }}</td>
              <td>{{ $asignado->created_at }}</td>
               <td>{{ $asignado->AdminCreated }}</td>
              <td>{{ $asignado->updated_at }}</td>
              <td>

              <!--  FORM FOR DELETE RELCIONES O ASIGNACIONES -->
              {{ Form::open(['method' => 'DELETE', 'route' => ['Asignar.delete', $asignado -> Id_FolioCC]])}}
           
                <button type="submit" class="btn btn-remove" onclick="return confirm('¿Seguro de eliminar el registro?. Si acepta, el registro se eliminará por completo de la Base de Datos.')" title="Eliminar registro"> 
                   <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar
                </button>
            
              {{ Form::close() }}
              </td>
            </tr>

          @endforeach
         </tbody>
        </table>
      </div><!-- div table-responsive  -->
      {{ $asignados->appends(array('buscar' => Input::get('buscar')))->links() }}
    </div><!-- end div panel-body -->

        @else
           <br><div class="alert alert-SinData">No se encontro ningun dato disponible en esta tabla.</div>
        @endif  

   <!-- MODAL DE AYUDA -->
    <div class="modal fade" id="dataDepto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><!--div modal-->
    <div class="modal-dialog" role="document"><!-- div modal-dialog -->
      <div class="modal-content"><!-- div modal-content -->
        <div class="modal-body"><!-- div modal-body -->
       
            <div class="panel panel-info" ><!-- div panel-success -->

              <div class="panel-heading"><!-- div heading 2 -->
                 <strong><i class="glyphicon glyphicon-question-sign"></i> Ayuda sobre el filtro de búsqueda</strong>
              </div><!-- end div panel-heading 2 -->
            
              <div class="panel-body" ><!-- div panel-body -->
                <h5>Argumentos para buscar información en el filtro de búsqueda:</h5><br>
                  
                  <p class="pclass">- Por coordinador. </p> <br>

                  <p class="text-info"><small>Para buscar por coordinador, escriba el Id del coordinador en el filtro, para consultar el Id del coordinador de búsqueda, vaya a la cartelera de coordinadores.</small></p>

                </ul>
              </div> <!-- end div panel-body -->
            </div><!-- end div panel-success -->

              <button type="button" class="btn btn-sm btn-defaultModal" data-dismiss="modal">Aceptar</button>
              
        </div><!-- end div modal body -->
      </div><!-- end div modal-content -->
    </div><!-- end div modal-dialog -->
  </div><!-- end div modal -->
  <!-- SE TERMINA EL MODAL DE AYUDA -->
 
  </div><!-- end div panel-info -->
</div><!-- end div container -->

@stop