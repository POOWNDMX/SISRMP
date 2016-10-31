<?php
use Carbon\Carbon;
/**
* 
*/
class ReportsCoordController extends BaseController
{


						// ################### REPORTES DE COORDINADORES ##############################

	// DESCARGAR REPORTE DE ESTADISTICA GENERAL DE ARCHIVOS DE COORDINADOR SELECCIONADO. ((( REPORTE 1 )))
	public function statisticFilesCoord($id)
	{
		$date = Carbon::now();
        $dateAct = $date->format('d-m-Y h:i:s a'); 

    	$coordinador = Coordinador::find($id);
    	$id = $coordinador->id;
    	$stateActive = 0;
    	$stateInactive = 1;
    	$stringUserCoord = 'submitCoord';
    	$stringUserClient = 'submitClient';
    	$model = new Archivo;

    	// TRAEMOS EL TOTAL DE ARCHIVOS
    	$totalFiles = $model->where('Id_Coordinador','=',$id)->where('state','=',$stateActive)->count();
    	$totalSize  = $model->where('Id_Coordinador','=',$id)->where('state','=',$stateActive)->sum('clientSize');
    	$totalSizeFilesMB = number_format(doubleval($totalSize/1024),3,'.','');
    	$totalSizeFilesGB = number_format(doubleval($totalSize/1024)/1024,3,'.','');

    	// TRAEMOS ELEMENTOS RECIBIDOS
    	$totalFilesReceived = $model->where('Id_Coordinador','=',$id)
    							  ->where('state','=',$stateActive)
    							  ->where('userSubmit','=',$stringUserClient)->count();

  		$totalSizeFilesReceived = $model->where('Id_Coordinador','=',$id)
    							  ->where('state','=',$stateActive)
    							  ->where('userSubmit','=',$stringUserClient)->sum('clientSize');

    	$totalSizeFilesReceivedMB = number_format(doubleval($totalSizeFilesReceived/1024),3,'.','');
    	$totalSizeFilesReceivedGB = number_format(doubleval($totalSizeFilesReceived/1024)/1024,3,'.','');

    	// TRAEMOS ELEMENTOS ENVIADOS
    	$totalFilesSubmit = $model->where('Id_Coordinador','=',$id)
    							  ->where('state','=',$stateActive)
    							  ->where('userSubmit','=',$stringUserCoord)->count();

  		$totalSizeFilesSubmit = $model->where('Id_Coordinador','=',$id)
    							  ->where('state','=',$stateActive)
    							  ->where('userSubmit','=',$stringUserCoord)->sum('clientSize');

    	$totalSizeFilesSubmitMB = number_format(doubleval($totalSizeFilesSubmit/1024),3,'.','');
    	$totalSizeFilesSubmitGB = number_format(doubleval($totalSizeFilesSubmit/1024)/1024,3,'.','');

    	// TRAEMOS ELEMENTOS ELIMINDOS POR ALGUN USUARIO
    	$totalFilesDeleted = $model->where('Id_Coordinador','=',$id)
    							   ->where('state','=',$stateInactive)->count();

  		$totalSizeFilesDeleted = $model->where('Id_Coordinador','=',$id)
    							  ->where('state','=',$stateInactive)
    							  ->sum('clientSize');

    	$totalSizeFilesDeletedMB = number_format(doubleval($totalSizeFilesDeleted/1024),3,'.','');
    	$totalSizeFilesDeletedGB = number_format(doubleval($totalSizeFilesDeleted/1024)/1024,3,'.','');


		$estadisticasPanel = PDF::loadView('admin.Reportes.estadisticaFilesCoord', array(
								'dateAct' => $dateAct,
								'coordinador' => $coordinador,
								'totalFiles' => $totalFiles,
								'totalSizeFilesMB' => $totalSizeFilesMB,
								'totalSizeFilesGB' => $totalSizeFilesGB,
								'totalFilesReceived' => $totalFilesReceived,
								'totalSizeFilesReceivedMB' => $totalSizeFilesReceivedMB,
								'totalSizeFilesReceivedGB' => $totalSizeFilesReceivedGB,
								'totalFilesSubmit' => $totalFilesSubmit,
								'totalSizeFilesSubmitMB' => $totalSizeFilesSubmitMB,
								'totalSizeFilesSubmitGB' => $totalSizeFilesSubmitGB,
								'totalFilesDeleted' => $totalFilesDeleted,
								'totalSizeFilesDeletedMB' => $totalSizeFilesDeletedMB,
								'totalSizeFilesDeletedGB' => $totalSizeFilesDeletedGB
							
							))->setPaper('A4');
	
		return $estadisticasPanel->download(
					'SISRMP_estadisticas_COORDINADOR('.$coordinador->Nombre.'_'.$coordinador->Apellidos.').pdf');
	}






