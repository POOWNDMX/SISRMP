<?php


/**
* 
*/
class LoginController extends BaseController
{

	//establecemos restful a true
       public $restful = true;
 
       //FUNCION QUE VERIFICA SI HAY UNA SESION ACTIVA.
       public function index(){

 	        // Verificamos si hay sesión activa
            if (Auth::userAdmin()->check())
            {
                // Si tenemos sesión activa mostrará la página de inicio
               	return Redirect::to('admin/Actividad');
        	}
                // Si no hay sesión activa mostramos el formulario para logueo
        		return View::make('login.LoginAdmin');
 		}


        /*
      	 public function get_login()
 		{
 
 				//si se ha iniciado sesión no dejamos volver
 				if(Auth::user())
 				{
 					return Redirect::to('admin/Actividad');
 				}
 				    //mostramos la vista views/login/index.blade.php pasando un título
 					return View::make('login.LoginAdmin');
 	
 		} */


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

	      	  	return Redirect::to('login/LoginAdministrador_rmp')->withErrors($validator)->withInput();

			}

			else{

				
				$userdata = array(
 
                'username' => Input::get('username'),
                'password'=> Input::get('password')
 
                ); 
 
			
			if(Auth::userAdmin()->attempt($userdata, true))
            {
				// Si nuestros datos son correctos mostramos la página de inicio----- Input::get('remember' ----
				return Redirect::to('admin/Actividad');
			}

			// Si los datos no son correctos volvemos al login y mostramos un error
			return Redirect::to('login/LoginAdministrador_rmp')->with('mensaje_error', '<strong>¡ Error de autenticación ! </strong> - El usuario o la contraseña no son válidos')->withInput();
			}
	
	   
	
    } 

   

}


?>