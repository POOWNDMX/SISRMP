@extends('Layouts.BaseAdmin')

@section('titulo')
Coordinadores | Store
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container"><!-- div container -->
	<div class="page-header"><!-- div page-header -->
    <h3>Lista de Coordinadores -</h3>

      <!-- IMAGEN DE PERFILDEL ADMIN EN LINEA -->
      @if(!empty($imagen))
          {{ HTML::image('imagenPERFIL/'.$imagen, "", array('class' => 'img-sessionPerfil', 'width' => '55px', 'height' => '55px')) }} 
        @else
          {{ HTML::image('assets/img/user1.png', "", array('class' => 'img-sessionPerfil', 'width' => '55px', 'height' => '55px' )) }} 
      @endif

    <h6><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Usuario autenticado</h6>
    <h6>
      <font class="text-info">
        <strong>
          <span class="glyphicon glyphicon-user" ></span> 
            {{ Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name }}
        </strong>
      </font>
    </h6>
      <br>
        <!--<h6>  <a href="{{ route('Coordinador.storeDC') }}">Coordinadores por departamento</a> </h6>-->
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
     
      <a href="{{route('Coordinador.create')}}">
        <button type="button" class="btn btn-priC">
          <span class="glyphicon glyphicon-user" ></span> Nuevo coordinador
        </button>
      </a>

  <div class="panel panel-info" ><!-- div pane-info -->
    <div class="panel-heading"><!-- div panel-heading -->
      <h5>
        <i class='glyphicon glyphicon-search'></i> Buscar coordinadores</h5>
    </div><!-- end div panel heading -->
    
    <div class="panel-body" >

        <!-- FORM FOR SEARCH COORDINADORES -->
        {{ Form::open(['route' => 'Coordinador.store', 'method' => 'GET', 'class' => 'navbar-form pull-right', 'role' => 'search', 'autocomplete' => 'off']) }}

            <label align="right">
              <font size="2">
              <button type="button" class="btn btn-warningHelp" data-toggle="modal" data-target="#dataDepto" data-id="Id_Depto">
                <i class='glyphicon glyphicon-question-sign'></i> Mostrar ayuda
              </button>&nbsp;&nbsp; | &nbsp;&nbsp; 
                Página <span class="label label-success">{{ $coordinadores->getCurrentPage() }}</span> 
                de <span class="label label-success">{{ $coordinadores->getLastPage() }}</span> 
                &nbsp;&nbsp;|&nbsp;&nbsp;
                Elementos encontrados en esta página 
                  <span class="label label-success">{{ $coordinadores->count() }} </span>&nbsp;&nbsp;
              </font>
            </label>
           
            <div class="input-group">
              {{ Form::text('buscar', Input::get('buscar'), array('class' => 'form-control', 'placeholder' => 'Buscar coordinador...', 'aria-describedby' => 'search')) }}

              <span class="input-group-addon" id="search">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              </span>
            </div>
             
        {{ Form::close() }} <!-- END FORM FOR SEARCH COORDINADORES -->

          <br>
            <br>
              <br>
    
        <div class="table-responsive"><!-- div table-responsive --> 
          <table class="table table-bordered table-condensed table-hover">     

          @if($coordinadores->count())   
           
            <thead>
              <tr style="background-color: #3492BE; color: #fff;">

                <th><center>Id</center></th>
                <th><center>Nombre</center></th>
                <th><center>Correo</center></th>
                <th><center>Creado</center></th>
                <th><center>Ultima sesión</center></th>
                <th><center>Acciones</center></th>
                <th><center>Estadísticas</center></th>

              </tr>
            </thead>

            <tbody>
              @foreach($coordinadores as $coordinador)
                <tr>

                  <td><center><strong>{{ $coordinador->id }}</strong></center></td>
                  <td>
                    <a href="{{ route('Coordinador.edit', [$coordinador->id]) }}" title="Editar registro">{{ $coordinador->Nombre. ' ' .$coordinador->Apellidos  }}</a>
                  </td>
                  <td>{{ $coordinador->Correo }}</td>
                  <td>{{ $coordinador->created_at }}</td>
                  <td>{{ $coordinador->updated_at }}</td>
                
                  <td>
                    <a href="{{ route('Coordinador.ver', [$coordinador->id]) }}">
                      <button type="submit" class="btn btn-defaultShow" title="Ver registro">
                        <span class="glyphicon glyphicon-eye-open"></span> Perfil
                      </button>
                    </a>

                    <a href="{{ route('Coordinador.edit', [$coordinador->id]) }}" > 
                      <button type="button" class="btn btn-warningEdit" title="Editar registro">
                        <span class="glyphicon glyphicon-edit"></span> Editar  
                      </button> 
                    </a> 

                    <a href="{{ route('Coordinador.editPasswd', [$coordinador->id]) }}" > 
                      <button type="button" class="btn btn-warningEditPass" title="Modificar contraseña">
                        <span class="glyphicon glyphicon-cog"></span> <!-- Modificar contraseña -->   
                      </button> 
                    </a> 
                  </td>
                  <td>
                    <a href="{{ route('statisticPanelCoord.Files', [$coordinador->id]) }}" title="Ver lista">
                        Panel de estadísticas de archivos    
                    </a>       
                  </td>

                </tr>
              @endforeach
            </tbody>
          </table>
        </div> <!-- end div table-responsive  -->
          {{ $coordinadores->appends(array('buscar' => Input::get('buscar')))->links() }}
    </div><!-- end div panel-body  -->

              @else
                <br>
                  <div class="alert alert-SinData">No se encontro ningun dato disponible en esta tabla.</div>
              @endif

    <!-- MOSTRAR EL MODAL DE AYUDA -->
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
                  
                  <p class="pclass">- Por nombre del coordinador</p>
                  <p class="pclass">- Por apellidos del coordinador</p>
                  <p class="pclass">- Por correo electrónico</p><br>
                 
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
</div><!-- end div container-->

@stop