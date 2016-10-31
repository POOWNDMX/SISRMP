<?php
use Carbon\Carbon;
/**
* 
*/
class ReportsController extends BaseController
{

	
	
	public function viewReports()
	{
		$autenticado = Administrador::find(auth::userAdmin()->get()->id);
		$imagen = $autenticado->imgperfil;

		return View::make('admin.Actividad.reports', array('imagen' => $imagen));
	}



	// FUNCIONES PARA REPORTES DE ESTADISTICA DE LA TABLA ARCHIVOS ((((((( REPORTE 1 )))))))
	// VER
	public function viewReportEstatusTableFile()
	{
		//Obtenemos la fecha actual para todos los reportes.
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 

     	$totalFiles  = Archivo::all()->count();//Total de registros en la tabla de archivos
     	//Sumar la columna clientSize de la tabla files para obtener el tamaño total de todos los archivos.
		$totalSize = Archivo::sum('clientSize');
		$totalSizeFilesMB = number_format(doubleval($totalSize/1024),3,'.',''); // Conversion del tamaño total Kb a Mg
		$totalSizeFilesGB = number_format(doubleval($totalSize/1024)/1024,3,'.',''); //Conversion del tamaño total de Mb a Gb

		$stringUserClient = 'submitClient';
		$stringUserCoord = 'submitCoord';
 		$stateActive = 0;
 		$stateInactive = 1;
		$model = new Archivo;

		//SUMAMOS BANDEJA DE SALIDA CLIENTES
		$totalFilesEnviaClients = $model->where('userSubmit','=',$stringUserClient)
											->where('state','=',$stateActive)->count()
											; 
		$totalSizeFilesEnviaClients = $model->where('userSubmit','=',$stringUserClient)
											->where('state','=',$stateActive)->sum('clientSize'); 

		$totalSizeFilesEnviaClientsMB = number_format(doubleval($totalSizeFilesEnviaClients/1024),3,'.',''); 
		$totalSizeFilesEnviaClientsGB = number_format(doubleval($totalSizeFilesEnviaClients/1024)/1024,3,'.','');


		//SUMAMOS BANDEJA DE SALIDA COORDINADORES
		$totalFilesEnviaCoords = $model->where('userSubmit','=',$stringUserCoord)
											->where('state','=',$stateActive)->count(); 

		$totalSizeFilesEnviaCoords = $model->where('userSubmit','=',$stringUserCoord)
											->where('state','=',$stateActive)->sum('clientSize'); 

		$totalSizeFilesEnviaCoordsMB = number_format(doubleval($totalSizeFilesEnviaCoords/1024),3,'.',''); 
		$totalSizeFilesEnviaCoordsGB = number_format(doubleval($totalSizeFilesEnviaCoords/1024)/1024,3,'.','');

		//SUMAMOS ARCHIVOS ELIMINADOS POR ALGUN USUARIO
		$totalFilesDeletedForUsers = $model->where('state','=',$stateInactive)->count();
		$totalSizeFilesDeletedForUsers = $model->where('state','=',$stateInactive)->sum('clientSize'); 

		$totalSizeFilesDeletedForUsersMB = number_format(doubleval($totalSizeFilesDeletedForUsers/1024),3,'.',''); 
		$totalSizeFilesDeletedForUsersGB = number_format(doubleval($totalSizeFilesDeletedForUsers/1024)/1024,3,'.','');

		
		// SUMAMOS ARCHIVOS ELIMINADOS (ENVIADOS POR COORDINADORES)
		$totalFilesDeletedEnviaCoords = $model->where('userSubmit','=',$stringUserCoord)
											  ->where('state','=',$stateInactive)->count();

		$totalSizeFilesDeletedEnviaCoords = $model->where('userSubmit','=',$stringUserCoord)
											  ->where('state','=',$stateInactive)->sum('clientSize');	

		$totalSizeFilesDeletedEnviaCoordsMB = number_format(doubleval($totalSizeFilesDeletedEnviaCoords/1024),3,'.',''); 
		$totalSizeFilesDeletedEnviaCoordsGB = number_format(
											  doubleval($totalSizeFilesDeletedEnviaCoords/1024)/1024,3,'.','');


		// SUMAMOS ARCHIVOS ELIMINADOS (ENVIADOS POR CLIENTES)
		$totalFilesDeletedEnviaClients = $model->where('userSubmit','=',$stringUserClient)
											  ->where('state','=',$stateInactive)->count();

		$totalSizeFilesDeletedEnviaClients = $model->where('userSubmit','=',$stringUserClient)
											  ->where('state','=',$stateInactive)->sum('clientSize');	

		$totalSizeFilesDeletedEnviaClientsMB = number_format(doubleval($totalSizeFilesDeletedEnviaClients/1024),3,'.',''); 
		$totalSizeFilesDeletedEnviaClientsGB = number_format(
											  doubleval($totalSizeFilesDeletedEnviaClients/1024)/1024,3,'.','');
										  



		$estadisticaFiles = PDF::loadView('admin.Reportes.estadisticaFiles', array(
							'dateAct' => $dateAct,
							'totalFiles' => $totalFiles,
							'totalSizeFilesMB' => $totalSizeFilesMB,
							'totalSizeFilesGB' => $totalSizeFilesGB,
							'totalFilesEnviaClients' => $totalFilesEnviaClients,
							'totalSizeFilesEnviaClientsMB' => $totalSizeFilesEnviaClientsMB,
							'totalSizeFilesEnviaClientsGB' => $totalSizeFilesEnviaClientsGB,
							'totalFilesEnviaCoords' => $totalFilesEnviaCoords,
							'totalSizeFilesEnviaCoordsMB' => $totalSizeFilesEnviaCoordsMB,
							'totalSizeFilesEnviaCoordsGB' => $totalSizeFilesEnviaCoordsGB,
							'totalFilesDeletedForUsers' => $totalFilesDeletedForUsers,
							'totalSizeFilesDeletedForUsersMB' => $totalSizeFilesDeletedForUsersMB,
							'totalSizeFilesDeletedForUsersGB' => $totalSizeFilesDeletedForUsersGB,
							'totalFilesDeletedEnviaCoords' => $totalFilesDeletedEnviaCoords,
							'totalSizeFilesDeletedEnviaCoordsMB' => $totalSizeFilesDeletedEnviaCoordsMB,
							'totalSizeFilesDeletedEnviaCoordsGB' => $totalSizeFilesDeletedEnviaCoordsGB,
							'totalFilesDeletedEnviaClients' => $totalFilesDeletedEnviaClients,
							'totalSizeFilesDeletedEnviaClientsMB' => $totalSizeFilesDeletedEnviaClientsMB,
							'totalSizeFilesDeletedEnviaClientsGB' => $totalSizeFilesDeletedEnviaClientsGB


							))->setPaper('A4');

		return $estadisticaFiles->stream();
	}

