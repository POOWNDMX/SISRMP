@extends('Layouts.BaseAdmin')

@section('titulo')
Deleted Files | Store
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container">
	<div class="page-header">
    <h3><span class="glyphicon glyphicon-hdd"></span> Lista de archivos eliminados por usuarios-</h3>
    <a href="{{ URL::previous() }}" class="linkShow"><h4><i class="glyphicon glyphicon-arrow-left"></i> Vover</h4></a>
      
  </div><!-- end div panel-header  -->

      <!-- MENSAJE DE EXITO EN LA OPERACION -->
      @if (Session::has('message'))
        <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="glyphicon glyphicon-ok"></i>{{ Session::get('message') }}
        </div>
      @endif

      <!-- SI NO SE EJECUTA ALGUNA OPERACION MUESTRA EL MENSAJE -->
      @if (Session::has('messageFallo'))
        <div class="alert alert-errorOperacion alert-dismissable">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="glyphicon glyphicon-remove"></i>{{ Session::get('messageFallo') }}
        </div>
      @endif


    {{ Form::open(['route' => 'Files.deletedForUSer', 'method' => 'GET', 'class' => 'navbar-form pull-right', 'role' => 'search', 'autocomplete' => 'off']) }}
        
          

         <label align="right">
            <font size="2">
              <button type="button" class="btn btn-warningHelp" data-toggle="modal" data-target="#dataDepto" data-id="Id_Depto">
                <i class='glyphicon glyphicon-question-sign'></i> Mostrar ayuda
              </button>&nbsp;&nbsp; | &nbsp;&nbsp; 
              Página <span class="label label-success">{{ $filesDeletedForUsers->getCurrentPage() }}</span>
               de <span class="label label-success">{{ $filesDeletedForUsers->getLastPage() }}</span> &nbsp;&nbsp;|&nbsp;&nbsp;
              Elementos encontrados en esta pagina <span class="label label-success">{{ $filesDeletedForUsers->count() }}</span>&nbsp;&nbsp;
            </font>
          </label>
               
          <div class="input-group"><!-- div input-group -->
            {{ Form::text('buscar', Input::get('buscar'), array('class' => 'form-control', 'placeholder' => 'Buscar archivo...', 'aria-describedby' => 'search')) }}

              <span class="input-group-addon" id="search">
                <span class="glyphicon glyphicon-search" aria-hidden="true">
                </span>
              </span>
          </div><!-- end div input-group -->
             
        {{ Form::close() }}<!-- END FORM FOR SEACH CLIENTES -->
        
        <br>
          <br>
            <br>

               

      <div class="table-responsive"> 
        <table class="table table-bordered table-condensed table-hover">

          @if($filesDeletedForUsers->count())
           
            <thead>
              <tr style="background-color: #B3DACE; color: #000; font-size: 10px;">
                
                <th><center> Id </center></th>
                <th><center> Nombre </center></th>
                <th><center> Detalle </center></th>
                <th><center> Emisor </center></th>
                <th><center> Receptor </center></th>
                <th><center> Envia </center></th> 
                <th><center> Ver</center></th>
                <th><center> Acción</center></th>
                <th><center> Recuperar</center></th>
                <th><center> Eliminar </center></th>
              </tr>
            </thead>
            <tbody style="font-size: 10px;">
              @foreach($filesDeletedForUsers as $filesDeletedForUser)
              
              <tr>
              
                <td><center><strong> {{ $filesDeletedForUser->Id_File }} </strong></center></td>
                <td>
                  <a href="{{ route('Files.show', [$filesDeletedForUser->Id_File]) }}" title="Detalle del archivo">
                    {{ $filesDeletedForUser->clientOriginalName }}
                  </a>
                </td>                
                <td>
                  <strong>Tipo:</strong>&nbsp;&nbsp;
                      <font color="#C65509">
                        {{ $filesDeletedForUser->clientOriginalExtension }} </center><br>
                      </font>
                  <strong>Tamaño:</strong>&nbsp;&nbsp;
                      <font color="#09ADC6"> 
                        {{ number_format(doubleval($filesDeletedForUser->clientSize/1024),3,'.','')}} MB <br>
                      </font>
                      <strong>Creado:</strong>&nbsp;&nbsp;
                      <font color="#09ADC6"> 
                        {{ $filesDeletedForUser->created_at }}
                      </font>
                </td>

                @if($filesDeletedForUser->userSubmit == 'submitCoord')                
                  <td>
                      <strong>Coordinador:</strong><br>
                        <span class="label label-info">
                          Id: {{ $filesDeletedForUser->Id_Coordinador}}
                        </span><br> 
                      {{ $filesDeletedForUser->NombreCoordinador() }} 
                  </td>
                  @else
                  <td>
                      <strong>Cliente:</strong><br>
                        <span class="label label-info">
                          Id: {{ $filesDeletedForUser->Id_Cliente}}
                        </span><br>
                          {{ $filesDeletedForUser->NombreCliente() }}
                  </td>
                @endif

                 @if($filesDeletedForUser->userSubmit == 'submitClient')                
                  <td>
                    <strong>Coordinador:</strong><br>
                      <span class="label label-info">
                        Id: {{ $filesDeletedForUser->Id_Coordinador}}
                      </span><br>
                        {{ $filesDeletedForUser->NombreCoordinador() }} 
                  </td>
                  @else
                  <td>
                    <strong>Cliente:</strong><br>
                      <span class="label label-info">
                        Id: {{ $filesDeletedForUser->Id_Cliente}}
                      </span><br>
                        {{ $filesDeletedForUser->NombreCliente() }}
                  </td>
                @endif
                <td><center>{{ $filesDeletedForUser->userSubmit }}</center></td>               
                <td>
                  <a href="{{ route('Files.show', [$filesDeletedForUser->Id_File]) }}" title="Detalle del archivo">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs">
                      <i class="glyphicon glyphicon-search"></i>
                    </button>
                  </a>
                </td>
                <td>
                  <center><strong>Eliminado por el usuario:</strong></center>
                  <center><font color="#B70000">{{ $filesDeletedForUser->userDelete }}</font></center>
                    <center> {{ $filesDeletedForUser->updated_at }} </center>
                </td>
               
                <td>
                  <a href="{{ route('FileStPanelDelete.recovery', [$filesDeletedForUser->Id_File]) }}" class="linkShow" title="Recuperar archivo">
                    <center><font size="3"><i class="glyphicon glyphicon-level-up"></i></font></center>
                  </a>
                </td>
                <td>
                <!-- FORM FOR DELETE FILE -->
                {{ Form::open( ['method' => 'DELETE', 'route' => ['File.delete', $filesDeletedForUser->Id_File]] )}}
                  <a title="Eliminar registro"> 
                    <button type="submit" class="btn btn-block btn-dangerReport btn-xs"  onclick="return confirm('¿Seguro de eliminar el registro? Si acepta, el registro se eliminará por completo de la Base de Datos.')">
                      <i class="glyphicon glyphicon-trash"></i>
                    </button>
                  </a>
                {{ Form::close() }}
                </td>
                
              </tr>
              @endforeach
          
            </tbody>
        </table>
      </div><!-- end div table-responsive -->
      
         
         {{ $filesDeletedForUsers->appends(array('buscar' => Input::get('buscar')))->links() }}
      

          @else
            <br><div class="alert alert-SinData">No se encontro ningun dato disponible en esta tabla.</div>
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
                  
                  <p class="pclass">- Por nombre del archivo</p>
                  <p class="pclass">- Por tipo de archivo</p>
                  <p class="pclass">- Por Coordinador</p>
                  <p class="pclass">- Por fecha de registro de carga</p>
                  <p class="pclass">- Por fecha de eliminación</p><br>

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
</div><!-- ed div container -->

  

@stop