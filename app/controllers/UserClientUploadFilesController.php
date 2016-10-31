<?php
use Carbon\Carbon;
/**
* 
*/
class UserClientUploadFilesController extends BaseController
{

	// FUNCION QUE MUESTRA LOS ARCHIVOS RECIBIDOS DE CUALQUIER COORDINADOR
	public function viewFilesReceived()
	{
		$cliente = Cliente::find(Auth::userCliente()->get()->id);
		$imagenPerfil = $cliente->imgperfil;
		$id = $cliente->id;

		$stringUserCoord = 'submitCoord';
		$stateActive = 0;

		if(isset($_GET['buscar']))
		{
			$model = new Archivo;
			$inFiles = $model->where('Id_Cliente','=',$id)
						  		->where('userSubmit','=',$stringUserCoord)
						  		->where('state','=',$stateActive)->where(function($query)
						  		{
						  			$resultado = htmlspecialchars(Input::get('buscar'));

						  			$query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')
                                	->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                                	->orwhere('Id_Coordinador', 'LIKE', '%'.$resultado.'%' );
						  		
						  		})->paginate(20);
		}
		else {

			$model = new Archivo;
			$inFiles =  $model->orderBy('ID_File','DESC')
						  	->where('Id_Cliente','=',$id)
						  	->where('userSubmit','=',$stringUserCoord)
						  	->where('state','=',$stateActive)
						  	->paginate(35);

		}
		

		return View::make('cliente.verFilesIn', array(
							'imagenPerfil' => $imagenPerfil,
							'inFiles' => $inFiles ));
	}



	
	// FUNCION QUE MUESTRA LOS ARCHIVOS ENVIADOS A CUALQUIER COORDINADOR
	public function viewFilesSubmit()
	{
		$cliente = Cliente::find(Auth::userCliente()->get()->id);
		$imagenPerfil = $cliente->imgperfil;
		$id = $cliente->id;

		$stringUserClient = 'submitClient';
		$stateActive = 0;

		if(isset($_GET['buscar']))
		{
			$model = new Archivo;
			$outFiles = $model->where('Id_Cliente','=',$id)
						  		->where('userSubmit','=',$stringUserClient)
						  		->where('state','=',$stateActive)->where(function($query)
						  		{
						  			$resultado = htmlspecialchars(Input::get('buscar'));

						  			$query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')
                                	->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                                	->orwhere('Id_Coordinador', 'LIKE', '%'.$resultado.'%' );
						  		
						  		})->paginate(20);
		}
		else {

			$model = new Archivo;
			$outFiles =  $model->orderBy('ID_File','DESC')
						  	->where('Id_Cliente','=',$id)
						  	->where('userSubmit','=',$stringUserClient)
						  	->where('state','=',$stateActive)
						  	->paginate(35);

		}
		

		return View::make('cliente.VerFilesOut', array(
							'imagenPerfil' => $imagenPerfil,
							'outFiles' => $outFiles ));
	}



	// FUNCION PARA VER DETALLE DEL ARCHIVO
    public function detalleFile($Id_File)
    {
        $cliente = Cliente::find(Auth::userCliente()->get()->id);
        $imagenPerfil = $cliente->imgperfil;

        $archivo = Archivo::find($Id_File);
        $tamaño = $archivo->clientSize;
        $file = $archivo->nameEncrypt;
        $extension = $archivo->clientOriginalExtension;        
        $envioClienteString = 'submitClient'; 
        $envioCoordString = 'submitCoord';    

        $totalSizeFilesMB = number_format(doubleval($tamaño/1024),3,'.',''); // Conversion del tamaño total Kb a Mg

        // Verificamos si exste el archivo en el servidor para mostrarlo.
        $filePath = public_path().'/files/storageFiles/'.$file;

        return View::make('cliente.detalleFile', array(
                                     'imagenPerfil' => $imagenPerfil,
                                     'archivo' => $archivo,
                                     'file' => $file,
                                     'extension' => $extension,
                                     'envioClienteString' => $envioClienteString,
                                     'envioCoordString' => $envioCoordString,
                                     'totalSizeFilesMB' => $totalSizeFilesMB,
                                     'filePath' => $filePath

                        ));
    }


	// FUNCION QUE MUESTRA MIS COORDINADORES - CLIENTE AUTENTICADO
    public function viewMyCoords(){

        $cliente = Cliente::find(Auth::userCliente()->get()->id);
        $id = $cliente->id;
        $model = new AsignaCliente;
        $viewMyCoords = $model->orderBy('Id_Coordinador', 'DESC')->where('Id_Cliente','=',$id)->get();

       	$cliente = Cliente::find(Auth::userCliente()->get()->id);
        $imagenPerfil = $cliente->imgperfil;

        return View::make('cliente.verMisCoordinadores', array('viewMyCoords' => $viewMyCoords, 'imagenPerfil' => $imagenPerfil));
    }


