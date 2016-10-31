@extends('Layouts.BaseLogin')

@section('titulo')
Portal | Login Coordinadores
@endsection

@section('cabecera')

<script type="text/javascript">
           function ver_password() {
                         var input_form = document.FormLoginCoord.password;
 
                         if (document.FormLoginCoord.input_ver.checked) 
                         {
                             input_form.setAttribute("type", "text");
                         }
                         else
                         {
                              input_form.setAttribute("type", "password");
                         }
            }

</script>

@stop


@section('cuerpo')

<div class="container">
     
                @if (Session::has('mensajeLogout'))
                    <br>
                    <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h3><i class="glyphicon glyphicon-ok"></i> Información...</h3>
                        {{ Session::get('mensajeLogout') }}
                    </div>
                    <br>
                 @endif

                 @if (Session::has('mensajeLoginForzado'))
                    <div class="alert alert-dangerRedireccion alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button> 
                    <h3><i class="glyphicon glyphicon-remove-circle"></i> Información...</h3>
                        {{ Session::get('mensajeLoginForzado') }}
                         <h6><p class="text-primary">Para entrar a la dirección solicitada, primero debes iniciarte en el sistema.</p></h6> 
                    </div>
                 @endif   

                 @if (Session::has('mensaje_error'))
                   
                    <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h3><i class="glyphicon glyphicon-warning-sign"></i> Información...</h3>
                        {{ Session::get('mensaje_error') }}
                         <h6><p class="text-primary">Verifica tus datos </p></h6> 
                    </div>
                    <br>
                   @endif

                   @if( $errors->all() )
                    <div class="alert alert-dangerRedireccion alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h3><i class="glyphicon glyphicon-remove-circle"></i> Información...</h3>         
                      @foreach($errors->all() as $error )   
                           {{ $error }}</br>
                      @endforeach
                      <h6><p class="text-primary">Por favor introduce los datos</p></h6> 
                    </div>    
                    <br>                
                   @endif
</div>


<section id="login">
    <div class="container">
    	<div class="row">
    	    <div class="col-xs-12">
        	    <div class="form-wrap">
                  <div class="panel panel-primary" >
                    <div class="panel-heading">
                        <center><i class="glyphicon glyphicon-user"></i> Login
                        </center>
                    </div>
                     <div class="panel-body" >
                     
                <h1>Iniciar sesión con su cuenta de coordinador</h1>
                   
                    {{ Form::open( array('url' => 'login/FrmLoginCoords', 'method' => 'POST', 'id' => 'login-form', 'name' => 'FormLoginCoord', 'role' => 'form'))}}

                        <div class="form-group has-feedback has-feedback-left">
                             {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Nombre de usuario / Username', 'autocomplete'=>'off', 'maxlength' => '15',  Input::old('userNameCliente'))) }}
                             <i class="form-control-feedback glyphicon glyphicon-user"></i> 
                        </div>
                        <div class="form-group has-feedback has-feedback-left">
                            {{ Form::password('password', array('class' => 'form-control', 'maxlength' => '15', 'placeholder' => 'Contraseña / Password',  'autocomplete'=>'off',)) }}
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


<div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <!--<span aria-hidden="true">×</span>-->
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title text-center"><strong>AVISO DE PRIVACIDAD</strong></h5>
            </div>
            <div class="modal-body">

                            <p align="justify">
                                <font size="2">
                                <strong><font color="#005A8A">Ramírez Medellín, S.C.</font></strong>, con domicilio en Francisco Peña No. 245, Col. Jardín, en la ciudad de San Luis Potosí, S.L.P., México, con fundamento legal en lo dispuesto por los artículos 8, 12, 13, 15, 16, 17, 22, 23, 24, 25 y demás aplicables a la Ley Federal de Protección de Datos Personales, así como los de su reglamento, en Posesión de los Particulares, informa que:
                                </font>
                            </p>
                            <p align="justify">
                                <font size="2">
                                <strong>1.</strong> La finalidad de toda información que pase o que tenga acceso <strong>Ramírez Medellín, S.C.</strong>, así como por el Portal de la firma, es de uso exclusivo entre el cliente y el personal con el que está siendo asesorado, todos los archivos son confidenciales, <strong>Ramírez Medellín, S.C.</strong> no tiene ningún interés en divulgar dicha información, el Portal es para facilitar la comunicación entre los mencionados.
                                </font>
                            </p>
                            <p align="justify">
                                <font size="2">
                                <strong>2.</strong> El medio de comunicación es de estricto uso profesional, el Portal es de uso exclusivo entre clientes y personal  que forme parte de <strong>Ramírez Medellín, S.C.</strong>, estos serán los responsables de lo que transfieran mediante el empleo del Portal, ninguna otra persona tendrá acceso a las cuentas personales, ni a los datos de transferencia.
                                </font>
                            </p>
                            <p align="justify">
                                <font size="2">
                                <strong>3.</strong> El usuario podrá ejercer los derechos de acceso, rectificación, cancelación y oposición previstos en la Ley en el momento que considere necesario, de igual manera el usuario tiene derecho al acceso de los datos personales que se tengan en posesión, en tal caso, deberá de dar aviso de forma inmediata al administrador del Portal, para que este haga las operaciones necesarias.
                                </font>
                            </p>   
                            <p align="justify">
                                <font size="2">
                                <strong>4.</strong> En el momento en que ya no se necesite de la cuenta, la persona debe comunicarse con el administrador del Portal para que la cancele, solo éste podría hacerlo por seguridad del Portal. La información alojada durará tres meses a partir del dia que se cargue la misma, después de ese tiempo se eliminará, y no habrá forma de recuperar dicha información.
                                </font>
                            </p>    
                            <p align="justify">
                                <font size="2">
                                <strong>5.</strong> Los usuarios de las cuentas serán los responsables de que la información que se cargue al Portal esté libre de virus, ya que esto podría afectar su funcionamiento y de igual manera poner en riesgo la seguridad de los datos almacenados en el Portal.  
                                </font>
                            </p>
                            <p align="justify">
                                <font size="2">
                                Los datos personales a los que se tenga acceso, son para el uso exclusivo de <strong>Ramírez Medellín, S.C.</strong>, los cuales serán para proveer los servicios que ha solicitado y que sean necesarios para la realización del objeto.
                                </font>
                            </p>  
                            <p align="justify">
                                <font size="2">
                                Le informamos que sus datos personales no serán transferidos, a menos que así lo disponga una ley u obligación contractual, en este caso se le dará aviso expreso de la situación y de los datos que se encuentran en poder de <strong>Ramírez Medellín, S.C.</strong>
                                </font>
                            </p> 
                            <p align="justify">
                                <font size="2">
                                <strong><font color="#005A8A">Ramírez Medellín, S.C.</font></strong> no es responsable del mal uso que le puedan dar a la plataforma, ni alos datos contenidos y que por causas ajenas a este se perdieran o borraran en el momento previsto.
                                </font>
                            </p> 
                            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->



@stop