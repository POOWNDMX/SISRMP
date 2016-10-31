<?php


/**
* 
*/
class LoginClienteController extends BaseController
{

	//establecemos restful a true
       public $restful = true;
 
       //FUNCION QUE VERIFICA SI HAY UNA SESION ACTIVA.
       public function index(){

 	        // Verificamos si hay sesión activa
            if (Auth::userCliente()->check())
            {
                // Si tenemos sesión activa mostrará la página de inicio
               	return Redirect::to('cliente/receivedFiles/view');
        	}
                // Si no hay sesión activa mostramos el formulario para logueo
        		return View::make('login.LoginClientes');
 		}



		public function post_login()
		{
		    
		  $reglas = array(

        'username'  => 'required',
        'password'  => 'required'
            
      ); 

      $mensajes = array(
            
        'username.required' => '<strong>¡ Error ! </strong> - El campo <strong>Nombre de usuario / Username</strong> es obligatorio.',

        'password.required' => '<strong>¡ Error ! </strong> - El campo <strong>Contraseña / Password</strong> es obligatorio.'

      );

      $validator = Validator::make(Input::all(), $reglas, $mensajes); 

	    	if ($validator->fails()) {

	      	return Redirect::to('login/Login_Clientes')->withErrors($validator)->withInput();

			  }

			  else{
				
				  $userdata = array(
 
            'username' => Input::get('username'),
            'password'=> Input::get('password')
 
          ); 
 
			

			    if(Auth::userCliente()->attempt($userdata, true))
          {
				    // Si nuestros datos son correctos mostramos la página de inicio----- Input::get('remember' ----
				   return Redirect::to('cliente/receivedFiles/view');
			    }

			    // Si los datos no son correctos volvemos al login y mostramos un error
			    return Redirect::to('login/Login_Clientes')->with('mensaje_error', '<strong>¡ Error de autenticación ! </strong> - El usuario o la contraseña no son válidos')->withInput();
			  }
	
    } 


    public function get_logout()
    {
 
        Auth::userCliente()->logout();

        return Redirect::to('login/Login_Clientes')->with('mensajeLogout',' ¡Tu <strong>sesión</strong> de portal en línea ha finalizado !');
 
    }

   

}


?>