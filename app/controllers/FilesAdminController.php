<?php
use Carbon\Carbon;
/**
* 
*/
class FilesAdminController extends BaseController
{
	
	// Funcion que muestr la información el el panel de archivos
	public function getEstadisticaFile()
	{	
		$img = Administrador::find(Auth::userAdmin()->get()->id);
    	$imagen = $img->imgperfil; 
    	$date = Carbon::now();
        $dateAct = $date->format('l j F Y h:i:s a');
        $stringUserCLient = 'submitClient';
        $stringUserCoord = 'submitCoord'; 

        $totalFiles = Archivo::all();
        $totalSize = Archivo::sum('clientSize');
		$totalSizeFilesMB = number_format(doubleval($totalSize/1024),3,'.',''); // Conversion del tamaño total Kb a Mg
		$totalSizeFilesGB = number_format(doubleval($totalSize/1024)/1024,3,'.',''); //Conversion del tamaño total de 

        $model = new Archivo;
        $filesOutClients = $model->where('userSubmit','=',$stringUserCLient)->where('state','=',0)->get();
        $totalSizeFileOutClients = $model->where('userSubmit','=',$stringUserCLient)->where('state','=',0)->sum('clientSize');
        $totalSizeFileOutCLientsMB = number_format(doubleval($totalSizeFileOutClients/1024),3,'.','');
        $totalSizeFileOutCLientsGB = number_format(doubleval($totalSizeFileOutClients/1024)/1024,3,'.','');

        $filesOutCoords = $model->where('userSubmit','=',$stringUserCoord)->where('state','=',0)->get();
        $totalSizeFileOutCoords = $model->where('userSubmit','=',$stringUserCoord)->where('state','=',0)->sum('clientSize');
        $totalSizeFileOutCoordsMB = number_format(doubleval($totalSizeFileOutCoords/1024),3,'.','');
        $totalSizeFileOutCoordsGB = number_format(doubleval($totalSizeFileOutCoords/1024)/1024,3,'.','');

        $filesDeletedForUsers = $model->where('state','=',1)->get();
        $totalSizeFileDeletedForUsers = $model->where('state','=',1)->sum('clientSize');
        $totalSizeFileDeletedForUsersMB = number_format(doubleval($totalSizeFileDeletedForUsers/1024),3,'.','');
        $totalSizeFileDeletedForUsersGB = number_format(doubleval($totalSizeFileDeletedForUsers/1024)/1024,3,'.','');



		return View::make('admin.Actividad.panelEstadisticaFiles', array(
							'imagen' => $imagen,
							'dateAct' => $dateAct,
							'totalFiles' => $totalFiles,
							'filesOutCoords' => $filesOutCoords,
							'filesOutClients' => $filesOutClients,
							'filesDeletedForUsers' => $filesDeletedForUsers,
							'totalSizeFilesMB' => $totalSizeFilesMB,
							'totalSizeFilesGB' => $totalSizeFilesGB,
							'totalSizeFileOutCLientsMB' => $totalSizeFileOutCLientsMB,
							'totalSizeFileOutCLientsGB' => $totalSizeFileOutCLientsGB,
							'totalSizeFileOutCoordsMB' => $totalSizeFileOutCoordsMB,
							'totalSizeFileOutCoordsGB' => $totalSizeFileOutCoordsGB,
							'totalSizeFileDeletedForUsersMB' => $totalSizeFileDeletedForUsersMB,
							'totalSizeFileDeletedForUsersGB' => $totalSizeFileDeletedForUsersGB

			));
	}

	
	// Función que muestra la lista de los archivos eliminados por algun usuario ('state' => 1)
	public function getDeletedFilesForUser()
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
      	$imagen = $img->imgperfil;

    	$date = Carbon::now();
        $dateAct = $date->format('l j F Y h:i:s a');
       

        if(isset($_GET['buscar']))
        {
            $model = new Archivo;
            $filesDeletedForUsers = $model->orderBy('updated_at', 'DESC')->where('state','=',1)->where( function($query) 
            {

                $resultado = htmlspecialchars(Input::get('buscar'));

                $query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                ->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                ->orwhere('Id_Coordinador', 'LIKE', '%'.$resultado.'%' )                
                ->orwhere('created_at', 'LIKE', '%'.$resultado.'%')
                ->orwhere('updated_at', 'LIKE', '%'.$resultado.'%');
                
            })->paginate(15);
        }
        else
        { 
          
          $model = new Archivo;
          $filesDeletedForUsers = $model->orderBy('updated_at', 'DESC')->where('state','=',1)->paginate(20);
        } 

