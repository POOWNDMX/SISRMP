<?php

/**
* 
*/
class AsignaclienteController extends BaseController
{

     public function index()
    {
        if(isset($_GET['buscar']))
        {
            $resultado = htmlspecialchars(Input::get('buscar'));
            $asignados = AsignaCliente::where('Id_Coordinador', 'LIKE', '%'.$resultado.'%')
                                         ->paginate(20);
        }
        else{

        $asignados = AsignaCliente::orderBy('Id_FolioCC', 'DESC')->paginate(30);
        }

        $img = Administrador::find(Auth::userAdmin()->get()->id);
        $imagen = $img->imgperfil;
        return View::make('admin.Asigna.CCAsignados', array('asignados' => $asignados, 'imagen' => $imagen, 
            
            ));
    }

    


    public function mostrarCoordCliente()
	{
		
		$coordinadores = Coordinador::orderBy('Apellidos', 'ASC')->get();
        $clientes = Cliente::orderBy('NombreEmpresa', 'ASC')->get();

        $img = Administrador::find(Auth::userAdmin()->get()->id);
        $imagen = $img->imgperfil; 
        
        return View::make('admin.Asigna.AsignaClientes', array('coordinadores' => $coordinadores, 'clientes'=> $clientes, 'imagen' => $imagen));
	}





	
	public function create()
	{
		
        $respuesta = AsignaCliente::agregarAsignacion(Input::all());
        
        if ($respuesta['error'] == true){
            return Redirect::to('admin/Asignar/create')->withErrors($respuesta['mensaje'] )->withInput();
        }else{
            return Redirect::to('admin/Asignar/create')->with('mensaje', $respuesta['mensaje']);
        }
	}


    public function destroy($Id_FolioCC)
    {
        $asignaClientes = AsignaCliente::find($Id_FolioCC);
        $deleteAsignacion = $asignaClientes->delete();

        if($deleteAsignacion){

            Session::flash('message', 'Información: ¡La asignacion [ ' .$asignaClientes->Id_Cliente.' - ' .$asignaClientes->Id_Coordinador . ' ], con el Id [ ' .$asignaClientes->Id_FolioCC. ' ] fue eliminado de la Base de Datos !');
            return Redirect::to('admin/Asignar/store');
        }
        else {

            Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - La asignacion no se pudo eliminar de la Base de Datos');
            return Redirect::to('admin/Asignar/store');

        }         
    }
}

?>