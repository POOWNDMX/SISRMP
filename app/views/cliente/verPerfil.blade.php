@extends('Layouts.BaseCliente')

@section('titulo')
 {{ Auth::userCliente()->get()->NombreEmpresa }} | Perfil
@endsection

@section('cabecera')

@stop


@section('cuerpo')

    @section('li-userProfile')
        class="active"
    @endsection

	@section('tituloPanel')
		Configuración general de la cuenta
	@endsection

<div class="content"><!-- div content (general) -->
    <div class="container-fluid"><!-- div container-fluid -->
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;&nbsp;&nbsp;</button>
                        <i class="glyphicon glyphicon-ok"></i>{{ Session::get('message') }}
                    </div>
                @endif
        <div class="row"><!-- div row (general) -->
            <div class="col-lg-4 col-md-5"><!-- div col-lg-4 col-md-5 -->
                <div class="card card-user"><!-- div card card-user -->
                    <div class="image">
                        {{ HTML::image('assetsC/img/backgrounds.jpg') }} 
                    </div>
                    
                    <div class="content"><!-- div content (1) -->
                        <div class="author">
                            @if(!empty($imagenPerfil))
                                <a href="">{{ HTML::image('imagenPERFILcliente/'.$imagenPerfil, "", array('class' => 'avatar border-gray')) }}</a> 
                            @else
                                {{ HTML::image('assetsC/img/user.png', "", array('class' => 'avatar border-gray' )) }}
                            @endif
                                  
                            <h4 class="title">
                                    {{ Auth::userCliente()->get()->NombreEmpresa }}<br>
                                    <small>{{ Auth::userCliente()->get()->RFC }}</small><br>
                                    <small>
                                        <font color="#000">
                                        {{ Auth::userCliente()->get()->NombreContacto.' '.Auth::userCliente()->get()->ApellidosContacto }}
                                        </font>
                                    </small><br>
                                    <small>
                                        <font color="#9BCAD2">{{ Auth::userCliente()->get()->DomicilioFiscal }}</font>
                                    </small>
                            </h4>
                        </div>
                    </div><!-- end div content (1) -->
                        <hr>
                    <div class="text-center"><!-- div text-center -->
                        <div class="row">
                            <div class="col-md-2 col-md-offset-1">
                                
                            </div>
                            <div class="col-md-6">
                                <h5>{{ $totalFiles }}<br /><small>Archivos en total</small></h5>
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                        </div>
                    </div><!-- end div text-center -->
                </div><!--end div card card-user -->
                    <div class="text-center">
                        <a href="{{ route('deleteMyImagePerfil.cliente') }}"> 
                            {{ Form::submit('Quitar imágen del perfil', array('class' => 'btn btn-danger btn-fill btn-wdy')) }}
                        </a>
                    </div>
            </div><!-- end div col-lg-4 col-md-5 -->

            <div class="col-lg-8 col-md-7"><!-- div col-lg-8 col-md-7 -->
                <div class="card"><!-- div card -->
                    <div class="header">
                        <h4 class="title">Configuración general de la cuenta</h4>
                    </div>
                    <div class="content"><!-- div content (3) -->

                        <!-- FORM FOR EDIT AUTH::USERCOORD -->
                        {{ Form::model($cliente,['method' => 'PUT', 'route' => 'ClienteAuth.update', 'files' => true])}}
                            
                            <div class="row"><!-- div row (1)-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                    {{ Form::label('', 'Empresa') }}
                                    {{ Form::text('', $cliente->NombreEmpresa, array('class' => 'form-control border-input', 'disabled' => 'disabled')) }}
                                    
                                    </div>
                                </div>
                            </div><!-- end div row (1)-->
                            
                            <div class="row"><!-- div row (2) -->
                                <div class="col-md-6"><!-- div col-md-6-->
                                    <div class="form-group">
                                    {{ Form::label('', 'Usuario') }}
                                    {{ Form::text('username', null, array('class' => 'form-control border-input', 'disabled' => 'disabled')) }}
                                    

                                    </div>
                                </div><!-- end div col-md-6  -->
                            </div><!-- end div row (1) -->


                            <div class="row"><!-- div row (2) -->
                                <div class="col-md-6"><!-- dov col-md-6 -->
                                    <div class="form-group">
                                    {{ Form::label('', 'Nombre del contacto') }}
                                    {{ Form::text('NombreContacto', null, array('class' => 'form-control border-input', 'disabled' => 'disabled')) }}

                                    </div>
                                </div><!-- end div col-md-6 -->
                            
                                <div class="col-md-6"><!-- div col-md-6  -->
                                    <div class="form-group">
                                    {{ Form::label('', 'Apellidos del contacto') }}
                                    {{ Form::text('ApellidosContacto', null, array('class' => 'form-control border-input', 'disabled' => 'disabled')) }}


                                    
                                    </div>
                                </div><!-- end div col-md-6 -->
                            </div><!-- end div row (2) -->

                            <div class="row"><!-- div row (4) -->
                                <div class="col-md-12"><!-- div col-md-12 -->
                                    <div class="form-group">
                                    {{ Form::label('', 'Incluir una nueva imágen de perfil:') }}
              
                                    <input id="imgperfil" name="imgperfil" type="file" class="file" data-preview-file-type="any" multiple>

                                    </div>
                                </div><!-- end div col-md-12 -->
                            </div><!-- end div row (4) -->
                            
                            <div class="text-center">
                                {{ Form::submit('Actualizar Perfil', array('class' => 'btn btn-info btn-fill btn-wdy')) }}
                            </div>
                            
                            <div class="clearfix"></div>

                        {{ Form::close() }}<!-- end form for edit AUTH::USERCOORD -->
                            

                    </div><!-- end div content (3) -->
                 </div><!-- end div card -->
            </div><!-- end col-lg-7 col-md-7 -->


        </div><!-- end div row (general) -->  
    </div><!-- end div container-fluid -->
</div><!-- end div content (general) -->



@stop