	 //FUNCION MUESTRA PANEL EXCLUSIVO DE UN COORDINADOR
    public function viewPanelUpload($Coordinador_Id){

        $coordinadorUploading = Coordinador::where('id','=',$Coordinador_Id)->first();

        $cliente = Cliente::find(Auth::userCliente()->get()->id);
        $imagenPerfil = $cliente->imgperfil;
        

        return View::make('cliente.cargaFileMyCoord', array('coordinadorUploading' => $coordinadorUploading, 'imagenPerfil' => $imagenPerfil));
    }



	public function postUploadFile()
	{
		 	$file = Input::file('file');
    	    $date = Carbon::now();
            $dateFormat = $date->format('d-m-Y h-i-s A');
            $enviaCliente = 'submitClient';            
            $id = Auth::userCliente()->get()->id;
            $Coordinador_Id = Input::get('coordinadorDestination');

    	   if(!empty($file))
    	   {
                
                function sanear_string($string)
                {
 
                $string = trim($string);
 
                $string = str_replace(
                    array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                    array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                    $string
                );

                $string = str_replace(
                    array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                    array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                    $string
                );
 
                $string = str_replace(
                    array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                    array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                    $string
                );
 
                $string = str_replace(
                    array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                    array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                    $string
                );
 
                $string = str_replace(
                    array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                    array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                    $string
                );
 
                $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç', '+', '$', '%', '&', '/', '!', '¡', '@', '~', 'º', '[', ']', '{', '}', ';', ':', '´'),
                array('n', 'N', 'c', 'C', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
                $string
                );

                $string = str_replace(
                    array('#', '¿','?', '<code>', "'", '*'),
                    array('', '', '', '', '', ''),
                    $string
                );    
 
                
                return $string;
                }

                $clientOriginalName = $file->getClientOriginalName();// Nombre original del archivo
                $clientOriginalNameSan = sanear_string($clientOriginalName); // Nombre del archivo sin caracteres raros 
    		    $clientOriginalExtension = $file->getClientOriginalExtension();//extension del archivo
                //$mimeType = $file->getMimeType(); // mimetype del archivo (GODADDY NO LO ACEPTA)

    		    $nameEncrypt = sha1($clientOriginalNameSan); //encriptacion del nombre del archivo que ya no tiene caracteres raros
                //En la db se guarda todo en bytes. Se obtiene con el getSize el peso real del archivo y lo dividimos entre 1024 para convertirlo a KB. 
    		    $sizefile = $file->getSize()/1024;

    		    $destinoPath = public_path().'/files/storageFiles/';
    		    $upload = $file->move($destinoPath,$nameEncrypt.'-'.$dateFormat.'-UserId-'.$id.'-NameOrg-'.$clientOriginalNameSan);

    		    $archivo = new Archivo;
    		    $archivo->clientOriginalName = $clientOriginalName;
                $archivo->clientOriginalNameSan = $clientOriginalNameSan;
    		    $archivo->nameEncrypt = $nameEncrypt.'-'.$dateFormat.'-UserId-'.$id.'-NameOrg-'.$clientOriginalNameSan;
    		    $archivo->clientOriginalExtension = $clientOriginalExtension;
    		    $archivo->clientSize = $sizefile;
    		    $archivo->Id_Coordinador = $Coordinador_Id;
    		    $archivo->Id_Cliente = $id;
                $archivo->userSubmit = $enviaCliente;
    		    $archivo->save();
			}
	}



