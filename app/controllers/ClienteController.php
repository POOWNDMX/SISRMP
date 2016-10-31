<?php
use Carbon\Carbon;
/**
* 
*/
class ClienteController extends BaseController
{
	
  public function form()
  {
    $img = Administrador::find(Auth::userAdmin()->get()->id);
    $imagen = $img->imgperfil; 
    return View::make('admin.Clientes.registrar', compact('imagen'));
  }


	public function index()
	{
		if(isset($_GET['buscar']))
    {
      $resultado = htmlspecialchars(Input::get('buscar'));
      $clientes = Cliente::where('NombreEmpresa', 'LIKE', '%'.$resultado.'%')
                                   
                ->orwhere('RFC', 'LIKE', '%'.$resultado.'%')
                ->orwhere('NombreRepLegal', 'LIKE', '%'.$resultado.'%' )
                ->orwhere('ApellidosRepLegal', 'LIKE', '%'.$resultado.'%' )
                ->orwhere('NombreContacto', 'LIKE', '%'.$resultado.'%' )
                ->orwhere('ApellidosContacto', 'LIKE', '%'.$resultado.'%' )
                ->paginate(10);
    }
    else {

			$clientes = Cliente::orderBy('id', 'DESC')->paginate(15);
		}	
		
      $img = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $img->imgperfil; 
	    return View::make('admin.Clientes.consultar', array('clientes' => $clientes, 'imagen' => $imagen));
	}



  public function show($id)
  {
    $cliente = Cliente::find($id);
    $id = $cliente->id;
    $imgperfil = $cliente->imgperfil;

    $img = Administrador::find(Auth::userAdmin()->get()->id);
    $imagen = $img->imgperfil;     

    $model = new AsignaCliente;
    $coordinadores = $model->where('Id_Cliente','=',$id)->get();

    return View::make('admin.Clientes.ver')->with('cliente', $cliente)
                                          ->with('imagen', $imagen)
                                          ->with('imgperfil', $imgperfil)
                                          ->with('coordinadores', $coordinadores);
  }


  // FUNCION PARA VER IMAGEN DEL PERFIL
    public function viewImagePerfil($id)
    {
      $img = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $img->imgperfil;

      $cliente = Cliente::find($id);
      $imgperfil = $cliente->imgperfil;

      return View::make('admin.Actividad.viewImagePerfilClient', array(
                                'imagen' => $imagen,
                                'cliente' => $cliente, 
                                'imgperfil' => $imgperfil
                                ));
    }





	public function create()
	 {
        $respuesta = Cliente::agregarCliente(Input::all());
       
         if ($respuesta['error'] == true){
            return Redirect::to('admin/Clientes/create')->withErrors($respuesta['mensaje'] )->withInput();
        }else{
            return Redirect::to('admin/Clientes/create')->with('mensaje', $respuesta['mensaje']);
        }
	 }


     
	public function edit($id)
	{
    $administrador = Administrador::find(Auth::userAdmin()->get()->id);
    $imagen = $administrador->imgperfil;

    $cliente = Cliente::find($id);

    return View::make('admin.Clientes.editar', array('cliente' => $cliente, 'imagen' => $imagen));
  }