	// FUNCIONES PARA LISTADO DE ARCHIVOS COORDINADOR ((((( REPORTE 2 )))))
	// VER
	public function viewReportListCoordFiles($id){
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$coordinador = Coordinador::find($id);
		$id = $coordinador->id;
		$stateActive = 0;

		$model = new Archivo;

		$columClientSize = $model->where('Id_Coordinador','=',$id)->where('state','=',$stateActive)->sum('clientSize');
		$totalSizeFileMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

        $viewMyFiles = $model->orderBy('Id_File', 'DESC')->where('Id_Coordinador','=',$id)
        												 ->where('state','=',$stateActive)->get();
        												 
        $listaFilesCoord = PDF::loadView('admin.Reportes.filesCoord', array(
        					'viewMyFiles' => $viewMyFiles,
        					'dateAct' => $dateAct,
        					'coordinador' => $coordinador,
        					'totalSizeFileMB' => $totalSizeFileMB,
        					'totalSizeFileGB' => $totalSizeFileGB
        					
        					))->setPaper('A4');

        return $listaFilesCoord->stream();
	}

	// DOWNLOAD
	public function downloadReportListCoordFiles($id){
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$coordinador = Coordinador::find($id);
		$id = $coordinador->id;
		$stateActive = 0;

		$model = new Archivo;

		$columClientSize = $model->where('Id_Coordinador','=',$id)->where('state','=',$stateActive)->sum('clientSize');
		$totalSizeFileMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

        $viewMyFiles = $model->orderBy('Id_File', 'DESC')->where('Id_Coordinador','=',$id)
        												 ->where('state','=',$stateActive)->get();

        $listaFilesCoord = PDF::loadView('admin.Reportes.filesCoord', array(
        					'viewMyFiles' => $viewMyFiles,
        					'dateAct' => $dateAct,
        					'coordinador' => $coordinador,
        					'totalSizeFileMB' => $totalSizeFileMB,
        					'totalSizeFileGB' => $totalSizeFileGB,
        					
        					))->setPaper('A4');

        return $listaFilesCoord->download(
        				'SISRMP_Lista_Files_COORDINADOR('.$coordinador->Nombre.'_'.$coordinador->Apellidos.').pdf');
	}

	

	// Funciones para listado de archivos recibidos coordinador seleccionado ((((( reporte 3 )))))
	// VER
	public function viewListReportReceivedCoordFiles($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$coordinador = Coordinador::find($id);
		$id = $coordinador->id;
		$stateActive = 0;
		$stringUserClient = 'submitClient';

		$model = new Archivo;

		$columClientSize = $model->where('Id_Coordinador','=',$id)
								 ->where('userSubmit','=',$stringUserClient)
								 ->where('state','=',$stateActive)->sum('clientSize');

		$totalSizeFileReceivedCoordMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileReceivedCoordGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$viewReceivedCoordFiles = $model->orderBy('Id_File', 'DESC')
										->where('Id_Coordinador','=',$id)
										->where('userSubmit','=',$stringUserClient)
								 		->where('state','=',$stateActive)->get();

		$listaFilesReceivedCoord = PDF::loadView('admin.Reportes.filesReceivedCoord', array(
									'viewReceivedCoordFiles' => $viewReceivedCoordFiles,
									'dateAct' => $dateAct,
									'coordinador' => $coordinador,
									'totalSizeFileReceivedCoordMB' => $totalSizeFileReceivedCoordMB,
									'totalSizeFileReceivedCoordGB' => $totalSizeFileReceivedCoordGB

			))->setPaper('A4');

		 return $listaFilesReceivedCoord->stream();
	}

