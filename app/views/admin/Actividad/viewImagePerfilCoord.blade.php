@extends('Layouts.BaseAdmin')

@section('titulo')
Imagen Perfil | {{ $coordinador->Nombre.' '.$coordinador->Apellidos }}
@endsection

@section('cabecera')

@stop


@section('cuerpo')

<div class="container">
	<div class="page-header">
    <h3><span class="glyphicon glyphicon-eye-open"></span> &nbsp;&nbsp;Vista previa -</h3>
    <center>
      <h4><span class="label label-file">{{ $imgperfil }}</span></h4>
    </center>
  </div>

  <center>{{ HTML::image('imagenPERFILcliente/'. $imgperfil, "", array( 'class' => 'img-thumbnail')) }}</center>
  <br>
  

  <a href="{{ URL::previous() }}"  title="Regresar">
      <button type="button" class="btn btn-primaryReturn">
        <span class="glyphicon glyphicon-arrow-left" ></span> Regresar
      </button>
    </a>
    <br>
      <br>
</div><!-- ed div container -->


  

@stop