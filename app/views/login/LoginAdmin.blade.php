@extends('Layouts.BaseLoginAdmin')

@section('titulo')
Portal | Login Admin
@endsection


@section('cabecera')

<script type="text/javascript">
  function ver_password() {
    var input_form = document.FormLoginAdmin.password;
 
      if (document.FormLoginAdmin.input_ver.checked) 
      {
        input_form.setAttribute("type", "text");
      }
      else
      {
        input_form.setAttribute("type", "password");
      }
  }       //'id' => 'login-form'
</script> 

@stop

@section('cuerpo')

<div class="container">
    
    <!-- Mensaje de éxito al salir de la aplicacion --> 
    @if (Session::has('mensajeLogout'))
      <br>
      <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h3><i class="glyphicon glyphicon-ok"></i> Información...</h3>
        {{ Session::get('mensajeLogout') }}
      </div>
    @endif

    <!-- // -->
    @if (Session::has('mensajeLoginForzado'))
      <br>
      <div class="alert alert-dangerRedireccion alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button> 
        <h3><i class="glyphicon glyphicon-remove-circle"></i> Información...</h3>
        {{ Session::get('mensajeLoginForzado') }}
        <h6><p class="text-primary">Para entrar a la dirección solicitada, primero debes iniciarte en el sistema.</p></h6> 
      </div>
    @endif   

    <!-- Mensaje de error de autenticacion -->
    @if (Session::has('mensaje_error'))
      <br>
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <h3><i class="glyphicon glyphicon-warning-sign"></i> Información...</h3>
          {{ Session::get('mensaje_error') }}
          <h6><p class="text-primary">Verifica tus datos </p></h6> 
        </div>
      @endif

      <!-- Mensaje error de validacion en los campos -->
      @if( $errors->all() )   
        <br>
        <div class="alert alert-dangerRedireccion alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <h3><i class="glyphicon glyphicon-remove-circle"></i> Información...</h3>         
            @foreach($errors->all() as $error )   
              {{ $error }}</br>
            @endforeach
          <h6><p class="text-primary">Por favor introduce los datos</p></h6> 
        </div>                      
      @endif

</div><!-- end div container-->

 <section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                  <br>
                <div class="panel panel-success " >
                    <div class="panel-heading">
                        <center><span class="glyphicon glyphicon-user" ></span> Login Administrador</center>
                    </div>

                     <div class="panel-body" >

                             
                                             

                                             
                   
                      {{ Form::open( array('url' => 'login/FrmLoginAdmin', 'method' => 'POST', 'name' => 'FormLoginAdmin', 'role' => 'form'))}}   

                        <div class="form-group has-feedback has-feedback-left">
                             {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Nombre de usuario / Username', 'maxlength' => '20', 'autocomplete'=>'off',  Input::old('userNameCliente'))) }}
                             <i class="form-control-feedback glyphicon glyphicon-user"></i> 
                        </div>
                        <div class="form-group has-feedback has-feedback-left">
                            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña / Password', 'maxlength' => '20')) }}
                             <i class="form-control-feedback glyphicon glyphicon-lock"></i> 
                        </div>
                         <label>
                          <div class="checkbox">
                              <input type="checkbox" class="character-checkbox" name="input_ver" value="ver" onclick="ver_password();">
                              <span class="label">Mostrar password</span>
                          </div>
                        </label>
                      
                        {{ Form::submit('Entrar', array('class' => 'btn btn-custom btn-sm btn-block')) }}
                       
                    {{ Form::close() }}


                    
                    <hr>
                       </div>  <!-- /.panel-body-->
                    </div>  <!-- /.panel-info -->
                </div> <!-- /.form-wrap -->
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>






@stop