<?php
use Carbon\Carbon;
/**
* 
*/
class UserCdrUploadFilesController extends BaseController
{



    // FUNCION PARA VER BANDEJA DE SALIDA - COORDINADOR AUTENTICADO
    public function viewFilesOut(){

        $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
        $imagenPerfil = $coordinador->imgperfil;
        $id = $coordinador->id;
        $stringUserCoord = 'submitCoord';

        if(isset($_GET['buscar']))
        {

            $model = new Archivo;           

            $outFiles = $model->orderBy('Id_File','DESC')->where('Id_Coordinador','=',$id)
                           ->where('state','=',0)
                           ->where('userSubmit','=',$stringUserCoord)
                           ->where(function($query){

                                $resultado = htmlspecialchars(Input::get('buscar'));

                                $query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')
                                ->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                                ->orwhere('Id_Cliente', 'LIKE', '%'.$resultado.'%' );

                           })->paginate(20);
        } 
        else {

            $model = new Archivo;

            $outFiles = $model->orderBy('Id_File','DESC')->where('Id_Coordinador','=',$id)
                           ->where('state','=',0)
                           ->where('userSubmit','=',$stringUserCoord)
                           ->paginate(35);

        }

        return View::make('coordinador.verFilesOut', array('imagenPerfil' => $imagenPerfil, 'outFiles' => $outFiles));
    }






    //FUNCION PARA VER BANDEJA DE ENTRADA - COORDINADOR AUTENTICADO
    public function viewFilesIn(){

        $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
        $imagenPerfil = $coordinador->imgperfil;
        $id = $coordinador->id;
        $stringUserClient = 'submitclient';

        if(isset($_GET['buscar']))
        {
            $model = new Archivo;
            $inFiles= $model->orderBy('Id_File','DESC')->where('Id_Coordinador','=',$id)
                            ->where('state','=',0)
                            ->where('userSubmit','=',$stringUserClient)
                            ->where(function($query){

                                $resultado = htmlspecialchars(Input::get('buscar'));

                                $query->where('clientOriginalName', 'LIKE', '%'.$resultado.'%')
                                ->orwhere('clientOriginalExtension', 'LIKE', '%'.$resultado.'%')
                                ->orwhere('Id_Cliente', 'LIKE', '%'.$resultado.'%' );

                            })->paginate(20);
            
        }
        else {

            $model = new Archivo;
            $inFiles = $model->orderBy('Id_File','DESC')->where('Id_Coordinador','=',$id)
                             ->where('state','=',0)
                             ->where('userSubmit','=','submitClient')
                             ->paginate(35);

        }

        return View::make('coordinador.verFilesIn', array('imagenPerfil' => $imagenPerfil, 'inFiles' => $inFiles));
    }


