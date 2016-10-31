<?php
use Carbon\Carbon;
/**
* 
*/
class UserClientConfigController extends BaseController
{

	public function userProfile()
  	{

  	  $cliente = Cliente::find(Auth::userCliente()->get()->id);
      $imagenPerfil = $cliente->imgperfil;

      $model = new Archivo;
      $id = $cliente->id;
      $totalFiles = $model->where('Id_Cliente','=',$id)->where('state','=',0)->count();
     
    
      return View::make('cliente.verPerfil', array(
                            'cliente' => $cliente, 
                            'imagenPerfil' => $imagenPerfil,
                            'totalFiles' => $totalFiles,
                          ));
  	}




  	  	public function updatedProfile()
  	  	{

  			$cliente = Cliente::find(Auth::userCliente()->get()->id);
  			$id = $cliente->id;

            $archivo = Input::file('imgperfil');

            if(!empty($archivo)){

               	$date = Carbon::now();
               	$dateModif = $date->toDateTimeString();
                $dateFormat = $date->format('d-m-Y h-i-s A');
               
               	$destinoPath = public_path().'/imagenPERFILcliente/';

                $id = Auth::userCliente()->get()->id;
               	$fileName = $archivo->getClientOriginalName();
                $nameEncrypt = sha1($fileName);
               	$extension = $archivo->getClientOriginalExtension();                
                  
               	$subir = $archivo->move($destinoPath,$nameEncrypt.'-'.$dateFormat.'-ID'.$id.'-.'.$extension);

                $cliente = Cliente::find(Auth::userCliente()->get()->id);                
                $cliente->imgperfil  		= $nameEncrypt.'-'.$dateFormat.'-ID'.$id.'-.'.$extension;
                $cliente->last_modification = $dateModif;
                $cliente->UserUpdated = Auth::userCliente()->get()->NombreEmpresa;
                $cliente->save();

                	Session::flash('message', ' Información: ¡ Tus datos fueron actualizados con éxito !');
               		return Redirect::to('cliente/userProfile');

           		}

           		else{

                	Session::flash('message', ' Información: ¡ Tus datos fueron actualizados con éxito !');
               		return Redirect::to('cliente/userProfile');
             	}
       		}



          // FUNCIONES PARA EDITAR CONTRASEÑA DE COORDINADOR AUTENTICADO

    public function viewEditPasswd(){

      $cliente = Cliente::find(Auth::userCliente()->get()->id);
      $imagenPerfil = $cliente->imgperfil;
      $date = Carbon::now();
      $dateFormat = $date->format('l j F Y h:i:s a');

      return View::make('cliente.cambiarPasswd', array(
                                          'imagenPerfil' => $imagenPerfil, 
                                          'cliente' => $cliente,
                                          'dateFormat' => $dateFormat
                                          ));

    }

    public function updatePasswd()
    {
        $cliente = Cliente::find(Auth::userCliente()->get()->id);
        $password = $cliente->password;
        $date = Carbon::now();
        $dateModif = $date->toDateTimeString();

        $reglas = array(

            'passwordAct' => 'required',
            'newPassword' => 'required | min:10 | max:15 | alpha_custom | confirmed '
        ); 

        $mensajes = array(

            'passwordAct.required' => '<div class="alert alert-danger-inputs">
                                          <strong> ¡Error! </strong> El campo <strong>Contraseña actual</strong> es obligatorio.
                                      </div>',
            'newPassword.required' => '<div class="alert alert-danger-inputs">
                                          <strong> ¡Error! </strong> Los campos <strong>Nueva contraseña</strong> y <strong> confirmación</strong> son obligatorios.
                                      </div>',
            'newPassword.min' => '<div class="alert alert-danger-inputs">
                                          <strong> ¡Error! </strong> La <strong>nueva contraseña</strong> es muy corta, se permite mínimo 10 caracteres.
                                      </div>',
            'newPassword.max' => '<div class="alert alert-danger-inputs">
                                          <strong> ¡Error! </strong> La <strong>nueva contraseña</strong> es muy larga, se permite máximo 15 caracteres.
                                      </div>',
            'newPassword.alpha_custom' => '<div class="alert alert-danger">
                                              <strong> ¡Error! </strong> La <strong>nueva contraseña</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, .).
                                          </div>',
             'newPassword.confirmed' => '<div class="alert alert-danger-inputs">
                                          <strong> ¡Error! </strong> Las <strong>nuevas contraseñas</strong> no coinciden, intenta nuevamente.
                                         </div>'
        );

        $validator = Validator::make(Input::all(), $reglas, $mensajes); 
        
        if ($validator->fails()) {
          
           return Redirect::to('cliente/myPassword/change')->withErrors($validator)->withInput();
                   
        } 
        else {

            $passwordAct = Input::get('passwordAct');

            if (Hash::check($passwordAct, $password)) {
              
                $clienteAuth = Cliente::find(Auth::userCliente()->get()->id);
                $clienteAuth->password  = Hash::make(Input::get('newPassword'));
                $clienteAuth->UserUpdated = Auth::userCliente()->get()->NombreEmpresa;
                $clienteAuth->last_modification = $dateModif;
                $clienteAuth->save();

                if($clienteAuth->save()){

                    return Redirect::to('cliente/myPassword/change')->with('messageSuccessPasswd', ' Información: ¡ La nueva contraseña se registró correctamente !');
                }

                else {

                     return Redirect::to('cliente/myPassword/change')->with('messageFallo', ' Información: <strong>¡ Error !</strong> - La nueva contraseña no se pudo guardar !');
                }
            }
            else {

                 return Redirect::to('cliente/myPassword/change')->with('messageWarningPasswd', '<strong> ¡ Error ! </strong> - La contraseña actual no es correcta ');
            }
        }
    }



    // Funcion para mostrar detalle del cliente
    public function detalleMyCoord($Coordinador_Id)
    {
      $clienteAuth = Cliente::find(Auth::userCliente()->get()->id);      
      $imagenPerfil = $clienteAuth->imgperfil;

      $coordinador = Coordinador::find($Coordinador_Id);
      $imagen = $coordinador->imgperfil;      
      $departamento = $coordinador->departament;

      $imagenPerfilPath = public_path().'/imagenPERFILcoord/'.$imagen;

      return View::make('cliente.detalleCoord', array('coordinador' => $coordinador, 
                                                            'imagenPerfil' => $imagenPerfil,
                                                            'imagen' => $imagen,
                                                            'imagenPerfilPath' => $imagenPerfilPath,
                                                            'departamento' => $departamento
                                                            ));
    }


       		                            // Funcion para eliminar imagen del perfil

    public function deleteMyImage(){

    	$clienteAuth = Cliente::find(Auth::userCliente()->get()->id);
    	$imagenPerfil = $clienteAuth->imgperfil;

    	$date = Carbon::now();
     	$dateModif = $date->toDateTimeString();

    	$model = new Cliente;
    	$imagen = $model->where('imgperfil','=',$imagenPerfil);

    	$deleteImage = $imagen->update(array(
    						'imgperfil' => null, 
     						'last_modification' => $dateModif,
     						'UserUpdated' => Auth::userCliente()->get()->NombreEmpresa
     						));

     		return Redirect::to('cliente/userProfile')->with('message', ' Información: ¡ La imágen se elimino correctamente !');

    }

  	

}

?>