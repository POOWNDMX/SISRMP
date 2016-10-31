@extends('Layouts.BaseAdmin')

@section('titulo')
Files | Store
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container">
	<div class="page-header">
    <h3><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp;Detalle del Archivo -</h3>
    <center>
      <h4><span class="label label-file">{{ $archivo->clientOriginalName }}</span></h4>
                    
    </center>
  </div>

  <div class="panel panel-default">
    <div class="panel-body">

      <div class="table-responsive"> 
        <table class="table-bordered table-condensed table-hover">
            <thead>
              
            </thead>
            <tbody>
              <tr>
                <td><p class="pclassFile" align="right"><strong>ID DEL ARCHIVO:</strong> </p></td>
                <td><span span class="label label-info">{{ $archivo->Id_File }}</span></td>
              </tr>
              <tr>
                <td><p class="pclassFile" align="right"><strong>TITULO ORIGINAL:</strong> </p></td>
                <td><span span class="label label-info">{{ $archivo->clientOriginalName }}</span></td>
              </tr>
              <tr>
                <td><p class="pclassFile" align="right"><strong>TITULO ENCRIPTADO:</strong> </p></td>
                <td><span span class="label label-info">{{ $archivo->nameEncrypt }}</span></td>
              </tr>
               <tr>
                <td><p class="pclassFile" align="right"><strong>PESO DEL ARCHIVO:</strong> </p></td>
                <td><span span class="label label-info">{{ $totalSizeFilesMB }}</span><strong> Mb</strong></td>
              </tr>
              <tr>
                <td><p class="pclassFile" align="right"><strong>TIPO DE ARCHIVO:</strong> </p></td>
                <td><span span class="label label-info">{{ $archivo->clientOriginalExtension }}</span></td>
              </tr>
              <tr>
                <td><p class="pclassFile" align="right"><strong>ENVIA:</strong> </p></td>
                <td>
                  @if($userEnvia == $envioClienteString)<!-- submitClient -->
                    <span span class="label label-info">{{ $archivo->NombreCliente() }}</span>
                    @else
                    <span span class="label label-info">{{ $archivo->NombreCoordinador() }}</span>
                   @endif
                </td>
              </tr>
              <tr>
                <td><p class="pclassFile" align="right"><strong>PARA:</strong> </p></td>
                <td>
                  @if($userEnvia != $envioClienteString)
                    <span span class="label label-info">{{ $archivo->NombreCliente() }}</span>
                    @else
                    <span span class="label label-info">{{ $archivo->NombreCoordinador() }}</span>
                  @endif
                </td>
              </tr>
              <tr>
                <td><p class="pclassFile" align="right"><strong>FECHA DE ENVIO:</strong> </p></td>
                <td><span span class="label label-info">{{ $archivo->created_at }}</span></td>
              </tr>
              <tr>
                <td><p class="pclassFile" align="right"><strong>FECHA DE MODIFICACION:</strong> </p></td>
                <td><span span class="label label-info">{{ $archivo->updated_at }}</span></td>
              </tr>

              <tr>
                <td><p class="pclassFile" align="right"><strong>VISTA PREVIA:</strong> </p></td>

              <!-- Verificamos pimero si existe el path del archivo par poder obtener una vista previa -->
            @if(file_exists($filePath))
                
                @if($extension == 'PDF' or $extension == 'pdf' )
                  <td>
                    <i class="glyphicon glyphicon-search"></i>
                    {{ HTML::link('files/storageFiles/'.$file, 'Obtener vista previa', array('class' => 'linkShow', 'target' => '_blank')) }}
                  </td>
                  @elseif($extension == 'png' or $extension == 'jpg' or $extension == 'jpeg' or $extension == 'gif' or $extension == 'PNG' or $extension == 'JPG' or $extension == 'JPEG' or $extension == 'GIF' )
                  <td>
                    <i class='glyphicon glyphicon-search'></i> 
                    <a href="{{ route('Img.show', [$archivo->Id_File]) }}" title="Detalle del archivo">
                      Obtener vista previa 
                    </a>
                  </td>
                    @else
                    <td>   
                      <font color="#A33B03" size="2">
                        <strong>No se puede obtener una vista previa de los archivos .{{ $extension }}</strong>
                      </font>
                    </td>
                  @endif
              @else
                  <td>   
                      <font color="#A33B03" size="2">
                        <strong>No se puede obtener una vista previa de este archivo porque fué eliminado del servidor</strong>
                      </font>
                    </td>
            @endif
              </tr>

              <tr>
                <td><p class="pclassFile" align="right"><strong>DESCARGAR ARCHIVO:</strong> </p></td>

             <!-- Verificamos pimero si existe el path del archivo par poder descargarlo -->
            @if(file_exists($filePath))
                 
                 @if($extension == 'PDF' or $extension == 'pdf' or $extension == 'txt')
                    <td>
                      <button type="submit" class="btn btn-primaryDownload" title="Descargar de la nube">
                        {{ HTML::link('files/storageFiles/'.$file, 'Descargar archivo', array(
                                                            'class' => 'linkShow',
                                                            'target' => '_blank',
                                                            'download' => $archivo->clientOriginalNameSan
                                                            )) }}
                        &nbsp;&nbsp;<i class="glyphicon glyphicon-cloud-download"></i>
                      </button>
                    </td>                                 
                  @elseif($extension == 'png' or $extension == 'jpg' or $extension == 'jpeg' or $extension == 'gif' or $extension == 'PNG' or $extension == 'JPG' or $extension == 'JPEG' or $extension == 'GIF')
                    <td>
                      <button type="submit" class="btn btn-primaryDownload" title="Descargar de la nube">
                        {{ HTML::link('files/storageFiles/'.$file, 'Descargar archivo', array(
                                                            'class' => 'linkShow',
                                                            'target' => '_blank',
                                                            'download' => $archivo->clientOriginalNameSan
                                                            )) }}
                        &nbsp;&nbsp;<i class="glyphicon glyphicon-cloud-download"></i>
                      </button>
                    </td>
                    @elseif($extension == 'xml' or $extension == 'XML' or $extension == 'zip' or $extension == 'rar' or $extension == '7z')
                    <td>
                      <button type="submit" class="btn btn-primaryDownload" title="Descargar de la nube">
                        {{ HTML::link('files/storageFiles/'.$file, 'Descargar archivo', array(
                                                            'class' => 'linkShow',
                                                            'target' => '_blank',
                                                            'download' => $archivo->clientOriginalNameSan
                                                            )) }}
                        &nbsp;&nbsp;<i class="glyphicon glyphicon-cloud-download"></i>
                      </button>
                    </td>
                    @elseif($extension == 'pptx' or $extension == 'docx' or $extension == 'xlsx' or $extension == 'ppt' or $extension == 'doc' or $extension == 'xls')
                    <td>
                      <button type="submit" class="btn btn-primaryDownload" title="Descargar de la nube">
                        {{ HTML::link('files/storageFiles/'.$file, 'Descargar archivo', array(
                                                            'class' => 'linkShow',
                                                            'target' => '_blank',
                                                            'download' => $archivo->clientOriginalNameSan
                                                            )) }}
                        &nbsp;&nbsp;<i class="glyphicon glyphicon-cloud-download"></i>
                      </button>
                    </td>
                    @elseif($extension == 'bak' or $extension == 'exe' or $extension == 'iso' or $extension == 'msi')
                    <td>
                      <button type="submit" class="btn btn-primaryDownload" title="Descargar de la nube">
                        {{ HTML::link('files/storageFiles/'.$file, 'Descargar archivo', array(
                                                            'class' => 'linkShow',
                                                            'target' => '_blank',
                                                            'download' => $archivo->clientOriginalNameSan
                                                            )) }}
                        &nbsp;&nbsp;<i class="glyphicon glyphicon-cloud-download"></i>
                      </button>
                    </td>
                  @endif
                @else
                  <td>   
                      <font color="#A33B03" size="2">
                        <strong>No se puede descargar este archivo porque fué eliminado del servidor</strong>
                      </font>
                    </td>
                @endif
                
              </tr>

            </tbody>
        </table>
      </div> 

      <br>
        <br>
          
        <div class="table-responsive"> 
          <table class="table table-bordered table-condensed table-hover">
            <thead>

              <tr style="background-color: #AAD473; color: #000; font-size: 11px;">
                  
                  <th><center>Id Coordinador</center></th>
                  <th><center>Coordinador</center></th>
                  <th><center>Id Cliente</center></th>
                  <th><center>Cliente</center></th>
                  <th><center>Emitio</center></th>

              </tr>

            </thead>

            <tbody style="font-size: 11px;">

              <tr>
                
                  <td><center><strong>{{ $archivo->Id_Coordinador }}</strong></center></td>
                  <td>{{ $archivo->NombreCoordinador() }}</td>
                  <td><center><strong>{{ $archivo->Id_Cliente }}</strong></center></td>
                  <td>{{ $archivo->NombreCliente() }}</td>
                  <td><center>{{ $archivo->userSubmit }}</center></td>

              </tr>
              
            </tbody>

          </table>
        </div>
  </div>
        <center>
          <a href="{{ URL::previous() }}" class="linkShow">
            <i class="glyphicon glyphicon-arrow-left"></i> Ir a la vista anterior 
          </a>
        </center>
  </div><!-- end div panel-default -->

  

  <a href="{{ route('Files.store') }}"  title="Regresar">
      <button type="button" class="btn btn-primaryReturn">
        <span class="glyphicon glyphicon-file" ></span> LISTA DE ARCHIVOS
      </button>
    </a>
    <br>
      <br>
</div><!-- ed div container -->


  

@stop