    // FUNCION PARA VER DETALLE DEL ARCHIVO
    public function detalleFile($Id_File)
    {
        $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
        $imagenPerfil = $coordinador->imgperfil;

        $archivo = Archivo::find($Id_File);
        $tamaño = $archivo->clientSize;
        $file = $archivo->nameEncrypt;
        $extension = $archivo->clientOriginalExtension;        
        $envioClienteString = 'submitClient'; 
        $envioCoordString = 'submitCoord';    

        $totalSizeFilesMB = number_format(doubleval($tamaño/1024),3,'.',''); // Conversion del tamaño total Kb a Mg

        // Verificamos si exste el archivo en el servidor para mostrarlo.
        $filePath = public_path().'/files/storageFiles/'.$file;

        return View::make('coordinador.detalleFile', array(
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


    // FUNCION QUE MUESTRA MIS CLIENTES - COORDINADOR AUTENTICADO
    public function viewMyClients(){

        $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
        $id = $coordinador->id;
        $model = new AsignaCliente;
        $viewMyClients = $model->orderBy('Id_Cliente', 'DESC')->where('Id_Coordinador','=',$id)->get();

        $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
        $imagenPerfil = $coordinador->imgperfil;

        return View::make('coordinador.verMisClientes', array('viewMyClients' => $viewMyClients, 'imagenPerfil' => $imagenPerfil));
    }

    
    

    //FUNCION MUESTRA PANEL EXCLUSIVO DE UN CLIENTE
    public function viewPanelUpload($Cliente_Id){

        $clienteUploading = Cliente::where('id','=',$Cliente_Id)->first();

        $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
        $imagenPerfil = $coordinador->imgperfil;
        

        return View::make('coordinador.cargaFileMyClient', array('clienteUploading' => $clienteUploading, 'imagenPerfil' => $imagenPerfil));
    }


    // FUNCION CARGA ARCHIVOS COORDINADORES
    public function postUploadFile()
    {
    
    	    $file = Input::file('file');
    	    $date = Carbon::now();
            $dateFormat = $date->format('d-m-Y h-i-s A');
            $enviaCoordinador = 'submitCoord';            
            $id = Auth::userCoord()->get()->id;
            $Cliente_Id = Input::get('clientDestination');

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

    		    $nameEncrypt = sha1($clientOriginalNameSan); //encriptacion del nombre del archivo sin caracteres raros
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
    		    $archivo->Id_Coordinador = $id;
    		    $archivo->Id_Cliente = $Cliente_Id;
                $archivo->userSubmit = $enviaCoordinador;
    		    $archivo->save();

    	}
    }


    





    // FUNCION QUE MUESTRA ESTADISTICAS DE LA CUENTA DE COORDINADOR AUTENTICADO
    public function getStatistics(){

        $date = Carbon::now();
        $dateFormat = $date->format('l j F Y h:i:s a');

        $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
        $id = $coordinador->id;
        $model = new Archivo;
        $stringUserClient = 'submitclient';
        $stringUserCoord = 'submitCoord';
        //Contamos los archivos en total donde el estado es 0
        $totalFiles = $model->where('Id_Coordinador','=',$id)->where('state','=',0)->count();
        //Sumamos la coumna clientSize de los archivos donde el estado es igual a 0
        $sizeColumn = $model->where('Id_Coordinador','=',$id)->where('state','=',0)->sum('clientSize');
        $totalSizeColumnMb = number_format(doubleval($sizeColumn/1024),3,'.','');
        $totalSizeColumnGb = number_format(doubleval(($sizeColumn/1024)/1024),3,'.','');
        
        //Contamos los archivos en total de (Bandeja de entrada) donde el estado es igual a 0 y ademas la cadena de la columna enviaCliente es igual a submitclient (emitio cliente.)
        $totalFilesIn = $model->where('Id_Coordinador','=',$id)
                              ->where('userSubmit','=',$stringUserClient)
                              ->where('state','=',0)
                              ->count();
        //Sumamos la columna clientSize donde el estado es igual a 0 y ademas la cadena de la columna enviacliente es igual a submitClient (emitio Cliente).
        $sizeColumnFilesIn = $model->where('Id_Coordinador','=',$id)
                                  ->where('userSubmit','=',$stringUserClient)
                                  ->where('state','=',0)
                                  ->sum('clientSize');
        $totalSizeFilesInMb = number_format(doubleval($sizeColumnFilesIn/1024),3,'.','');
        $totalSizeFilesInGb = number_format(doubleval(($sizeColumnFilesIn/1024)/1024),3,'.','');

        //Contamos los archivos en total de (Bandeja de salida) donde el estado es igual a 0 y además a cadena de la columna enviaCoord es igual a submitCoord (emitioCoordinador).
        $totalFilesOut = $model->where('Id_Coordinador','=',$id)
                               ->where('state','=',0)
                               ->where('userSubmit','=',$stringUserCoord)
                               ->count();

        //Sumamos la columna clientSize deonde el estado es igual a 0 y además la cadena de la columna enviaCoord es igual a submitCoord (emitioCoordinador)
        $sizeColumnFilesOut = $model->where('Id_Coordinador','=',$id)
                                  ->where('userSubmit','=',$stringUserCoord)
                                  ->where('state','=',0)
                                  ->sum('clientSize');
        $totalSizeFilesOutMb = number_format(doubleval($sizeColumnFilesOut/1024),3,'.','');
        $totalSizeFilesOutGb = number_format(doubleval(($sizeColumnFilesOut/1024)/1024),3,'.','');

        $modelClient = new AsignaCliente;
        $totalClients = $modelClient->where('Id_Coordinador','=',$id)->count();


        return View::make('coordinador.estadisticas', array(
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
                            'totalClients' => $totalClients
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
                        'userDelete' =>  Auth::userCoord()->get()->Nombre.' '. Auth::userCoord()->get()->Apellidos
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
        $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
        $id = $coordinador->id;
        $imagenPerfil = $coordinador->imgperfil;

        return View::make('coordinador.developed', array('imagenPerfil' => $imagenPerfil));

    }




     


}