<?php

/**
* 
*/
class ActividadController extends BaseController
{
	public $restful = true;	

	
	public function index()
	{

		$totalDepto    = Departamento::all();
		$totalCoord    = Coordinador::all();
		$totalCliente  = Cliente::all();
		$totalRelacion = AsignaCliente::all();
		$totalFiles  = Archivo::all()->count();

		//Sumar la columna clientSize de la tabla files para obtener el tamaño total de todos los archivos.
		$totalSize = Archivo::sum('clientSize');
		$totalSizeFilesMB = number_format(doubleval($totalSize/1024),3,'.',''); // Conversion del tamaño total Kb a Mg
		$totalSizeFilesGB = number_format(doubleval($totalSize/1024)/1024,3,'.',''); //Conversion del tamaño total de Mb a Gb
		

		$img = Administrador::find(Auth::userAdmin()->get()->id);
		$imagen = $img->imgperfil;
		

		return View::make('admin.Actividad.actividad', 

			array(

				'totalDepto' => $totalDepto,
				//'createdDepto' => $createdDepto, 
				//'updatedDepto' => $updatedDepto,
				'totalCoord' => $totalCoord, 
				//'createdCoord' => $createdCoord, 
				//'updatedCoord' => $updatedCoord, 
				'totalCliente' => $totalCliente, 
				//'createdCliente' => $createdCliente, 
				//'updatedCliente' => $updatedCliente, 
				'totalRelacion' => $totalRelacion,
				'totalFiles' => $totalFiles,
				'totalSizeFilesMB' => $totalSizeFilesMB,
				'totalSizeFilesGB' => $totalSizeFilesGB, 
				'imagen' => $imagen 
				//'adminCreated' => $adminCreated, 
				//'adminUpdated' => $adminUpdated
				  )
			);
		
		
	}

	public function get_logout()
    {
 
   		Auth::userAdmin()->logout();

   		return Redirect::to('login/LoginAdministrador_rmp')->with('mensajeLogout',' ¡Tu <strong>sesión</strong> de portal en línea ha finalizado !');
 
    }
}

?>