@extends('Layouts.BaseErrores')

@section('cabecera')



@stop


@section('cuerpo')

<div class="container">
    <div class="alert alert-warning alert-dismissable">
       <center>

        <h4>{{ HTML::image('assets/img/peligro.png', "", array('width' => '225', 'height' => '195')) }}</h4>

            <h3><i class="glyphicon glyphicon-remove-circle"></i> Información...</h3>
                <strong>¡Error de solicitud!</strong> - Debes iniciar sesión primero.
                        
                    <h6><p class="text-primary">Para entrar a la dirección solicitada, primero debes iniciarte en el sistema.</p></h6> 

                    <a href="{{ route('login.LoginClientes') }}">
                       {{ Form::submit('Ir a login', array('class' => 'btn btn-primary')) }}
                    </a>
        </center>
    </div>
</div>
@stop