	public function update($id)
	{
	 	 
		$reglas = array(

			'NombreEmpresa'     => 'required | unique:clientes,NombreEmpresa,'.$id.',id',
			'RFC'               => 'required | alpha_num | between: 12,13 | unique:clientes,RFC,'.$id.',id',
			'DomicilioFiscal'   => 'required',
			'NombreContacto'    => 'required',
			'ApellidosContacto' => 'required',
			'Telefono'          => 'required ',
			'Correo'            => 'required ',// | unique:clientes,Correo,'.$id.',id
			'username'           => 'required | alpha_num | between: 12,13 | unique:clientes,username,'.$id.',id'
			
		); 

		
		$mensajes = array(

			'NombreEmpresa.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>Nombre de empresa</strong> es bligatorio. </div>',

      'NombreEmpresa.unique' => '<div class="alert alert-warning"><strong>¡Error! </strong> La <strong>empresa</strong> que intentabas poner ya se encuentra registrada.</div>',

			'RFC.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>RFC</strong> es obligatorio.</div>',

			'RFC.alpha_num' => '<div class="alert alert-danger"><strong>¡Error!</strong> Solo caracteres [A-Z, 0-9].</div>',

			'RFC.between' => '<div class="alert alert-danger"><strong>¡Error!</strong> El <strong>RFC</strong> debe ser de 12 o 13 caracteres.</div>',

			'RFC.unique' => '<div class="alert alert-warning"><strong>¡Error!</strong> El <strong>RFC</strong> que intentabas poner ya esta asociado a otra cuenta.</div>',

			'DomicilioFiscal.required' => '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>domicilio fiscal</strong> es obligatorio.</div>',

			'NombreContacto.required' => '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>Nombre del contacto</strong> es obligatorio.</div>',
            
      'ApellidosContacto.required' => '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>:attribute</strong> es obligatorio.</div>',
            

      'Telefono.required'  =>  '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>:attribute</strong> es obligatorio.</div>',


      'Correo.required' => '<div class="alert alert-danger"><strong>¡Error!r</strong> El campo <strong>:attribute</strong> es obligatorio.</div>',

      //'Correo.unique' => '<div class="alert alert-warning"><strong>¡Error!</strong> El <strong>:attribute</strong> electrónico que intentabas poner ya esta asociado con otra cuenta.</div>',

      'username.required' => '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>username</strong> es obligatorio.</div>', 

               
      'username.alpha_num' => '<div class="alert alert-danger"><strong>¡Error! </strong>El nombre de usuario debe ser sin espacios, solo se permiten letras, números.</div>',

      'username.between' => '<div class="alert alert-danger"><strong>¡Error!</strong> El <strong>username</strong> debe ser entre 12 y 13 caracteres.</div>',

      'username.unique' => '<div class="alert alert-warning"><strong>¡Error!</strong> El  que <strong>:attribute</strong> intentabas poner ya está asociado a otra cuenta.</div>'
			
			);

		 $validator = Validator::make(Input::all(), $reglas, $mensajes);
            
      if ($validator->fails()) {
               
          return Redirect::to('admin/Clientes/' .$id. '/edit')->withErrors($validator);
                   
      } 
      else {

        $date = Carbon::now();
        $dateModif = $date->toDateTimeString();
         
          $cliente = Cliente::find($id);
          $cliente->NombreEmpresa         = Input::get('NombreEmpresa');
          $cliente->RFC                   = Input::get('RFC');
          $cliente->NombreRepLegal        = Input::get('NombreRepLegal');
          $cliente->ApellidosRepLegal     = Input::get('ApellidosRepLegal');
          $cliente->DomicilioFiscal       = Input::get('DomicilioFiscal');
          $cliente->Domicilio             = Input::get('Domicilio');
          $cliente->RegimenFiscal         = Input::get('RegimenFiscal');
          $cliente->NombreContacto        = Input::get('NombreContacto');
          $cliente->ApellidosContacto     = Input::get('ApellidosContacto');
          $cliente->Telefono              = Input::get('Telefono');
          $cliente->Correo                = Input::get('Correo');
          $cliente->username              = Input::get('username');
          $cliente->UserUpdated           = Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name;
          $cliente->last_modification     = $dateModif;
          $cliente->Observaciones         = Input::get('Observaciones');
          $cliente->save();
    
          if($cliente->save()){

            Session::flash('message', 'Información: ¡ El Cliente [ ' .$cliente->NombreEmpresa. ' ] con el Id [ '. $cliente->id . ' ] se ha modificado correctamente en la Base de Datos !');
            return Redirect::to('admin/Clientes/store');
          }
          else {

            Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - El Cliente no se pudo modificar !');
            return Redirect::to('admin/Clientes/store');
          }
      }
  }



  public function editPasswd($id)
  {
    $cliente = Cliente::find($id);  

    $img = Administrador::find(Auth::userAdmin()->get()->id);
    $imagen = $img->imgperfil; 
    return View::make('admin.Clientes.editarPasswd', compact('cliente'), compact('imagen'));
  }



  public function updatePasswd($id)
  {
     
    $reglas = array(
      'password'        => 'required | min:10 | max:15 | alpha_custom | confirmed'
    ); 

    $mensajes = array(
      
      'password.required' => '<div class="alert alert-danger"><strong>Error</strong> Se requiere una <strong>contraseña</strong></div>',

      'password.min' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> está muy corta, se permiten mínimo 10 caracteres.</div>',

      'password.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> está muy larga, se permiten máximo 15 caracteres.</div>',

      'password.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, +, -, .).</div>',

      'password.confirmed' => '<div class="alert alert-danger"><strong>¡Error! </strong> Las contraseñas no coinciden, intenta de nuevo.</div>'
      
  );

    $validator = Validator::make(Input::all(), $reglas, $mensajes);
            
    if ($validator->fails()) {
               
      return Redirect::to('admin/Clientes/' .$id. '/editPasswd')->withErrors($validator);
                   
    } 
    else {

      $date = Carbon::now();
      $dateModif = $date->toDateTimeString();

        $password = Input::get('password');
        $cliente = Cliente::find($id);
        $cliente->password = Hash::make($password);
        $cliente->UserUpdated = Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name;
        $cliente->last_modification     =  $dateModif;
        $cliente->save();
        
        if($cliente->save()){

            Session::flash('message', 'Información: ¡ La contraseña del Cliente [ ' .$cliente->NombreEmpresa. ' ] con el Id [ '. $cliente->id . ' ] se ha modificado correctamente en la Base de Datos !');
            return Redirect::to('admin/Clientes/store');
        } 
        else {

            Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - La contraseña del Cliente no se pudo modificar');
            return Redirect::to('admin/Clientes/' .$id. '/editPasswd');
        }   
    }
  }





	public function destroy($id)
	{
    $cliente = Cliente::find($id);
    $deleteCliente = $cliente->delete();

    if($deleteCliente){

      Session::flash('message', 'Información: ¡ El Cliente [ ' .$cliente->NombreEmpresa.' ] con el Id [ ' .$cliente->id . ' ] fue eliminado de la Base de Datos !');
      return Redirect::to('admin/Clientes/store');
    }
    else {

      Session::flash('message', 'Información: ¡<strong>Error</strong>! - El cliente no se pudo eliminar');
      return Redirect::to('admin/Clientes/store');

    }

        

	   }
}

?>