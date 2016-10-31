@extends('Layouts.BaseAdmin')

@section('titulo')
    Departamentos | Show
@endsection

@section('cabecera')
@stop

           
@section('cuerpo')

<div class="container"><!-- div container -->
	<div class="page-header"><!-- div header 1 -->
        <h5>
          Departamento | 
            <i class="glyphicon glyphicon-th-list"></i>
            <strong class="text-primary"><i> {{ $departamento->Nombre }} </i></strong>
        </h5>
        
        <p align="right">
          <a href="{{ route('detalleDepto.download', [$departamento->Id_Depto]) }}" class="linkShow" title="Exportar a PDF" target="_blank">
            <i class="glyphicon glyphicon-cloud-download"></i> Exportar PDF
          </a>
        </p>
  </div><!-- end div page header 1-->
    
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#dataDepto" data-id="Id_Depto">
        <i class='glyphicon glyphicon-book'></i> Detalle del departamento
      </button>
        <br>
          <br>

      <p class="pclass">Se encontraron ( {{ $departamento->coordinadores->count() }} ) coordinadores registrados en este departamento.</p>
  

  <div class="panel panel-success"><!-- div panel-success -->
    <div class="panel-heading"><!-- div heading -->
        <i class="text-success">
              <i class='glyphicon glyphicon-list-alt'></i> 
                Coordinadores del departamento de <strong>{{ $departamento->Nombre }}</strong>
              </i>
    </div><!-- end div panel headig -->

        @if($departamento->coordinadores->count())
            <ul class="list-group">
                @foreach($departamento->coordinadores as $coordinador)
                   <li class="list-group-item">
                   {{ $coordinador->Nombre .' '. $coordinador->Apellidos}} - ( {{ $coordinador->Correo }} )
                   </li>
                 @endforeach
            </ul>
        @else
           <br>
             <div class="alert alert-SinData">No se encontro ningun dato disponible en este departamento.</div>
        @endif
  </div><!-- end div panel-success -->

            <a href="{{ URL::previous() }}"  title="Regresar">
              <button type="button" class="btn btn-primaryReturn">
                <span class="glyphicon glyphicon-arrow-left" ></span> Regresar
              </button>
            </a>


  <div class="modal fade" id="dataDepto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><!--div modal-->
    <div class="modal-dialog" role="document"><!-- div modal-dialog -->
      <div class="modal-content"><!-- div modal-content -->
        <div class="modal-body"><!-- div modal-body -->
       
            <div class="panel panel-success" ><!-- div panel-success -->

              <div class="panel-heading"><!-- div heading 2 -->
                 <h5><i class='glyphicon glyphicon-list-alt'></i> 
                    Detalle Departamento <strong>{{ $departamento->Nombre }}</strong>
                  </h5>
              </div><!-- end div panel-heading 2 -->
            
              <div class="panel-body" ><!-- div panel-body -->
                <dl class="dl-horizontal"><!-- end div container -->

                     <dt>Id:</dt>
                     <font color="#BFBFBF"><i><dd>{{ $departamento->Id_Depto }}</dd></i></font>

                     <dt>Nombre:</dt>
                     <font color="#BFBFBF"><i><dd>{{ $departamento->Nombre }}</dd></i></font>
  
                     <dt>Firma:</dt>
                     <font color="#BFBFBF"><i><dd>{{ $departamento->Firma }}</dd></i></font>

                      <dt>Creado:</dt>
                     <i>
                      <dd>
                        <font color="#BFBFBF">{{ $departamento->created_at}}</font> 
                        por <font color="#0081DC">{{ $departamento->AdminCreated}}</font> 
                       
                      </dd>
                    </i>

                     <dt>Última modificación:</dt>
                     <i>
                      <dd>
                        <font color="#BFBFBF">{{ $departamento->updated_at}}</font> 
                        por <font color="#0081DC"> {{ $departamento->AdminUpdated}} </font> 
                      </dd>
                    </i>
                     <dt>Comentarios:</dt>
                     <font color="#BFBFBF"><i><dd>{{ $departamento->Comentarios }}</dd></i></font>

                    <dt></dt>
                    <dd></dd>

                </dl><!-- end dl-horizontal -->
              </div> <!-- end div panel-body -->
            </div><!-- end div panel-success -->

              <button type="button" class="btn btn-sm btn-defaultModal" data-dismiss="modal">Aceptar</button>
              
        </div><!-- end div modal body -->
      </div><!-- end div modal-content -->
    </div><!-- end div modal-dialog -->
  </div><!-- end div modal -->
</div><!-- end div container -->

@stop