	// DESCARGAR
	public function downloadListReportReceivedCoordFiles($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$coordinador = Coordinador::find($id);
		$id = $coordinador->id;
		$stateActive = 0;
		$stringUserClient = 'submitClient';

		$model = new Archivo;

		$columClientSize = $model->where('Id_Coordinador','=',$id)->where('userSubmit','=',$stringUserClient)
								 	->where('state','=',$stateActive)->sum('clientSize');

		$totalSizeFileReceivedCoordMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileReceivedCoordGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$viewReceivedCoordFiles = $model->orderBy('Id_File', 'DESC')
										->where('Id_Coordinador','=',$id)
										->where('userSubmit','=',$stringUserClient)
								 		->where('state','=',$stateActive)->get();

		$listaFilesReceivedCoord = PDF::loadView('admin.Reportes.filesReceivedCoord', array(
									'viewReceivedCoordFiles' => $viewReceivedCoordFiles,
									'dateAct' => $dateAct,
									'coordinador' => $coordinador,
									'totalSizeFileReceivedCoordMB' => $totalSizeFileReceivedCoordMB,
									'totalSizeFileReceivedCoordGB' => $totalSizeFileReceivedCoordGB

			))->setPaper('A4');

		 return $listaFilesReceivedCoord->download(
        				'SISRMP_Lista_Files_Recibidos_Propiedad_COORDINADOR('.$coordinador->Nombre.'_'.$coordinador->Apellidos.').pdf');
	}



	// Funciones para listado de archivos enviados por el coordinador seleccionado (((((( reporte 4 ))))))
	// VER
	public function viewlistReportSubmitCoordFiles($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$coordinador = Coordinador::find($id);
		$id = $coordinador->id;
		$stateActive = 0;
		$stringUserCoord = 'submitCoord';

		$model = new Archivo;

		$columClientSize = $model->where('Id_Coordinador','=',$id)->where('userSubmit','=',$stringUserCoord)
								 	->where('state','=',$stateActive)->sum('clientSize');

		$totalSizeFileSubmitCoordMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileSubmitCoordGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$viewSubmitCoordFiles = $model->orderBy('Id_File', 'DESC')
									  ->where('Id_Coordinador','=',$id)
									  ->where('userSubmit','=',$stringUserCoord)
								      ->where('state','=',$stateActive)->get();

		$listaFilesSubmitCoord = PDF::loadView('admin.Reportes.filesSubmitCoord', array(
									'viewSubmitCoordFiles' => $viewSubmitCoordFiles,
									'dateAct' => $dateAct,
									'coordinador' => $coordinador,
									'totalSizeFileSubmitCoordMB' => $totalSizeFileSubmitCoordMB,
									'totalSizeFileSubmitCoordGB' => $totalSizeFileSubmitCoordGB

			))->setPaper('A4');

		return $listaFilesSubmitCoord->stream();

	}