	// DESCARGAR
	public function downloadReportEstadFile()
	{
		//Obtenemos la fecha actual para todos los reportes.
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 

     	$totalFiles  = Archivo::all()->count();//Total de registros en la tabla de archivos
     	//Sumar la columna clientSize de la tabla files para obtener el tamaño total de todos los archivos.
		$totalSize = Archivo::sum('clientSize');
		$totalSizeFilesMB = number_format(doubleval($totalSize/1024),3,'.',''); // Conversion del tamaño total Kb a Mg
		$totalSizeFilesGB = number_format(doubleval($totalSize/1024)/1024,3,'.',''); //Conversion del tamaño total de Mb a Gb

		$estadisticaFiles = PDF::loadView('admin.Reportes.estadisticaFiles', array(
							'dateAct' => $dateAct,
							'totalFiles' => $totalFiles,
							'totalSizeFilesMB' => $totalSizeFilesMB,
							'totalSizeFilesGB' => $totalSizeFilesGB

							))->setPaper('A4');
		return $estadisticaFiles->download('SISRMP_Estadisticas_Tabla_Archivos.pdf');
	}

	// FUNCIONES PARA REPORTES DE LISTADO DE ARCHIVOS ENVIADO POR CLIENTES ((((((((( REPORTE 2 )))))))))
	// VER
	public function viewReportlistFilesEnviaCliente()
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$stringUserClient = 'submitClient';
		$model = new Archivo;
		$archivos = $model->where('userSubmit','=',$stringUserClient)->where('state','=',0)->get();
		$listaFiles = PDF::loadView('admin.Reportes.listaArchivosEnviadosCliente', array(
							'archivos' => $archivos,
							'dateAct' => $dateAct
						
						))->setPaper('A4');

