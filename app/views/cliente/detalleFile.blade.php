@extends('Layouts.BaseCliente')

@section('titulo')
         {{ Auth::userCliente()->get()->NombreEmpresa }} | 
         Detalle archivo [ {{ $archivo->clientOriginalName }} ]
@endsection

@section('cabecera')

@stop


@section('cuerpo')

    @section('li-FilesOut')
        
    @endsection

    @section('tituloPanel')
         Consultar Archivo
    @endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->
        
        <center><label class="label label-file">{{ $archivo->clientOriginalName }}</label></center>
            <br>
            @if(file_exists($filePath))
                @if($extension == 'PDF' or $extension == 'pdf' or $extension == 'txt')
                        
                        <p class="linkDownload" align="right">
                            <i class="glyphicon glyphicon-cloud-download"></i> 
                            {{ HTML::link('files/storageFiles/'.$file, "Descargar", array('download' => $archivo->clientOriginalNameSan)) }}
                        </p>                        

                 @elseif($extension == 'png' or $extension == 'jpg' or $extension == 'jpeg' or $extension == 'gif' or $extension == 'PNG' or $extension == 'JPG' or $extension == 'JPEG' or $extension == 'GIF')                    
                        
                        <p class="linkDownload" align="right">
                            <i class="glyphicon glyphicon-cloud-download"></i> 
                            {{ HTML::link('files/storageFiles/'.$file, "Descargar", array('download' => $archivo->clientOriginalNameSan)) }}
                        </p>
                    
                
                @elseif($extension == 'xml' or $extension == 'XML' or $extension == 'zip' or $extension == 'rar' or $extension == '7z')                    
                        
                        <p class="linkDownload" align="right">
                            <i class="glyphicon glyphicon-cloud-download"></i> 
                            {{ HTML::link('files/storageFiles/'.$file, "Descargar", array('download' => $archivo->clientOriginalNameSan)) }}
                        </p>
                    
                
                @elseif($extension == 'pptx' or $extension == 'docx' or $extension == 'xlsx' or $extension == 'ppt' or $extension == 'doc' or $extension == 'xls')                   
                        
                        <p class="linkDownload" align="right">
                            <i class="glyphicon glyphicon-cloud-download"></i> 
                            {{ HTML::link('files/storageFiles/'.$file, "Descargar", array('download' => $archivo->clientOriginalNameSan)) }}
                        </p>
                 @elseif($extension == 'bak' or $extension == 'exe' or $extension == 'iso' or $extension == 'msi')               
                        
                        <p class="linkDownload" align="right">
                            <i class="glyphicon glyphicon-cloud-download"></i> 
                            {{ HTML::link('files/storageFiles/'.$file, "Descargar", array('download' => $archivo->clientOriginalNameSan)) }}
                        </p>                    
                @endif
                @else
                  
                    <p class="linkDownload" align="right">  
                      <font color="#A33B03" size="1">
                        <strong>No se puede descargar este archivo porque fué eliminado del servidor</strong>
                      </font>
                    </p>
            @endif
            

        <div class="panel panel-default">
            <div class="panel-body">
                        
                <strong>Titulo del archivo:</strong>
                {{ $archivo->clientOriginalName }}<br>

                <strong>Tipo de archivo:</strong>
                <strong><font color="#009AC1"> {{ $archivo->clientOriginalExtension }} </font></strong><br>
                                            
                <strong>Tamaño del archivo:</strong>
                {{ $totalSizeFilesMB }}<strong> &nbsp;<font color="#009AC1">Mb</font></strong><br>

                <strong>¿Quien envia?:</strong>

                @if($archivo->userSubmit == $envioCoordString)
                    {{ $archivo->NombreCoordinador() }}<br> 
                    @else
                    {{ $archivo->NombreCliente() }}<br> 
                @endif 

                <strong>Para:</strong>

                @if($archivo->userSubmit == $envioCoordString)
                    {{ $archivo->NombreCliente() }}<br> 
                    @else
                    {{ $archivo->NombreCoordinador() }}<br> 
                @endif                          

                <strong>Fecha de envio:</strong>
                {{ $archivo->created_at }}<strong> 
                <br>
                    <br>
                        <br>


                 <!-- Verificamos pimero si existe el path del archivo par poder obtener una vista previa -->
                @if(file_exists($filePath))
                
                    @if($extension == 'PDF' or $extension == 'pdf' )

                        <center>
                            {{ HTML::image('assets/img/pdf.png', "", array('class' => 'img-roundedPdf')) }}
                            <br>
                                <br>
                            <i class="glyphicon glyphicon-search"></i>
                            {{ HTML::link('files/storageFiles/'.$file, 'Obtener vista previa', array('target' => '_blank')) }}
                            <br>
                                <br>
                                    <font color="#878989">
                                    {{ $archivo->clientOriginalName }} &nbsp; {{ $totalSizeFilesMB }}
                                    </font>
                                    <strong> &nbsp;<font color="#080909">Mb</font></strong>
                        </center>
                  
                    @elseif($extension == 'png' or $extension == 'jpg' or $extension == 'jpeg' or $extension == 'gif' or $extension == 'PNG' or $extension == 'JPG' or $extension == 'JPEG' or $extension == 'GIF' )

                        <center>
                            {{ HTML::image('files/storageFiles/'.$file, "", array( 'class' => 'img-thumbnail')) }}
                        </center>

                   
                    @else
                    <center> 
                        {{ HTML::image('assets/img/EmptyFileExists.png', "", array( 'class' => 'img-rounded')) }}
                        <br>
                            <br>
                        <font color="#2D2D2D" size="3" >  
                            <strong>No se puede obtener una vista previa de los archivos .{{ $extension }}</strong>
                        </font>
                        <br>
                            <br>
                            <font color="#878989">{{ $archivo->clientOriginalName }} &nbsp; {{ $totalSizeFilesMB }}</font>
                            <strong> &nbsp;<font color="#080909">Mb</font></strong>
                        <br>
                            <br>
                                <br>
                                    <br>
                    </center>
                    
                  @endif
              @else
                     
                      <center> 
                        {{ HTML::image('assets/img/EmptyFileExists.png', "", array( 'class' => 'img-rounded')) }}
                        <br>
                            <br>
                        <font color="#2D2D2D" size="3">  
                            <strong>No se puede obtener una vista previa de este archivo porque fue eliminado del servidor</strong>
                        </font>
                        <br>
                            <br>
                                <br>
                                    <br>
                    </center>
                    
            @endif
              </tr>

                        
               

                <br>
                    <br>          
        
            </div>
        </div>

        <center>
          <a href="{{ URL::previous() }}" class="linkShow">
            <i class="glyphicon glyphicon-arrow-left"></i> Ir a la vista anterior 
          </a>
        </center>
  


        
    </div><!-- end div container-fluid -->
</div><!-- end div content (general) -->


@stop





