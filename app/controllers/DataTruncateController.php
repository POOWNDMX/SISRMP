<?php
use Carbon\Carbon;
/**
* 
*/
class DataTruncateController extends BaseController
{

	// Funcion index
	public function login()
	{
		$administrador = Administrador::find(Auth::userAdmin()->get()->id);
		$array = array('administrador' => $administrador );

		return View::make('admin.Administrador.loginTruncate', $array);
	}


	public function frmLogin()
	{
		$administrador = Administrador::find(Auth::userAdmin()->get()->id);
      	$password = $administrador->password;

      	$reglas = array(
        	'passwordAct' => 'required',
        );

      	$mensajes = array(

          'passwordAct.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> Debes escribir la <strong>contraseña</strong> actual</div>',

        );

      	$validator = Validator::make(Input::all(), $reglas, $mensajes); 

        // Procesa el validador
        if ($validator->fails()) {
          // Si falla el validador retorna a la misma vista con los posibles errores de validacion. to('admin/login/truncate')
          return Redirect::back()->withErrors($validator)->withInput();
                   
        } 
        else {

          #$passwordAct = Hash::check(Input::get('passwordAct'), Auth::user()->password );
          $passwordAct = Input::get('passwordAct');

          	if (Hash::check($passwordAct, $password)) {
                   
            	return Redirect::to('admin/index/truncate');

          	}

          	else{ 

          		return Redirect::back()->with('messageWarningPasswd', '<strong> ¡ Error ! </strong> - La contraseña actual no es correcta ');                
          }
        }
    }



	public function index()
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
      	$imagen = $img->imgperfil;

		$departamentos = Departamento::count();
		$coordinadores = Coordinador::count();
		$clientes = Cliente::count();
		$relaciones = AsignaCliente::count();
		$archivos = Archivo::count();

		$path = public_path().'/files/storageFiles';
		$totalFilesServer = count(glob($path."/*.*", GLOB_BRACE));

		$path = public_path().'/imagenPERFILcliente';
		$totalImagePerfilClient = count(glob($path."/*.*", GLOB_BRACE));

		$path = public_path().'/imagenPERFILcoord';
		$totalImagePerfilCoord = count(glob($path."/*.*", GLOB_BRACE));

		$path = public_path().'/imagenPERFIL';
		$totalImagePerfilAdmin = count(glob($path."/*.*", GLOB_BRACE));

		$array = array('departamentos' => $departamentos, 'coordinadores' => $coordinadores, 'clientes' => $clientes, 'relaciones' => $relaciones, 'archivos' => $archivos, 'totalFilesServer' => $totalFilesServer, 'totalImagePerfilClient' => $totalImagePerfilClient, 'totalImagePerfilCoord' => $totalImagePerfilCoord, 'totalImagePerfilAdmin' => $totalImagePerfilAdmin, 'imagen' => $imagen);

		return View::make('admin.Administrador.truncateData', $array);
	}



	// FUNCION PARA TRUNCAR TABLA DE ARCHIVOS
	public function truncateTableFiles()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$files = Archivo::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		if($files)
		{
			Session::flash('message', 'Información: ¡La tabla de archivos se vació y se puso a 0 correctamente');
			return Redirect::back();
		}
		else
		{
			Session::flash('messageFallo', 'Información: ¡La tabla de archivos no se pudo vaciar y poner a 0');
			return Redirect::back();
		}
	}

	// FUNCION PARA TRUNCAR TABLA DE DEPARTAMENTOS
	public function truncateTableDepto()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$departamentos = Departamento::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		if($departamentos)
		{
			Session::flash('message', 'Información: ¡La tabla de departamentos se vació y se puso a 0 correctamente');
			return Redirect::back();
		}
		else
		{
			Session::flash('messageFallo', 'Información: ¡La tabla de departamentos no se pudo vaciar ni poner a 0');
			return Redirect::back();
		}
	}

	// FUNCION PARA TRUNCAR TABLA DE COORDINADORES
	public function truncateTableCoord()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$coordinadores = Coordinador::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		if($coordinadores)
		{
			Session::flash('message', 'Información: ¡La tabla de coordinadores se vació y se puso a 0 correctamente');
			return Redirect::back();
		}
		else
		{
			Session::flash('messageFallo', 'Información: ¡La tabla de coordinadores no se pudo vaciar ni poner a 0');
			return Redirect::back();
		}
	}

	// FUNCION PARA TRUNCAR TABLA DE CLIENTES
	public function truncateTableClient()
	{
		
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$clientes = Cliente::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		if($clientes)
		{
			Session::flash('message', 'Información: ¡La tabla de clientes se vació y se puso a 0 correctamente');
			return Redirect::back();
		}
		else
		{
			Session::flash('messageFallo', 'Información: ¡La tabla de clientes no se pudo vaciar ni poner a 0');
			return Redirect::back();
		}
	}

	// FUNCION PARA TRUNCAR TABLA DE RELACIONES
	public function truncateTableRelation()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$relaciones = AsignaCliente::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		if($relaciones)
		{
			Session::flash('message', 'Información: ¡La tabla de relaciones se vació y se puso a 0 correctamente');
			return Redirect::back();
		}
		else
		{
			Session::flash('messageFallo', 'Información: ¡La tabla de relaciones no se pudo vaciar ni poner a 0');
			return Redirect::back();
		}
	}


	// FUNCION PARA ELIMINAR ARCHIVOS DEL SERVIDOR
	public function deleteFilesServer()
	{
		$path = public_path().'/files/storageFiles';

		foreach(glob($path."/*.*") as $archivos_carpeta)  
		{  
 			unlink($archivos_carpeta);     // Eliminamos todos los archivos de la carpeta hasta dejarla vacia  

 		}

 		Session::flash('message', 'Información: ¡La carpeta contenedora de archivos en el servidor se vació correctamente');
			return Redirect::back();  
	}


	// FUNCION PARA ELIMINAR IMAGENES DE PERFIL CLIENTE
	public function deleteImageClienteServer()
	{
		$path = public_path().'/imagenPERFILcliente';

		foreach(glob($path."/*.*") as $archivos_carpeta)  
		{  
 			unlink($archivos_carpeta);     // Eliminamos todos los archivos de la carpeta hasta dejarla vacia  

 		}

 		Session::flash('message', 'Información: ¡La carpeta contenedora de imágenes de perfil cliente en el servidor se vació correctamente');
			return Redirect::back();  
	}


	// FUNCION PARA ELIMINAR IMAGENES DE PERFIL COOORDINADOR
	public function deleteImageCoordServer()
	{
		$path = public_path().'/imagenPERFILcoord';

		foreach(glob($path."/*.*") as $archivos_carpeta)  
		{  
 			unlink($archivos_carpeta);     // Eliminamos todos los archivos de la carpeta hasta dejarla vacia  

 		}

 		Session::flash('message', 'Información: ¡La carpeta contenedora de imágenes de perfil coordinador en el servidor se vació correctamente');
			return Redirect::back();  
	}


	// FUNCION PARA ELIMINAR IMAGENES DE PERFIL COOORDINADOR
	public function deleteImageAdminServer()
	{
		$path = public_path().'/imagenPERFIL';

		foreach(glob($path."/*.*") as $archivos_carpeta)  
		{  
 			unlink($archivos_carpeta);     // Eliminamos todos los archivos de la carpeta hasta dejarla vacia  

 		}

 		Session::flash('message', 'Información: ¡La carpeta contenedora de imágenes de perfil administrador en el servidor se vació correctamente');
			return Redirect::back();  
	}


	


}

?>