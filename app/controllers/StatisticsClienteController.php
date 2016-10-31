<?php
use Carbon\Carbon;
/**
* 
*/
class StatisticsClienteController extends BaseController
{
	
	// FUNCION QUE MUESTRA PANEL DE ESTADISTICA DE ARCHIVOS DEL COORDINADOR SELECCIONADO
	public function indexPanel($id)
	{
		$date = Carbon::now();
   		$dateAct = $date->format('l j F Y h:i:s a');
		$img = Administrador::find(Auth::userAdmin()->get()->id);
    	$imagen = $img->imgperfil;

    	$cliente = Cliente::find($id);
    	$id = $cliente->id;
    	
    	$stringSubmitClient = 'submitClient';
    	$stringSubmitCoord = 'submitCoord';
     	$stateActive = 0;
    	$stateInactive = 1;

    	$model = new Archivo;

    	// TOTAL DE ARCHIVOS Y TAMAÑO DEL CLIENTE SELECCIONADO
    	$totalFiles = $model->where('Id_Cliente','=',$id)->where('state','=',$stateActive)->count();
    	$totalSize = $model->where('Id_Cliente','=',$id)->where('state','=',$stateActive)->sum('clientSize');
    	$totalSizeFilesMB = number_format(doubleval($totalSize/1024),3,'.','');
    	$totalSizeFilesGB =	number_format(doubleval($totalSize/1024)/1024,3,'.','');

    	// TOTAL DE ARCHIVOS Y TAMAÑO BANDEJA ENTRADA DEL CLIENTE 
    	$totalFilesReceived = $model->where('Id_Cliente','=',$id)
    							->where('userSubmit','=',$stringSubmitCoord)
    							->where('state','=',$stateActive)
    							->count();

    	$totalSizeFilesReceived = $model->where('Id_Cliente','=',$id)
    							->where('userSubmit','=',$stringSubmitCoord)
    							->where('state','=',$stateActive)
    							->sum('clientSize');

    	$totalSizeFilesReceivedMB =  number_format(doubleval($totalSizeFilesReceived/1024),3,'.','');
		$totalSizeFilesReceivedGB =  number_format(doubleval($totalSizeFilesReceived/1024)/1024,3,'.','');

		// TOTAL DE ARCHIVOS Y TAMAÑO BANDEJA ESALIDA DEL CLIENTE SELECCIONADO
		$totalFilesSubmit = $model->where('Id_Cliente','=',$id)
    							->where('userSubmit','=',$stringSubmitClient)
    							->where('state','=',$stateActive)
    							->count();

    	$totalSizeFilesSubmit = $model->where('Id_Cliente','=',$id)
    							->where('userSubmit','=',$stringSubmitClient)
    							->where('state','=',$stateActive)
    							->sum('clientSize');

    	$totalSizeFilesSubmitMB =  number_format(doubleval($totalSizeFilesSubmit/1024),3,'.','');
		$totalSizeFilesSubmitGB =  number_format(doubleval($totalSizeFilesSubmit/1024)/1024,3,'.','');

		// TOTAL DE ARCHIVOS ELIMINADOS POR ALGUN USUARIO PROPIEDAD DEL CLIENTE SELECCIONADO
		$totalFilesDeleted = $model->where('Id_Cliente','=',$id)->where('state','=',$stateInactive)->count();
		$totalSizeFilesDeleted = $model->where('Id_Cliente','=',$id)->where('state','=',$stateInactive)->sum('clientSize');

		$totalSizeFilesDeletedMB = number_format(doubleval($totalSizeFilesDeleted/1024),3,'.','');
		$totalSizeFilesDeletedGB = number_format(doubleval($totalSizeFilesDeleted/1024)/1024,3,'.','');

		return View::make('admin.Clientes.estadisticasPanel', array(
							'dateAct' => $dateAct,
							'imagen' => $imagen,
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

			));

	}

	// FUNCION QUE MUESTRA LOS ARCHIVOS EN TOTAL DEL CCLIENTE SELECCIONADO
	public function viewFilesAllClient($id)
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
    	$imagen = $img->imgperfil;

		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateActive = 0;