        return View::make('admin.Archivos.listaFilesEliminados', array(
        					
        					'dateAct' => $dateAct,
        					'filesDeletedForUsers' => $filesDeletedForUsers,
        					'imagen' => $imagen
        	));
	}

	






	// Funcion que muestra la lista de los archivos enviados por los coordinadores
	public function viewListaEnviadosCoord()
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
      	$imagen = $img->imgperfil;

		if(isset($_GET['buscar']))
        {	
			$stringUserCoord = 'submitCoord'; 
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File', 'DESC')->where('userSubmit','=',$stringUserCoord)->where('state','=',0)->where( function($query){

				$resultado = htmlspecialchars(Input::get('buscar'));

				$query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                ->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                ->orwhere('Id_Coordinador', 'LIKE', '%'.$resultado.'%' )                
                ->orwhere('created_at', 'LIKE', '%'.$resultado.'%');


			})->paginate(20);
		}
		else {

			$stringUserCoord = 'submitCoord'; 
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File', 'DESC')->where('userSubmit','=',$stringUserCoord)->where('state','=',0)->paginate(25);

		}	

		return View::make('admin.Archivos.archivosEnviadosCoord', array('archivos' => $archivos, 'imagen' => $imagen));
	}

	


	// Funcion que muestra la lista de los archivos enviados por los clientes
	public function viewListaEnviadosClient()
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
      	$imagen = $img->imgperfil;

		if(isset($_GET['buscar']))
        {

			$stringUserClient = 'submitClient'; 
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File', 'DESC')->where('userSubmit','=',$stringUserClient)->where('state','=',0)->where(function($query){

				$resultado = htmlspecialchars(Input::get('buscar'));

				$query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                ->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                ->orwhere('Id_Cliente', 'LIKE', '%'.$resultado.'%' )                
                ->orwhere('created_at', 'LIKE', '%'.$resultado.'%')
                ->orwhere('updated_at', 'LIKE', '%'.$resultado.'%');

			})->paginate(20);
		

		} else {

			$stringUserClient = 'submitClient'; 
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File', 'DESC')->where('userSubmit','=',$stringUserClient)->where('state','=',0)->paginate(25);

		}
		
		return View::make('admin.Archivos.archivosEnviadosClient', array('archivos' => $archivos, 'imagen' => $imagen));
	}



	// Funcion que muestra la lista de todos los archivos con estado 0 y 1
	public function index()
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
      	$imagen = $img->imgperfil;

		if(isset($_GET['buscar']))
        {
            $resultado = htmlspecialchars(Input::get('buscar'));
            $archivos = Archivo::orderBy('Id_File','DESC')->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')
                                   
                ->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                ->orwhere('Id_Coordinador', 'LIKE', '%'.$resultado.'%' )
                ->orwhere('userSubmit', 'LIKE', '%'.$resultado.'%' )
                ->orwhere('created_at', 'LIKE', '%'.$resultado.'%')
                ->paginate(30);
        }
        else
        {
			    $archivos = Archivo::orderBy('Id_File', 'DESC')->paginate(30);
		}	

		return View::make('admin.Archivos.consultar', array(
							'archivos' => $archivos,
							'imagen' => $imagen
						));
	}

	
	// funcion que muestra el detalle de un archivo
	public function show($Id_File)
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
      	$imagen = $img->imgperfil;
		
		$archivo = Archivo::find($Id_File);
		$userEnvia = $archivo->userSubmit;
		$envioClienteString = 'submitClient';
		$file = $archivo->nameEncrypt;
		$extension = $archivo->clientOriginalExtension;		

		$tamaño = $archivo->clientSize;
		$totalSizeFilesMB = number_format(doubleval($tamaño/1024),3,'.',''); // Conversion del tamaño total Kb a Mg
		
		// Verificamos si exste el archivo en el servidor para mostrarlo.
		$filePath = public_path().'/files/storageFiles/'.$file;
	

		return View::make('admin.Archivos.detalleFile', array(
							'imagen' => $imagen,
							'archivo' => $archivo,
							'totalSizeFilesMB' => $totalSizeFilesMB,							
							'file' => $file,
							'extension' => $extension,
							'filePath' => $filePath,
							'userEnvia' => $userEnvia,
							'envioClienteString' => $envioClienteString							
						));
	}

	
		
	
	// funcion que muestra una vista previa de las imágenes
	public function imageShow($Id_File)
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
    	$imagen = $img->imgperfil;

		$archivo = Archivo::find($Id_File);
		$fileName = $archivo->nameEncrypt;
		$file = $archivo->nameEncrypt;

		return View::make('admin.Archivos.ImagenShow', array(
									'fileName' => $fileName,
									'archivo' => $archivo, 
									'imagen' => $imagen,
									'file' => $file
									));
	}

	// Función que elimina archivos completamente del servidor y de la base de datos
	public function getDeleteFile($Id_File)
	{
		$archivo = Archivo::find($Id_File);
		$nameEncrypt = $archivo->nameEncrypt;

		if(!is_null($nameEncrypt))
		{
			$filePath = public_path().'/files/storageFiles/'.$nameEncrypt;
			if(file_exists($filePath)) unlink($filePath);

		}

		$deleteFile = $archivo->delete();

		if($deleteFile)
		{

		Session::flash('message', 'Información: ¡ El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] fue eliminado de la Base de Datos !');

			return Redirect::back();//  admin/Files/Store
		} 

		else{

			Session::flash('messageFallo', 'Información: ¡<strong>Error </strong>! - El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] no pudo ser eliminado de la base de datos ');

			return Redirect::back();//  admin/Files/Store

		} 
		
	}






	// FUNCION PARA TRUNCAR TABLA DE ARCHIVOS
	public function truncateTable()
	{
		$files = Archivo::truncate();

		if($files)
		{
			Session::flash('message', 'Información: ¡La tabla de archivos se truncó correctamente');
			return Redirect::back();
		}
		else
		{
			Session::flash('messageFallo', 'Información: ¡La tabla de archivos no se pudo truncar');
			return Redirect::back();
		}
	}

	
	// Función para recuperar cualquier archivo que haya sido eliminado por un usuario pero que muestra mensaje de exito en la lista general de archivos.

	public function getRecoveryFile($Id_File)
	{

		$archivo = Archivo::find($Id_File);
		$model = new Archivo;
		$file = $model->where('Id_File','=',$Id_File);
		$changeState = $file->update(array('state' => 0));

		if($changeState)
		{
			Session::flash('message', ' Información: ¡ El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] se recuperó correctamente !');

			return Redirect::to('admin/Files/Store');
		}

		else{

			Session::flash('messageFallo', 'Información: ¡<strong>Error </strong>! - El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] no pudo ser recuperado ');

			return Redirect::to('admin/Files/Store');

		} 

	}


	// Funcion para recuperar cualquier archivo que haya sido eliminado por un usuario pero muestra mensajes de exito en la lista de  archivos eliminados en el panel de archivos.
	
	public function getRecoveryPanelDelete($Id_File)
	{

		$archivo = Archivo::find($Id_File);
		$model = new Archivo;
		$file = $model->where('Id_File','=',$Id_File);
		$changeState = $file->update(array('state' => 0));

		if($changeState)
		{
			Session::flash('message', ' Información: ¡ El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] se recuperó correctamente !');

			return Redirect::back();//('admin/Files/deletedFiles/forUser'
		}

		else{

			Session::flash('messageFallo', 'Información: ¡<strong>Error </strong>! - El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] no pudo ser recuperado ');

			return Redirect::back();

		} 

	}


	// Funcion para recuperar cualquier archivo que haya sido eliminado por un usuario pero muestra mensajes de exito en la lista de  archivos eliminados en el panel de archivos del coordinador.
	
	public function getRecoveryPanelDeleteCoord($Id_File)
	{

		$archivo = Archivo::find($Id_File);
		$model = new Archivo;
		$file = $model->where('Id_File','=',$Id_File);
		$changeState = $file->update(array('state' => 0));

		if($changeState)
		{
			Session::flash('message', ' Información: ¡ El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] se recuperó correctamente !');

			return Redirect::to('admin/Files/deletedFiles/forUser');
		}

		else{

			Session::flash('messageFallo', 'Información: ¡<strong>Error </strong>! - El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] no pudo ser recuperado ');

			return Redirect::to('admin/Files/deletedFiles/forUser');

		} 

	}


	// Funcion para recuperar cualquier archivo que haya sido eliminado por un usuario pero muestra mensajes de exito en la lista de  archivos eliminados en el panel de archivos del cliente.
	
	public function getRecoveryPanelDeleteClient($Id_File)
	{

		$archivo = Archivo::find($Id_File);
		$model = new Archivo;
		$file = $model->where('Id_File','=',$Id_File);
		$changeState = $file->update(array('state' => 0));

		if($changeState)
		{
			Session::flash('message', ' Información: ¡ El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] se recuperó correctamente !');

			return Redirect::to('admin/Files/deletedFiles/forUser');
		}

		else{

			Session::flash('messageFallo', 'Información: ¡<strong>Error </strong>! - El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] no pudo ser recuperado ');

			return Redirect::to('admin/Files/deletedFiles/forUser');

		} 

	}






	// DELETE FILES BY COORDINADOR (ADMIN PANEL) PRUEBA CAMBIAR ESTADO DE ARCHIVO. PRUEBAA-.............
	public function getDeleteFileSt($Id_File)
	{
		$date = Carbon::now();
        $dateModif = $date->toDateTimeString();
		$archivo = Archivo::find($Id_File);
		$model = new Archivo;
		$file = $model->where('Id_File','=',$Id_File);
		$changeState = $file->update(array('state' => 1, 'updated_at' => $dateModif ));

		if($changeState)
		{
			Session::flash('message', 'Información: ¡ El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] fue eliminado de la Base de Datos !');

			return Redirect::to('admin/Files/Store');
		}

		else{

			Session::flash('messageFallo', 'Información: ¡<strong>Error </strong>! - El archivo [ '. $archivo->clientOriginalName .' ] con el Id [ '. $archivo->Id_File . ' ] no pudo ser eliminado de la base de datos ');

			return Redirect::to('admin/Files/Store');

		} 
	}

}

?>