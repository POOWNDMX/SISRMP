<?php
use Carbon\Carbon;
/**
* 
*/
class UserCdrConfigController extends BaseController
{

  
	public function index()
  	{
    
    return View::make('coordinador.actividad');
  	}



 	  public function userProfile()
  	{

  	  $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
      $imagenPerfil = $coordinador->imgperfil;
      $departamento = $coordinador->departament;

      $model = new Archivo;
      $id = $coordinador->id;
      $totalFiles = $model->where('Id_Coordinador','=',$id)->where('state','=',0)->count();
     
    
      return View::make('coordinador.verPerfil', array(
                            'coordinador' => $coordinador, 
                            'imagenPerfil' => $imagenPerfil, 
                            'departamento' => $departamento, 
                            'totalFiles' => $totalFiles,
                          ));
  	}



  	public function updatedProfile(){

  		$coordinador = Coordinador::find(Auth::userCoord()->get()->id);
  		$id = $coordinador->id;

  		$reglas = array(

			  'Nombre'        => 'required',
			  'Apellidos'     => 'required',
			  'Correo'        => 'required | unique:coordinador,Correo,'.$id.',id', 
			  'username'       => 'required | between: 8,13 | alpha_custom | unique:coordinador,username,'.$id.',id'
			
			); 

		
		  $mensajes = array(
			
			  'Nombre.required' => '<div class="alert alert-danger-inputs">
                                  <strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio.
                              </div>',
			  'Apellidos.required' => '<div class="alert alert-danger-inputs">
                                    <strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio. 
                                </div>',
			  'Correo.required' => '<div class="alert alert-danger-inputs">
                                  <strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio. 
                              </div>',
			  'Correo.unique' => '<div class="alert alert-warning-inputs">
                              <strong>¡Error! </strong> Este correo ya está asociado a otra cuenta.
                            </div>',
        'username.required' => '<div class="alert alert-danger-inputs">
                                  <strong>¡Error! </strong> El campo <strong>usuario</strong> es obligatorio. 
                                </div>',
        'username.between' => '<div class="alert alert-danger-inputs">
                                  <strong>¡Error! </strong> El <strong>usuario</strong> debe ser entre 8 y 13 caracteres.
                               </div>',
        'username.alpha_custom' => '<div class="alert alert-danger-inputs">
                                        <strong>¡Error! </strong> El <strong>usuario</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, +, -, .).
                                    </div>',
        'username.unique' => '<div class="alert alert-warning-inputs">
                                  <strong>¡Error! </strong> Este <strong>usuario</strong>, ya está asociado a otra cuenta.
                              </div>'

      );

      $validator = Validator::make(Input::all(), $reglas, $mensajes); 

        // Procesa el validador
        if ($validator->fails()) {
            // Si falla el validador retorna a la misma vista con los posibles errores de validacion.
            return Redirect::to('coordinador/userProfile')->withErrors($validator)->withInput();
                   
        } 

