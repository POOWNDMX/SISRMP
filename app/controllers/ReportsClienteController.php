<?php
use Carbon\Carbon;
/**
* 
*/
class ReportsClienteController extends BaseController
{

							// ################### REPORTES DE COORDINADORES ##############################

	// DESCARGAR REPORTE DE ESTADISTICA GENERAL DE ARCHIVOS DE COORDINADOR SELECCIONADO. ((( REPORTE 1 )))
	public function statisticFilesClient($id)
	{
		$date = Carbon::now();
        $dateAct = $date->format('d-m-Y h:i:s a'); 

    	$cliente = Cliente::find($id);
    	$id = $cliente->id;
    	$stateActive = 0;
    	$stateInactive = 1;
    	$stringUserCoord = 'submitCoord';
    	$stringUserClient = 'submitClient';
    	$model = new Archivo;

    	// TRAEMOS EL TOTAL DE ARCHIVOS
    	$totalFiles = $model->where('Id_Cliente','=',$id)->where('state','=',$stateActive)->count();
    	$totalSize  = $model->where('Id_Cliente','=',$id)->where('state','=',$stateActive)->sum('clientSize');
    	$totalSizeFilesMB = number_format(doubleval($totalSize/1024),3,'.','');
    	$totalSizeFilesGB = number_format(doubleval($totalSize/1024)/1024,3,'.','');

    	// TRAEMOS ELEMENTOS RECIBIDOS
    	$totalFilesReceived = $model->where('Id_Cliente','=',$id)
    							  ->where('state','=',$stateActive)
    							  ->where('userSubmit','=',$stringUserCoord)->count();

  		$totalSizeFilesReceived = $model->where('Id_Cliente','=',$id)
    							  ->where('state','=',$stateActive)
    							  ->where('userSubmit','=',$stringUserCoord)->sum('clientSize');

    	$totalSizeFilesReceivedMB = number_format(doubleval($totalSizeFilesReceived/1024),3,'.','');
    	$totalSizeFilesReceivedGB = number_format(doubleval($totalSizeFilesReceived/1024)/1024,3,'.','');

    	// TRAEMOS ELEMENTOS ENVIADOS
    	$totalFilesSubmit = $model->where('Id_Cliente','=',$id)
    							  ->where('state','=',$stateActive)
    							  ->where('userSubmit','=',$stringUserClient)->count();

  		$totalSizeFilesSubmit = $model->where('Id_Cliente','=',$id)
    							  ->where('state','=',$stateActive)
    							  ->where('userSubmit','=',$stringUserClient)->sum('clientSize');

    	$totalSizeFilesSubmitMB = number_format(doubleval($totalSizeFilesSubmit/1024),3,'.','');
    	$totalSizeFilesSubmitGB = number_format(doubleval($totalSizeFilesSubmit/1024)/1024,3,'.','');

    	// TRAEMOS ELEMENTOS ELIMINDOS POR ALGUN USUARIO
    	$totalFilesDeleted = $model->where('Id_Cliente','=',$id)
    							   ->where('state','=',$stateInactive)->count();

  		$totalSizeFilesDeleted = $model->where('Id_Cliente','=',$id)
    							  ->where('state','=',$stateInactive)
    							  ->sum('clientSize');

    	$totalSizeFilesDeletedMB = number_format(doubleval($totalSizeFilesDeleted/1024),3,'.','');
    	$totalSizeFilesDeletedGB = number_format(doubleval($totalSizeFilesDeleted/1024)/1024,3,'.','');


		$estadisticasPanel = PDF::loadView('admin.Reportes.estadisticaFilesClient', array(
								'dateAct' => $dateAct,
								'cliente' => $cliente,
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
					'SISRMP_estadisticas_CLIENTE('.$cliente->NombreEmpresa.').pdf');
	}






	// FUNCIONES PARA LISTADO DE ARCHIVOS COORDINADOR ((((( REPORTE 2 )))))
	// VER
	public function viewReportListClientFiles($id){
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateActive = 0;

		$model = new Archivo;

		$columClientSize = $model->where('Id_Cliente','=',$id)->where('state','=',$stateActive)->sum('clientSize');
		$totalSizeFileMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

        $viewMyFiles = $model->orderBy('Id_File', 'DESC')->where('Id_Cliente','=',$id)
        												 ->where('state','=',$stateActive)->get();
        												 
        $listaFilesClient = PDF::loadView('admin.Reportes.filesClient', array(
        					'viewMyFiles' => $viewMyFiles,
        					'dateAct' => $dateAct,
        					'cliente' => $cliente,
        					'totalSizeFileMB' => $totalSizeFileMB,
        					'totalSizeFileGB' => $totalSizeFileGB
        					
        					))->setPaper('A4');

        return $listaFilesClient->stream();
	}

	// DOWNLOAD
	public function downloadReportListClientFiles($id){
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateActive = 0;

		$model = new Archivo;

		$columClientSize = $model->where('Id_Cliente','=',$id)->where('state','=',$stateActive)->sum('clientSize');
		$totalSizeFileMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

        $viewMyFiles = $model->orderBy('Id_File', 'DESC')->where('Id_Cliente','=',$id)
        												 ->where('state','=',$stateActive)->get();

        $listaFilesClient = PDF::loadView('admin.Reportes.filesClient', array(
        					'viewMyFiles' => $viewMyFiles,
        					'dateAct' => $dateAct,
        					'cliente' => $cliente,
        					'totalSizeFileMB' => $totalSizeFileMB,
        					'totalSizeFileGB' => $totalSizeFileGB,
        					
        					))->setPaper('A4');

        return $listaFilesClient->download(
        				'SISRMP_Lista_Files_CLIENTE('.$cliente->NombreEmpresa.').pdf');
	}

	

	// Funciones para listado de archivos recibidos coordinador seleccionado ((((( reporte 3 )))))
	// VER
	public function viewListReportReceivedClientFiles($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateActive = 0;
		$stringUserCoord = 'submitCoord';

		$model = new Archivo;

		$columClientSize = $model->where('Id_Cliente','=',$id)
								 ->where('userSubmit','=',$stringUserCoord)
								 ->where('state','=',$stateActive)->sum('clientSize');

		$totalSizeFileReceivedClientMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileReceivedClientGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$viewReceivedClientFiles = $model->orderBy('Id_File', 'DESC')
										->where('Id_Cliente','=',$id)
										->where('userSubmit','=',$stringUserCoord)
								 		->where('state','=',$stateActive)->get();

		$listaFilesReceivedClient = PDF::loadView('admin.Reportes.filesReceivedClient', array(
									'viewReceivedClientFiles' => $viewReceivedClientFiles,
									'dateAct' => $dateAct,
									'cliente' => $cliente,
									'totalSizeFileReceivedClientMB' => $totalSizeFileReceivedClientMB,
									'totalSizeFileReceivedClientGB' => $totalSizeFileReceivedClientGB

			))->setPaper('A4');

		 return $listaFilesReceivedClient->stream();
	}

	// DESCARGAR
	public function downloadListReportReceivedClientFiles($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateActive = 0;
		$stringUserCoord = 'submitCoord';

		$model = new Archivo;

		$columClientSize = $model->where('Id_Cliente','=',$id)
								 ->where('userSubmit','=',$stringUserCoord)
								 ->where('state','=',$stateActive)->sum('clientSize');

		$totalSizeFileReceivedClientMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileReceivedClientGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$viewReceivedClientFiles = $model->orderBy('Id_File', 'DESC')
										->where('Id_Cliente','=',$id)
										->where('userSubmit','=',$stringUserCoord)
								 		->where('state','=',$stateActive)->get();

		$listaFilesReceivedClient = PDF::loadView('admin.Reportes.filesReceivedClient', array(
									'viewReceivedClientFiles' => $viewReceivedClientFiles,
									'dateAct' => $dateAct,
									'cliente' => $cliente,
									'totalSizeFileReceivedClientMB' => $totalSizeFileReceivedClientMB,
									'totalSizeFileReceivedClientGB' => $totalSizeFileReceivedClientGB

			))->setPaper('A4');


		 return $listaFilesReceivedClient->download(
        				'SISRMP_Lista_Files_Recibidos_Propiedad_CLIENTE('.$cliente->NombreEmpresa.').pdf');
	}



	// Funciones para listado de archivos enviados por el coordinador seleccionado (((((( reporte 4 ))))))
	// VER
	public function viewlistReportSubmitClientFiles($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateActive = 0;
		$stringUserClient = 'submitClient';

		$model = new Archivo;

		$columClientSize = $model->where('Id_Cliente','=',$id)->where('userSubmit','=',$stringUserClient)
								 	->where('state','=',$stateActive)->sum('clientSize');

		$totalSizeFileSubmitClientMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileSubmitClientGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$viewSubmitClientFiles = $model->orderBy('Id_File', 'DESC')
									  ->where('Id_Cliente','=',$id)
									  ->where('userSubmit','=',$stringUserClient)
								      ->where('state','=',$stateActive)->get();

		$listaFilesSubmitClient = PDF::loadView('admin.Reportes.filesSubmitClient', array(
									'viewSubmitClientFiles' => $viewSubmitClientFiles,
									'dateAct' => $dateAct,
									'cliente' => $cliente,
									'totalSizeFileSubmitClientMB' => $totalSizeFileSubmitClientMB,
									'totalSizeFileSubmitClientGB' => $totalSizeFileSubmitClientGB

			))->setPaper('A4');

		return $listaFilesSubmitClient->stream();

	}


	// DESCARGAR
	public function downloadlistReportSubmitClientFiles($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');
		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateActive = 0;
		$stringUserClient = 'submitClient';

		$model = new Archivo;

		$columClientSize = $model->where('Id_Cliente','=',$id)->where('userSubmit','=',$stringUserClient)
								 	->where('state','=',$stateActive)->sum('clientSize');

		$totalSizeFileSubmitClientMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeFileSubmitClientGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$viewSubmitClientFiles = $model->orderBy('Id_File', 'DESC')
									  ->where('Id_Cliente','=',$id)
									  ->where('userSubmit','=',$stringUserClient)
								      ->where('state','=',$stateActive)->get();

		$listaFilesSubmitClient = PDF::loadView('admin.Reportes.filesSubmitClient', array(
									'viewSubmitClientFiles' => $viewSubmitClientFiles,
									'dateAct' => $dateAct,
									'cliente' => $cliente,
									'totalSizeFileSubmitClientMB' => $totalSizeFileSubmitClientMB,
									'totalSizeFileSubmitClientGB' => $totalSizeFileSubmitClientGB

			))->setPaper('A4');

		return $listaFilesSubmitClient->download(
        				'SISRMP_Lista_Files_Enviados_Propiedad_CLIENTE('.$cliente->NombreEmpresa.').pdf');

	}

	
	// FUNCIONES PARA LISTA DE ARCHIVOS ELIMINADOS POR ALGUN USUARIO CLIENTE O COORDINADOR PERO QUE LE PERTENECEN A EL COORDINADOR SELECCIONADO. ((((((( reporte 5	 )))))))
	// VER
	public function viewlistReportDeletedClientFilesForUser($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateInactive = 1;

		$model = new Archivo;
		$columClientSize = $model->where('Id_Cliente','=',$id)->where('state','=',$stateInactive)->sum('clientSize');

		$totalSizeDeletedFilesClientMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeDeletedFilesClientGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$archivos = $model->where('Id_Cliente','=',$id)->where('state','=',$stateInactive)->get();

		$listaFilesDeletedClient = PDF::loadView('admin.Reportes.listaFilesDeletedClient', array(
									'archivos' => $archivos,
									'dateAct' => $dateAct,
									'cliente' => $cliente,
									'totalSizeDeletedFilesClientMB' => $totalSizeDeletedFilesClientMB,
									'totalSizeDeletedFilesClientGB' => $totalSizeDeletedFilesClientGB

			))->setPaper('A4');

		return $listaFilesDeletedClient->stream();
	}


	// DESCARGAR
	public function downloadlistReportDeletedClientFilesForUser($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateInactive = 1;

		$model = new Archivo;
		$columClientSize = $model->where('Id_Cliente','=',$id)->where('state','=',$stateInactive)->sum('clientSize');

		$totalSizeDeletedFilesClientMB = number_format(doubleval($columClientSize/1024),3,'.','');
		$totalSizeDeletedFilesClientGB = number_format(doubleval($columClientSize/1024)/1024,3,'.','');

		$archivos = $model->where('Id_Cliente','=',$id)->where('state','=',$stateInactive)->get();

		$listaFilesDeletedClient = PDF::loadView('admin.Reportes.listaFilesDeletedClient', array(
									'archivos' => $archivos,
									'dateAct' => $dateAct,
									'cliente' => $cliente,
									'totalSizeDeletedFilesClientMB' => $totalSizeDeletedFilesClientMB,
									'totalSizeDeletedFilesClientGB' => $totalSizeDeletedFilesClientGB

			))->setPaper('A4');


		return $listaFilesDeletedClient->download(
        				'SISRMP_Lista_Files_Eliminados(Inactivos)_Propiedad_CLIENTE('.$cliente->NombreEmpresa.').pdf');
	}


	// FUNCION PARA IMPRESION DE PERFIL DE CLIENTE SELECCIONADO
	public function downloadPerfilCliente($id)
	{
		$date = Carbon::now();
		$dateAct = $date->format('d-m-Y h:i:s a');

		$cliente = Cliente::find($id);
		$id = $cliente->id;

		$model = new AsignaCliente;
		$coords = $model->where('Id_Cliente','=',$id)->get();

		$arrayCliente = array('cliente' => $cliente, 'dateAct' => $dateAct, 'coords' => $coords );

		$clienteDetalle = PDF::loadView('admin.Reportes.perfilClienteSelect',$arrayCliente)->setPaper('A4');
		
		return $clienteDetalle->download('SISRMP_Perfil_Cliente('.$cliente->NombreEmpresa.').pdf');
	}

}

?>