@extends('Layouts.BaseCliente')

@section('titulo')
         {{ Auth::userCliente()->get()->NombreEmpresa }} | Cargar archivos
@endsection

@section('cabecera')
 {{ HTML::script('http://code.jquery.com/jquery-1.11.1.js') }}
 {{ HTML::style('assetsC/css-dropzone/dropzone.css') }}
 

@stop


@section('cuerpo')

    @section('li-myClients')
        class="active"
    @endsection

	@section('tituloPanel')
		Mis contactos <i class="glyphicon glyphicon-chevron-right"></i> Cargar Archivos 

	@endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->
    
        <div class="panel panel-primary"> 
            <div class="panel-heading">
                <center>
                    <span class="ti-layout-tab"></span> 
                    Aquí puedes cargar tus archivos para 
                    <font size="2">{{  $coordinadorUploading->Nombre.' '.$coordinadorUploading->Apellidos }}</font>
                </center>
            </div>
            
            <div class="panel-body">

            {{ Form::open( array(
                                    'url' => 'cliente/uploadFiles', 
                                    'method' => 'POST', 
                                    'class' => 'dropzone', 
                                    'id' => 'dropzoneCoord',
                                    'files' => 'true'
                                )
                            )}}

                {{-- CAMPO OCULTO PARA ENVIAR EL ID DEL CLIENTE DESTINO --}}
                {{ Form::hidden('coordinadorDestination', $coordinadorUploading->id) }}

                <div class="dz-message" style="height:200px;">
                    <h1 class="text-center">
                        <i class="glyphicon glyphicon-cloud-upload"></i>
                    </h1>
                    <font size="2">
                        Arrastra y suelta tus archivos aquí para cargar / Drag and drop your files here to upload
                    </font>
                </div>
        
                <div class="dropzone-previews"></div>
                <center>
                    
                    {{ Form::submit('Enviar archivos', array('class' => 'btn btn-success', 'id' => 'EnvFiles')) }}
                </center>
    
            {{ Form::close() }}

            </div>
        </div>
            
        <a href="{{ URL::previous() }}"  title="Regresar">
            <button type="button" class="btn btn-primaryReturn">
                <span class="glyphicon glyphicon-arrow-left" ></span> Cancelar
            </button>
        </a>          

    </div><!-- end div container-fluid -->
</div><!-- end div content (general) -->


@stop

@section('panel-dropzone')
{{ HTML::script('assetsC/js-dropzone/dropzone.js') }}

<script>
    Dropzone.options.dropzoneCoord = {
        autoProcessQueue: false,
        parallelUploads: 1,
        maxFiles: 50,
        maxFilesize: 1024, // Peso en Megabytes
        addRemoveLinks: true,

        // FUNCION PARA ENVIAR MEDIANTE UN BOTON
        init: function() {
                var submitBtn = document.querySelector("#EnvFiles");
                dropzoneCoord = this;
                
                submitBtn.addEventListener("click", function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    dropzoneCoord.processQueue();
                });

                this.on("success", 
                    dropzoneCoord.processQueue.bind(dropzoneCoord)
                );
               
              
            }
    }
</script>

@endsection