        else {

            $archivo = Input::file('imgperfil');

            if(!empty($archivo)){

               		$date = Carbon::now();
               		$dateModif = $date->toDateTimeString();
                  $dateFormat = $date->format('d-m-Y h-i-s A');
               
               		$destinoPath = public_path().'/imagenPERFILcoord/';

                  $id = Auth::userCoord()->get()->id;
               		$fileName = $archivo->getClientOriginalName();
                  $nameEncrypt = sha1($fileName);
               		$extension = $archivo->getClientOriginalExtension();
                  //$secureName = Hash::make($file->getClientOriginalName());
                  
               		$subir = $archivo->move($destinoPath,$nameEncrypt.'-'.$dateFormat.'-ID'.$id.'-.'.$extension);


                	$coordinador = Coordinador::find(Auth::userCoord()->get()->id);
                	$coordinador->Nombre 	 		= Input::get('Nombre');
                	$coordinador->Apellidos   		= Input::get('Apellidos');
                	$coordinador->Correo  			= Input::get('Correo');
                	$coordinador->imgperfil  		= $nameEncrypt.'-'.$dateFormat.'-ID'.$id.'-.'.$extension;
                	$coordinador->username    		= Input::get('username');
                	$coordinador->last_modification = $dateModif;
                  $coordinador->UserUpdated = Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos;
                	$coordinador->save();

                	Session::flash('message', ' Información: ¡ Tus datos fueron actualizados con éxito !');
               		return Redirect::to('coordinador/userProfile');

           		}

           		else{

                	$date = Carbon::now();
                	$dateModif = $date->toDateTimeString();
                  $coordinadorUpdated = Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos;

                	$coordinador = Coordinador::find(Auth::userCoord()->get()->id);
                	$coordinador->Nombre 	 		= Input::get('Nombre');
                	$coordinador->Apellidos   		= Input::get('Apellidos');
                	$coordinador->Correo  			= Input::get('Correo');
                	$coordinador->username    		= Input::get('username');
                	$coordinador->last_modification = $dateModif;
                  $coordinador->UserUpdated = $coordinadorUpdated;
                	$coordinador->save();
                

                	Session::flash('message', ' Información: ¡ Tus datos fueron actualizados con éxito !');
               		return Redirect::to('coordinador/userProfile');
             	}
       		}	

  	}

        




                            // FUNCIONES PARA EDITAR CONTRASEÑA DE COORDINADOR AUTENTICADO

    public function viewEditPasswd(){

      $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
      $imagenPerfil = $coordinador->imgperfil;
      $date = Carbon::now();
      $dateFormat = $date->format('l j F Y h:i:s a');

      return View::make('coordinador.cambiarPasswd', array(
                                          'imagenPerfil' => $imagenPerfil, 
                                          'coordinador' => $coordinador,
                                          'dateFormat' => $dateFormat
                                          ));

    }

    public function updatePasswd()
    {
        $coordinador = Coordinador::find(Auth::userCoord()->get()->id);
        $password = $coordinador->password;
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
          
           return Redirect::to('coordinador/myPassword/change')->withErrors($validator)->withInput();
                   
        } 
        else {

            $passwordAct = Input::get('passwordAct');

            if (Hash::check($passwordAct, $password)) {

                $coordinadorUpdated = Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos;

                $coordinadorAuth = Coordinador::find(Auth::userCoord()->get()->id);
                $coordinadorAuth->password  = Hash::make(Input::get('newPassword'));
                $coordinadorAuth->UserUpdated = $coordinadorUpdated;
                $coordinadorAuth->last_modification = $dateModif;
                $coordinadorAuth->save();

                if($coordinadorAuth->save()){

                    return Redirect::to('coordinador/myPassword/change')->with('messageSuccessPasswd', ' Información: ¡ La nueva contraseña se registró correctamente !');
                }

                else {

                     return Redirect::to('coordinador/myPassword/change')->with('messageFallo', ' Información: <strong>¡ Error !</strong> - La nueva contraseña no se pudo guardar !');
                }
            }
            else {

                 return Redirect::to('coordinador/myPassword/change')->with('messageWarningPasswd', '<strong> ¡ Error ! </strong> - La contraseña actual no es correcta ');
            }
        }
    }


    // Funcion para mostrar detalle del cliente
    public function detalleMyCliente($Cliente_Id)
    {
      $coordinadorAuth = Coordinador::find(Auth::userCoord()->get()->id);      
      $imagenPerfil = $coordinadorAuth->imgperfil;

      $cliente = Cliente::find($Cliente_Id);
      $imagen = $cliente->imgperfil;

      $imagenPerfilPath = public_path().'/imagenPERFILcliente/'.$imagen;

      return View::make('coordinador.detalleCliente', array('cliente' => $cliente, 
                                                            'imagenPerfil' => $imagenPerfil,
                                                            'imagen' => $imagen,
                                                            'imagenPerfilPath' => $imagenPerfilPath
                                                            ));
    }




                            // Funcion para eliminar imagen del perfil

    public function deleteMyImage(){

        $coordinadorAuth = Coordinador::find(Auth::userCoord()->get()->id);
        $imagenPerfil = $coordinadorAuth->imgperfil;

        $date = Carbon::now();
        $dateModif = $date->toDateTimeString();

        $model = new Coordinador;
        $imagen = $model->where('imgperfil','=',$imagenPerfil);

        $dieleteImage = $imagen->update(array(
                            'imgperfil' => null,
                            'last_modification' => $dateModif,
                            'UserUpdated' => Auth::userCoord()->get()->Nombre.' '.Auth::userCoord()->get()->Apellidos
          ));

        return Redirect::to('coordinador/userProfile')->with('message', ' Información: ¡ La imágen se elimino correctamente !');

    }



    
}

                    