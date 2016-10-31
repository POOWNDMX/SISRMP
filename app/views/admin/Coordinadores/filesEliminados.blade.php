@extends('Layouts.BaseAdmin')

@section('titulo')
    Files eliminados | {{ $coordinador -> Nombre. ' ' .$coordinador -> Apellidos }}
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container">
  <div class="page-header">
    <h3>
    	<span class="glyphicon glyphicon-file"><span class="glyphicon glyphicon-trash"></span>
    	</span> &nbsp;&nbsp;Archivos eliminados por algun usuario del coordinador -</h3>
      <a href="{{ URL::previous() }}" class="linkShow"><h4><i class="glyphicon glyphicon-arrow-left"></i> Vover</h4></a>
      <br>
    <center>
      <h4><span class="label label-file">{{ $coordinador -> Nombre. ' ' .$coordinador -> Apellidos }}</span></h4>
      
    </center>
  </div>

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

  Exportar lista: 
         <a href="{{ route('listaFilesDeletedCoord.view', $coordinador->id) }}" target="_blank" class="linkShow"> 
            PDF <i class="glyphicon glyphicon-file"></i>
        </a>
        &nbsp;&nbsp; | &nbsp;&nbsp;Descarga directa: 
        <a href="{{ route('listaFilesDeletedCoord.download', $coordinador->id) }}" target="_blank" class="linkShow">
            PDF <i class="glyphicon glyphicon-floppy-save"></i>
        </a><br>

        <!-- ENVIAR ID DEL COORDINADOR EN LA URL DE BUSQUEDA -->
        {{ Form::open(['route' => ['Coordinador.filesDeleted', $coordinador->id], 'method' => 'GET', 'class' => 'navbar-form pull-right', 'role' => 'search', 'autocomplete' => 'off']) }}


         <label align="right">
              <button type="button" class="btn btn-warningHelp" data-toggle="modal" data-target="#dataDepto" data-id="Id_Depto">
                <i class='glyphicon glyphicon-question-sign'></i> Mostrar ayuda
              </button>&nbsp;&nbsp; | &nbsp;&nbsp; 
              <font size="2">
              Página <span class="label label-success">{{ $archivos->getCurrentPage() }}</span>
               de <span class="label label-success">{{ $archivos->getLastPage() }}</span> &nbsp;&nbsp;|&nbsp;&nbsp;
              Elementos encontrados en esta página <span class="label label-success">{{ $archivos->count() }}</span>&nbsp;&nbsp;
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

          @if($archivos->count())
           
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
                <th><center> Recuperar </center></th>
                <th><center> Eliminar</center></th>
              </tr>
            </thead>
            <tbody style="font-size: 10px;">
              @foreach($archivos as $archivo)
            <tr>
              
                <td><center><strong> {{ $archivo->Id_File }} </strong></center></td>
                <td>
                	<a href="{{ route('Files.show', [$archivo->Id_File]) }}" title="{{ $archivo->nameEncrypt }}">
                		{{ $archivo->clientOriginalName }}
                	</a>
                </td>
                <td>
                  	<strong>Tipo:</strong>&nbsp;&nbsp;
                      <font color="#C65509">
                        {{ $archivo->clientOriginalExtension }} </center><br>
                      </font>
                  	<strong>Tamaño:</strong>&nbsp;&nbsp;
                      <font color="#09ADC6"> 
                        {{ number_format(doubleval($archivo->clientSize/1024),3,'.','')}} MB <br>
                      </font>
                    <strong>Creado:</strong>&nbsp;&nbsp;
                      <font color="#09ADC6"> 
                        {{ $archivo->created_at }} MB 
                      </font>
                </td>
                
                @if($archivo->userSubmit == 'submitCoord')
                	<td>
                  		<span class="label label-success">Id: {{ $archivo->Id_Coordinador }}</span><br> 
                 			{{ $archivo->NombreCoordinador() }} 
               		</td>
               		@else
               		<td>
                  		<span class="label label-success">Id: {{ $archivo->Id_Cliente }}</span><br> 
                 			{{ $archivo->NombreCliente() }} 
               		</td>
               	@endif  

               	@if($archivo->userSubmit == 'submitClient')
                	<td>
                  		<span class="label label-success">Id: {{ $archivo->Id_Coordinador }}</span><br> 
                 			{{ $archivo->NombreCoordinador() }} 
               		</td>
               		@else
               		<td>
                  		<span class="label label-success">Id: {{ $archivo->Id_Cliente }}</span><br> 
                 			{{ $archivo->NombreCliente() }} 
               		</td>
               	@endif               
               
                <td><center> {{ $archivo->userSubmit }} </center></td>
                <td>
                  <a href="{{ route('Files.show', [$archivo->Id_File]) }}" title="Detalle del archivo">
                    <button type="submit" class="btn btn-block btn-primaryReport btn-xs">
                      <i class="glyphicon glyphicon-search"></i>
                    </button>
                  </a>
                </td>
                
                <td>
                  <center><strong>Eliminado por el usuario:</strong></center>
                  <center><font color="#B70000">{{ $archivo->userDelete }}</font></center>
                  <center> {{ $archivo->updated_at }} </center>
                </td>
               	 <td>
                  <a href="{{ route('FileStPanelDelete.recovery', [$archivo->Id_File]) }}" class="linkShow" title="Recuperar archivo">
                    <center><font size="3"><i class="glyphicon glyphicon-level-up"></i></font></center>
                  </a>
                </td>
                <td>
                <!-- FORM FOR DELETE FILE -->
                {{ Form::open( ['method' => 'DELETE', 'route' => ['File.delete', $archivo->Id_File]] )}}
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
      
      
      {{ $archivos->appends(array('buscar' => Input::get('buscar')))->links() }}

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
                  <p class="pclass">- Por Cliente</p>
                  <p class="pclass">- Por el argumento "submitCoord" (ENVIO COORDINADOR)</p>
                  <p class="pclass">- Por el argumento "submitClient" (ENVIO CLIENTE)</p><br>

                  <p class="text-info"><small>Para buscar por cliente, escriba el Id del cliente en el filtro, para consultar el Id del cliente de búsqueda, vaya a la cartelera de clientes.</small></p>

                </ul>
              </div> <!-- end div panel-body -->
            </div><!-- end div panel-success -->

              <button type="button" class="btn btn-sm btn-defaultModal" data-dismiss="modal">Aceptar</button>
              
        </div><!-- end div modal body -->
      </div><!-- end div modal-content -->
    </div><!-- end div modal-dialog -->
  </div><!-- end div modal -->
  <!-- SE TERMINA EL MODAL DE AYUDA -->



</div>


@stop