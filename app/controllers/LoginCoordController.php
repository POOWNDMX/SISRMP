<?php


/**
* 
*/
class LoginCoordController extends BaseController
{

	//establecemos restful a true
       public $restful = true;
 
       //FUNCION QUE VERIFICA SI HAY UNA SESION ACTIVA.
       public function index(){

 	        // Verificamos si hay sesión activa
            if (Auth::userCoord()->check())
            {
                // Si tenemos sesión activa mostrará la página de inicio
               	return Redirect::to('coordinador/ReceivedFiles/view');
        	}
                // Si no hay sesión activa mostramos el formulario para logueo
        		return View::make('login.LoginCoordinadores');
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

	      	  	return Redirect::to('login/Login_Coordinadores')->withErrors($validator)->withInput();

			}

			else{

				
				$userdata = array(
 
                'username' => Input::get('username'),
                'password'=> Input::get('password')
 
                ); 
 
			

			if(Auth::userCoord()->attempt($userdata, true))
      {
				// Si nuestros datos son correctos mostramos la página de inicio----- Input::get('remember' ----
				return Redirect::to('coordinador/ReceivedFiles/view');
			}

			  // Si los datos no son correctos volvemos al login y mostramos un error
			  return Redirect::to('login/Login_Coordinadores')->with('mensaje_error', '<strong>¡ Error de autenticación ! </strong> - El usuario o la contraseña no son válidos')->withInput();
			}
	
     
	
    } 

    public function get_logout()
    {
 
        Auth::userCoord()->logout();

        return Redirect::to('login/Login_Coordinadores')->with('mensajeLogout',' ¡Tu <strong>sesión</strong> de portal en línea ha finalizado !');
 
    }

   

}


?>