	// FUNCION QUE MUESTRA ESTADISTICAS DEL CLIENTE AUTENTICADO
	public function getStatistics()
	{
		$date = Carbon::now();
        $dateFormat = $date->format('l j F Y h:i:s a');

        $cliente = Cliente::find(Auth::userCliente()->get()->id);
        $id = $cliente->id;
        $imagenPerfil = $cliente->imgperfil;
        $model = new Archivo;
        $stringUserClient = 'submitclient';
        $stringUserCoord = 'submitCoord';
        //Contamos los archivos en total donde el estado es 0
        $totalFiles = $model->where('Id_Cliente','=',$id)->where('state','=',0)->count();
        //Sumamos la coumna clientSize de los archivos donde el estado es igual a 0
        $sizeColumn = $model->where('Id_Cliente','=',$id)->where('state','=',0)->sum('clientSize');
        $totalSizeColumnMb = number_format(doubleval($sizeColumn/1024),3,'.','');
        $totalSizeColumnGb = number_format(doubleval(($sizeColumn/1024)/1024),3,'.','');
        
        //Contamos los archivos en total de (Bandeja de entrada) donde el estado es igual a 0 y ademas la cadena de la columna enviaCliente es igual a submitcoord (emitio coordinador.)
        $totalFilesIn = $model->where('Id_Cliente','=',$id)
                              ->where('userSubmit','=',$stringUserCoord)
                              ->where('state','=',0)
                              ->count();
        //Sumamos la columna clientSize donde el estado es igual a 0 y ademas la cadena de la columna enviacliente es igual a submitClient (emitio Cliente).
        $sizeColumnFilesIn = $model->where('Id_Cliente','=',$id)
                                  ->where('userSubmit','=',$stringUserCoord)
                                  ->where('state','=',0)
                                  ->sum('clientSize');
        $totalSizeFilesInMb = number_format(doubleval($sizeColumnFilesIn/1024),3,'.','');
        $totalSizeFilesInGb = number_format(doubleval(($sizeColumnFilesIn/1024)/1024),3,'.','');

        //Contamos los archivos en total de (Bandeja de salida) donde el estado es igual a 0 y además a cadena de la columna enviaCoord es igual a submitCoord (emitioCoordinador).
        $totalFilesOut = $model->where('Id_Cliente','=',$id)
                               ->where('state','=',0)
                               ->where('userSubmit','=',$stringUserClient)
                               ->count();

        //Sumamos la columna clientSize deonde el estado es igual a 0 y además la cadena de la columna enviaCoord es igual a submitCoord (emitioCoordinador)
        $sizeColumnFilesOut = $model->where('Id_Cliente','=',$id)
                                  ->where('userSubmit','=',$stringUserClient)
                                  ->where('state','=',0)
                                  ->sum('clientSize');
        $totalSizeFilesOutMb = number_format(doubleval($sizeColumnFilesOut/1024),3,'.','');
        $totalSizeFilesOutGb = number_format(doubleval(($sizeColumnFilesOut/1024)/1024),3,'.','');

        $modelClient = new AsignaCliente;
        $totalCoords = $modelClient->where('Id_Cliente','=',$id)->count();

        return View::make('cliente.estadisticas', array(
        					'imagenPerfil' => $imagenPerfil,
                            'totalFiles' => $totalFiles,
                            'totalSizeColumnMb' => $totalSizeColumnMb,
                            'totalSizeColumnGb' => $totalSizeColumnGb,
                            'totalFilesIn' => $totalFilesIn,
                            'totalSizeFilesInMb' =>$totalSizeFilesInMb,
                            'totalSizeFilesInGb' =>$totalSizeFilesInGb,
                            'totalFilesOut' => $totalFilesOut,
                            'totalSizeFilesOutMb' => $totalSizeFilesOutMb,
                            'totalSizeFilesOutGb' => $totalSizeFilesOutGb,
                            'dateFormat' => $dateFormat,
                            'totalCoords' => $totalCoords
            ));
	}

     // FUNCION PARA ELIMINAR ARCHIVO DEL COORDINADOR AUTENTICADO (CAMBIAR ESTADO 0 A 1 (INACTIVO))
    public function getDeleteFileSt($Id_File)
    {
        $date = Carbon::now();
        $dateModif = $date->toDateTimeString();

        $archivo = Archivo::find($Id_File);
        $model = new Archivo;
        $file = $model->where('Id_File','=',$Id_File);

        $changeState = $file->update(array(
                        'state' => 1, 
                        'updated_at' => $dateModif, 
                        'userDelete' =>  Auth::userCliente()->get()->NombreEmpresa
                                           ));

        if($changeState)
        {
            Session::flash('message', ' Información: ¡ El archivo <strong>'. $archivo->clientOriginalName .'</strong> fue eliminado correctamente !');

            return Redirect::back();
        }

        else{

            Session::flash('messageFallo', ' Información: ¡<strong>Error </strong>! - El archivo <strong>'. $archivo->clientOriginalName .'</strong> no pudo ser eliminado  ');

            return Redirect::back();

        } 
    }


    // FUNCION PARA VISTA DEVELOPED
    public function viewDeveloped()
    {
        $cliente = Cliente::find(Auth::userCliente()->get()->id);
        $id = $cliente->id;
        $imagenPerfil = $cliente->imgperfil;

        return View::make('cliente.developed', array('imagenPerfil' => $imagenPerfil));

    }


}

?>