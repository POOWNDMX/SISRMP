<?php
use Carbon\Carbon;
/**
* 
*/
class StatisticsCoordinadorController extends BaseController
{

	// Función que muestr estadisticas de los archivos del coordinador de selección
    public function indexPanel($id)
	{
		$date = Carbon::now();
        $dateAct = $date->format('l j F Y h:i:s a');
		$img = Administrador::find(Auth::userAdmin()->get()->id);
    	$imagen = $img->imgperfil;

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


		return View::make('admin.Coordinadores.estadisticasPanel', array(
								'imagen' => $imagen, 
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
							));
	}

	 
    

    // Funcion que muestra los archivos del coordinador de selección.
    public function viewFilesMine($id)
    {
      
      $coordinador = Coordinador::find($id);
      $model = new Archivo;
      $img = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $img->imgperfil;
      

      if(isset($_GET['buscar']))
        {
            $model = new Archivo;
            $viewMyFiles = $model::orderBy('Id_File','DESC')->where('Id_Coordinador','=',$id)->where('state','=',0)->where( function($query) 
            {

                $resultado = htmlspecialchars(Input::get('buscar'));

                $query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                ->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                ->orwhere('Id_Cliente', 'LIKE', '%'.$resultado.'%' )
                ->orwhere('userSubmit', 'LIKE', '%'.$resultado.'%' );
                
            })->paginate(15);
        }
        else
        { 
          
          $model = new Archivo;
          $viewMyFiles = $model->orderBy('Id_File','DESC')->where('Id_Coordinador','=',$id)->where('state','=',0)->paginate(25);
        } 

        return View::make('admin.Coordinadores.files', array(
                        'viewMyFiles' => $viewMyFiles, 
                        'coordinador' => $coordinador,
                        'imagen' => $imagen                        
                        ));
    }


    // Funcion que muestra archivos (Elementos recibidos), Enviados por el cliente.
    public function viewMyFilesReceived($id)
    {
        $img = Administrador::find(Auth::userAdmin()->get()->id);
        $imagen = $img->imgperfil;

        $coordinador = Coordinador::find($id);
        $id = $coordinador->id;
        $stateActive = 0;
        $stringUserClient = 'submitClient';        

        if(isset($_GET['buscar']))
        {
            $model = new Archivo;
            $archivos = $model->where('Id_Coordinador','=',$id)->where('userSubmit','=',$stringUserClient)
                              ->where('state','=',$stateActive)->where(function($query)
                                {
                                    $resultado = htmlspecialchars(Input::get('buscar'));

                                    $query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                                    ->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                                    ->orwhere('Id_Cliente', 'LIKE', '%'.$resultado.'%' );
                                
                                })->paginate(15);
        }
        else 
        {
            
            $model = new Archivo;
            $archivos = $model->where('Id_Coordinador','=',$id)->where('userSubmit','=',$stringUserClient)
                              ->where('state','=',$stateActive)->paginate(25);
        }
       
        return View::make('admin.Coordinadores.filesReceived', array(
                                'coordinador' => $coordinador,
                                'archivos' => $archivos,
                                'imagen' => $imagen
                                ));
    }

    // Funcion que muestra archivos (Elementos enviados), Enviados por el coordinador.
    public function viewMyFilesSubmit($id)
    {
        $img = Administrador::find(Auth::userAdmin()->get()->id);
        $imagen = $img->imgperfil;

        $coordinador = Coordinador::find($id);
        $id = $coordinador->id;
        $stateActive = 0;
        $stringUserCoord = 'submitCoord';  

        if(isset($_GET['buscar']))
        {
            $model = new Archivo;
            $archivos = $model->where('Id_Coordinador','=',$id)->where('userSubmit','=',$stringUserCoord)
                              ->where('state','=',$stateActive)->where(function($query)
                                {
                                    $resultado = htmlspecialchars(Input::get('buscar'));

                                    $query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                                    ->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                                    ->orwhere('Id_Cliente', 'LIKE', '%'.$resultado.'%' );
                                
                                })->paginate(15);
        }
        else 
        {

            $model = new Archivo;
            $archivos = $model->where('Id_Coordinador','=',$id)->where('userSubmit','=',$stringUserCoord)
                              ->where('state','=',$stateActive)->paginate(25);

        }

        return View::make('admin.Coordinadores.filesSubmit', array(
                            'coordinador' => $coordinador,
                            'archivos' => $archivos,
                            'imagen' => $imagen
            ));         
    }


    // Funcion que muestra los archivos eliminados por algun usuario (Cliente o coordinador), pero que pertenecen a ese coordinador.
    public function viewMyFilesDeletedForAnyUsers($id)
    {
        $img = Administrador::find(Auth::userAdmin()->get()->id);
        $imagen = $img->imgperfil;

        $coordinador = Coordinador::find($id);
        $id = $coordinador->id;
        $stateInactive = 1;

        if(isset($_GET['buscar']))
        {
            $model = new Archivo;
            $archivos = $model->orderBy('updated_at', 'DESC')->where('Id_Coordinador','=',$id)->where('state','=',$stateInactive)
                              ->where(function($query)
                              {

                                $resultado = htmlspecialchars(Input::get('buscar'));
                                $query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')

                                    ->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                                    ->orwhere('Id_Cliente', 'LIKE', '%'.$resultado.'%' )
                                    ->orwhere('userSubmit', 'LIKE', '%'.$resultado.'%' );

                              })->paginate(15);
        }
        else 
        {   
            $model = new Archivo;
            $archivos = $model->orderBy('updated_at', 'DESC')->where('Id_Coordinador','=',$id)->where('state','=',$stateInactive)->paginate(25);
        }

        return View::make('admin.Coordinadores.filesEliminados', array(
                            'coordinador' => $coordinador,
                            'archivos' => $archivos,
                            'imagen' => $imagen 
            ));
    }




}

?>