		if(isset($_GET['buscar']))
		{
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File','DESC')
								->where('Id_Cliente','=',$id)
								->where('state','=',$stateActive)->where(function($query)
									{
										$resultado = htmlspecialchars(Input::get('buscar'));

										$query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                							->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                							->orwhere('Id_Coordinador', 'LIKE', '%'.$resultado.'%' )
                							->orwhere('userSubmit', 'LIKE', '%'.$resultado.'%' );
                
									})->paginate(15);
		}
		else
		{
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File','DESC')->where('Id_Cliente','=',$id)
														 ->where('state','=',$stateActive)->paginate(25);
		}

		return View::make('admin.Clientes.files', array(
											'imagen' => $imagen,
											'cliente' => $cliente,
											'archivos' => $archivos
											));
	}



	// FUNCION QUE MUESTRA LOS ARCHIVOS RECIBIDOS DEL CLIENTE SELECCIONADO
	public function viewFilesReceivedClient($id)
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
    	$imagen = $img->imgperfil;

		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateActive = 0;
		$stringSubmitCoord = 'submitCoord';

		if(isset($_GET['buscar']))
		{
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File','DESC')
								->where('Id_Cliente','=',$id)
								->where('userSubmit','=',$stringSubmitCoord)
								->where('state','=',$stateActive)->where(function($query)
									{
										$resultado = htmlspecialchars(Input::get('buscar'));

										$query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                							->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                							->orwhere('Id_Coordinador', 'LIKE', '%'.$resultado.'%');
                
									})->paginate(15);
		}
		else
		{
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File','DESC')->where('Id_Cliente','=',$id)
														 ->where('userSubmit','=',$stringSubmitCoord)
														 ->where('state','=',$stateActive)->paginate(25);
		}

		return View::make('admin.Clientes.filesReceived', array(
											'imagen' => $imagen,
											'cliente' => $cliente,
											'archivos' => $archivos
											));
	}



	// FUNCION QUE MUESTRA LOS ARCHIVOS ENVIADOS DEL CLIENTE SELECCIONADO
	public function viewFilesSubmitClient($id)
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
    	$imagen = $img->imgperfil;

		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateActive = 0;
		$stringSubmitClient = 'submitClient';

		if(isset($_GET['buscar']))
		{
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File','DESC')
								->where('Id_Cliente','=',$id)
								->where('userSubmit','=',$stringSubmitClient)
								->where('state','=',$stateActive)->where(function($query)
									{
										$resultado = htmlspecialchars(Input::get('buscar'));

										$query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                							->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                							->orwhere('Id_Coordinador', 'LIKE', '%'.$resultado.'%' );
                
									})->paginate(15);
		}
		else
		{
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File','DESC')->where('Id_Cliente','=',$id)
														 ->where('userSubmit','=',$stringSubmitClient)
														 ->where('state','=',$stateActive)->paginate(25);
		}

		return View::make('admin.Clientes.filesSubmit', array(
											'imagen' => $imagen,
											'cliente' => $cliente,
											'archivos' => $archivos
											));
	}


	// FUNCION QUE MUESTRA LOS ARCHIVOS ENVIADOS DEL CLIENTE SELECCIONADO
	public function viewFilesDeletedClient($id)
	{
		$img = Administrador::find(Auth::userAdmin()->get()->id);
    	$imagen = $img->imgperfil;

		$cliente = Cliente::find($id);
		$id = $cliente->id;
		$stateInactive = 1;

		if(isset($_GET['buscar']))
		{
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File','DESC')
								->where('Id_Cliente','=',$id)
								->where('state','=',$stateInactive)->where(function($query)
									{
										$resultado = htmlspecialchars(Input::get('buscar'));

										$query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                							->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                							->orwhere('Id_Coordinador', 'LIKE', '%'.$resultado.'%' )
                							->orwhere('userSubmit', 'LIKE', '%'.$resultado.'%' );
                
									})->paginate(15);
		}
		else
		{
			$model = new Archivo;
			$archivos = $model->orderBy('Id_File','DESC')->where('Id_Cliente','=',$id)
														 ->where('state','=',$stateInactive)->paginate(25);
		}

		return View::make('admin.Clientes.filesEliminados', array(
											'imagen' => $imagen,
											'cliente' => $cliente,
											'archivos' => $archivos
											));
	}
	
	

}

?>