	// DESCARGAR
	public function downloadlistReportSubmitCoordFiles($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$coordinador = Coordinador::find($id);
		$id = $coordinador->id;
		$stateActive = 0;
		$stringUserCoord = 'submitCoord';

		$model = new Archivo;

		$columClientSize = $model->where('Id_Coordinador','=',$id)->where('userSubmit','=',$stringUserCoord)
								 	->where('state','=',$stateActive)->sum('clientSize');

		$totalSizeFileSubmitCoordMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileSubmitCoordGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$viewSubmitCoordFiles = $model->orderBy('Id_File', 'DESC')
									  ->where('Id_Coordinador','=',$id)
									  ->where('userSubmit','=',$stringUserCoord)
								      ->where('state','=',$stateActive)->get();

		$listaFilesSubmitCoord = PDF::loadView('admin.Reportes.filesSubmitCoord', array(
									'viewSubmitCoordFiles' => $viewSubmitCoordFiles,
									'dateAct' => $dateAct,
									'coordinador' => $coordinador,
									'totalSizeFileSubmitCoordMB' => $totalSizeFileSubmitCoordMB,
									'totalSizeFileSubmitCoordGB' => $totalSizeFileSubmitCoordGB

			))->setPaper('A4');

		return $listaFilesSubmitCoord->download(
        				'SISRMP_Lista_Files_Enviados_Propiedad_COORDINADOR('.$coordinador->Nombre.'_'.$coordinador->Apellidos.').pdf');

	}

	
	// FUNCIONES PARA LISTA DE ARCHIVOS ELIMINADOS POR ALGUN USUARIO CLIENTE O COORDINADOR PERO QUE LE PERTENECEN A EL COORDINADOR SELECCIONADO. ((((((( reporte 5	 )))))))
	// VER
	public function viewlistReportDeletedCoordFilesForUser($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$coordinador = Coordinador::find($id);
		$id = $coordinador->id;
		$stateInactive = 1;
		$stringUserCoord = 'submitCoord';

		$model = new Archivo;
		$columClientSize = $model->where('Id_Coordinador','=',$id)->where('state','=',$stateInactive)->sum('clientSize');

		$totalSizeDeletedFilesCoordMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeDeletedFilesCoordGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$archivos = $model->where('Id_Coordinador','=',$id)->where('state','=',$stateInactive)->get();

		$listaFilesDeletedCoord = PDF::loadView('admin.Reportes.listaFilesDeletedCoord', array(
									'archivos' => $archivos,
									'dateAct' => $dateAct,
									'coordinador' => $coordinador,
									'totalSizeDeletedFilesCoordMB' => $totalSizeDeletedFilesCoordMB,
									'totalSizeDeletedFilesCoordGB' => $totalSizeDeletedFilesCoordGB

			))->setPaper('A4');

		return $listaFilesDeletedCoord->stream();
	}


	// DESCARGAR
	public function downloadlistReportDeletedCoordFilesForUser($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$coordinador = Coordinador::find($id);
		$id = $coordinador->id;
		$stateInactive = 1;
		$stringUserCoord = 'submitCoord';

		$model = new Archivo;
		$columClientSize = $model->where('Id_Coordinador','=',$id)->where('state','=',$stateInactive)->sum('clientSize');

		$totalSizeDeletedFilesCoordMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeDeletedFilesCoordGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$archivos = $model->where('Id_Coordinador','=',$id)->where('state','=',$stateInactive)->get();

		$listaFilesDeletedCoord = PDF::loadView('admin.Reportes.listaFilesDeletedCoord', array(
									'archivos' => $archivos,
									'dateAct' => $dateAct,
									'coordinador' => $coordinador,
									'totalSizeDeletedFilesCoordMB' => $totalSizeDeletedFilesCoordMB,
									'totalSizeDeletedFilesCoordGB' => $totalSizeDeletedFilesCoordGB

			))->setPaper('A4');

		return $listaFilesDeletedCoord->download(
        				'SISRMP_Lista_Files_Eliminados(Inactivos)_Propiedad_COORDINADOR('.$coordinador->Nombre.'_'.$coordinador->Apellidos.').pdf');
	}





	// FUNCION PARA IMPRESION DESCARGA DE REPORTE COORDINADOR SELECCIONADO
	public function downloadPerfilCoord($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$coordinador = Coordinador::find($id);
		$id = $coordinador->id;

		$model = new AsignaCliente;
		$clientes = $model->where('Id_Coordinador','=',$id)->get();

		$arrayCoord = array('coordinador' => $coordinador, 'dateAct' => $dateAct, 'clientes' => $clientes );

		$perfilCoord = PDF::loadView('admin.Reportes.perfilCoordSelect', $arrayCoord);		

		return $perfilCoord->download('SISRMP_Rerfil_Coordinador('.$coordinador->Nombre.' '.$coordinador->Apellidos.').pdf');
	}


}

?>