		return $listaFiles->stream();

	}

	// DESCARGAR
	public function downloadReportlistFilesEnviaCliente()
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$stringUserClient = 'submitClient';
		$model = new Archivo;
		$archivos = $model->where('userSubmit','=',$stringUserClient)->where('state','=',0)->get();
		$listaFiles = PDF::loadView('admin.Reportes.listaArchivosEnviadosCliente', array(
							'archivos' => $archivos,
							'dateAct' => $dateAct
						
						))->setPaper('A4');

		return $listaFiles->download('SISRMP_Lista_Archivos_Enviados_Por-Clientes.pdf');

	}







	// FUNCIONES PARA REPORTES DE LISTADO DE ARCHIVOS ENVIADO POR COORDINADORES ((((((((( REPORTE 3 )))))))))
	// VER
	public function viewReportlistFilesEnviaCoord()
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$stringUserCoord = 'submitCoord';
		$model = new Archivo;
		$archivos = $model->where('userSubmit','=',$stringUserCoord)->where('state','=',0)->get();
		$listaFiles = PDF::loadView('admin.Reportes.listaArchivosEnviadosCoord', array(
							'archivos' => $archivos,
							'dateAct' => $dateAct
						
						))->setPaper('A4');

		return $listaFiles->stream();

	}

	// DESCARGAR
	public function downloadReportlistFilesEnviaCoord()
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$stringUserCoord = 'submitCoord';
		$model = new Archivo;
		$archivos = $model->where('userSubmit','=',$stringUserCoord)->where('state','=',0)->get();
		$listaFiles = PDF::loadView('admin.Reportes.listaArchivosEnviadosCoord', array(
							'archivos' => $archivos,
							'dateAct' => $dateAct
						
						))->setPaper('A4');

		return $listaFiles->download('SISRMP_Lista_Archivos_Enviados_Por-Coordinadores.pdf');

	}






	// FUNCIONES PARA REPORTES DE LISTADO DE ARCHIVOS ENVIADO POR COORDINADORES ((((((((( REPORTE 4 )))))))))
	// VER
	public function viewReportlistFilesDeletedForUsers()
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$state = 1;
		$model = new Archivo;
		$archivos = $model->where('state','=',$state)->get();
		$listaFiles = PDF::loadView('admin.Reportes.listaArchivosEliminadosUser', array(
							'archivos' => $archivos,
							'dateAct' => $dateAct
						
						))->setPaper('A4');

		return $listaFiles->stream();

	}

	// DESCARGAR
	public function downloadReportlistFilesDeletedForUsers()
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		
		$state = 1;
		$model = new Archivo;
		$archivos = $model->where('state','=',$state)->get();
		$listaFiles = PDF::loadView('admin.Reportes.listaArchivosEliminadosUser', array(
							'archivos' => $archivos,
							'dateAct' => $dateAct
						
						))->setPaper('A4');

		return $listaFiles->download('SISRMP_Lista_Archivos_Eliminados_Por-Usuarios.pdf');

	}






	// FUNCIONES PARA REPORTES DE LISTADO DE ARCHIVOS EXISTENTES (((((((((( REPORTE 5 ))))))))))
	// VER
	public function viewReportListFile()
	{
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$archivos = Archivo::orderby('created_at', 'desc')->get();
     	$listaFiles = PDF::loadView('admin.Reportes.listaFiles', array(
     						'archivos' => $archivos,
     						'dateAct' => $dateAct

     					 ))->setPaper('A4');

     	return $listaFiles->stream();

	}
	
	// DESCARGAR
	public function downloadReportListFile()
	{
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$archivos = Archivo::orderby('created_at', 'desc')->get();
     	$listaFiles = PDF::loadView('admin.Reportes.listaFiles', array(
     						'archivos' => $archivos,
     						'dateAct' => $dateAct

     					 ))->setPaper('A4');

     	return $listaFiles->download('SISRMP_Lista_Archivos.pdf');
	}


	// FUNCIONES PARA REPORTES DE LISTADO DE ARCHIVOS POR NOMBRE ORIGINL Y ENCRIPTADO ((((((( REPORTE 6 )))))))
	// VER
	public function viewReportListFileNameOrg()
	{
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$archivos = Archivo::orderby('created_at', 'desc')->get();
     	$listaFiles = PDF::loadView('admin.Reportes.listaFilesNameOrgEncrip', array(
     						'archivos' => $archivos,
     						'dateAct' => $dateAct

     					 ))->setPaper('A4');

     	return $listaFiles->stream();

	}
	
	// DESCARGAR
	public function downloadReportListFileNameOrg()
	{
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$archivos = Archivo::orderby('created_at', 'desc')->get();
     	$listaFiles = PDF::loadView('admin.Reportes.listaFilesNameOrgEncrip', array(
     						'archivos' => $archivos,
     						'dateAct' => $dateAct

     					 ))->setPaper('A4');

     	return $listaFiles->download('SISRMP_Lista_Archivos_NameOrg-NameEncryp.pdf');
	}





	// FUNCIONES PARA REPORTES DE CARTELERA DE CLIENTES CON SU INFORMACION (((((( REPORTE 7 ))))))
	// VER
	public function viewReportListClient()
	{
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
		$clientes = Cliente::orderby('created_at', 'desc')->get();		
		$listaClientes = PDF::loadView('admin.Reportes.listaClientes', array(
							'clientes' => $clientes,
							'dateAct' => $dateAct
								
							))->setPaper('A4');

		return $listaClientes->stream();

		
	}

	// DESCARGAR
	public function downloadReportListClient()
	{
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
		$clientes = Cliente::orderby('created_at', 'desc')->get();		
		$listaClientes = PDF::loadView('admin.Reportes.listaClientes', array(
							'clientes' => $clientes,
							'dateAct' => $dateAct
								
							))->setPaper('A4');

		return $listaClientes->download('SISRMP_Lista_Clientes.pdf');
	}





	// FUNCIONES PARA CARTELRA DE COORDINADORES CON SU INFORMACION (((((((( REPORTE 8 ))))))))
	// VER
	public function viewReportListCoords()
	{
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$coordinadores = Coordinador::orderby('created_at', 'desc')->get();
     	$listaCoordinadores = PDF::loadView('admin.Reportes.listaCoordinadores', array(
     						'coordinadores' => $coordinadores,
     						'dateAct' => $dateAct
     						
     						))->setPaper('A4');

     	return $listaCoordinadores->stream();
	}

	// DESCARGAR
	public function downloadReportListCoords()
	{
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$coordinadores = Coordinador::orderby('created_at', 'desc')->get();
     	$listaCoordinadores = PDF::loadView('admin.Reportes.listaCoordinadores', array(
     						'coordinadores' => $coordinadores,
     						'dateAct' => $dateAct
     						
     						))->setPaper('A4');

     	return $listaCoordinadores->download('SISRMP_Lista_Coordinadores.pdf');
	}




	// FUNCIONES PARA LISTADO DE RELACIONES O ASIGNACIONES CLIENTE COORDINADOR  ((((( REPORTE 9 )))))
	// VER
	public function viewReportListRel()
	{

		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$asignaciones = AsignaCliente::orderby('created_at', 'desc')->get();
     	$listaAsignaciones = PDF::loadView('admin.Reportes.listaRelaciones', array(
     						'asignaciones' => $asignaciones,
     						'dateAct' => $dateAct

     						))->setPaper('A4');

     	return $listaAsignaciones->stream();
	}

	//DESCARGAR
	public function downloadReportListRel()
	{
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$asignaciones = AsignaCliente::orderby('created_at', 'desc')->get();
     	$listaAsignaciones = PDF::loadView('admin.Reportes.listaRelaciones', array(
     						'asignaciones' => $asignaciones,
     						'dateAct' => $dateAct

     						))->setPaper('A4');

     	return $listaAsignaciones->download('SISRMP_Lista_Relaciones.pdf');
	}


	// FUNCIONES PARA LISTADO DE IMAGENES DE CUENTA DE COORDINADORES (((((((( REPORTE 10))))))))
	// VER
	public function viewReportListImageCoord(){

		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$imagenCoords = Coordinador::orderby('created_at', 'desc')->get();
     	$listaImagenes = PDF::loadView('admin.Reportes.listaImagenesCoord', array(
     						'imagenCoords' => $imagenCoords,
     						'dateAct' => $dateAct

     						))->setPaper('A4');

     	return $listaImagenes->stream();
	}

	//DOWNLOAD
	public function downloadViewReportListImageCoord(){


		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$imagenCoords = Coordinador::orderby('created_at', 'desc')->get();
     	$listaImagenesCoord = PDF::loadView('admin.Reportes.listaImagenesCoord', array(
     						'imagenCoords' => $imagenCoords,
     						'dateAct' => $dateAct

     						))->setPaper('A4');

     	return $listaImagenesCoord->download('SISRMP_Lista_Imagenes_CuentaCoordinador.pdf');

	}


	// FUNCIONES PARA LISTADO DE IMAGENES DE CUENTA DE CLIENTES (((((((( REPORTE 11 ))))))))
	// VER
	public function viewReportListImageClient(){

		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$imagenClients = Cliente::orderby('created_at', 'desc')->get();
     	$listaImagenesClient = PDF::loadView('admin.Reportes.listaImagenesCliente', array(
     						'imagenClients' => $imagenClients,
     						'dateAct' => $dateAct

     						))->setPaper('A4');

     	return $listaImagenesClient->stream();
	}

	//DOWNLOAD
	public function downloadViewReportListImageClient(){


		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 
     	$imagenClients = Cliente::orderby('created_at', 'desc')->get();
     	$listaImagenesClient = PDF::loadView('admin.Reportes.listaImagenesCliente', array(
     						'imagenClients' => $imagenClients,
     						'dateAct' => $dateAct

     						))->setPaper('A4');

     	return $listaImagenesClient->download('SISRMP_Lista_Imagenes_CuentaCliente.pdf');

	}




	// FUNCION PARA DESCARGA DE REPORTE DEPARTAMENTO SELECCIONADO
	public function downloadDetalleDepto($Id_Depto)
	{
		$date = Carbon::now();
     	$dateAct = $date->format('d-m-Y h:i:s a'); 

		$coordinadores = Coordinador::all();
		$departamento = Departamento::find($Id_Depto);
		$arrayDepto = array('departamento' => $departamento, 'dateAct' => $dateAct, 'coordinadores' => $coordinadores );

		$departamentoDetalle = PDF::loadView('admin.Reportes.detalleDepto', $arrayDepto);

		return $departamentoDetalle->download('SISRMP_detalle_Departamento('.$departamento->Nombre.').pdf');
	}

	

}

?>