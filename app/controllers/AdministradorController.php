<?php
use Carbon\Carbon;
/**
* 
*/
class AdministradorController extends BaseController
{

  

  public function indexAdmins()
  {
    $userAdmin = Administrador::find(Auth::userAdmin()->get()->id);
    $imagen = $userAdmin->imgperfil;

    $userAlls = Administrador::all();
    $imagenUser = $userAdmin->imgperfil;

    return View::make('admin.Administrador.consultar', array('imagen' => $imagen, 'userAlls' => $userAlls, 'imagenUser' => $imagenUser));
  }



  public function form()
  {
    $userAdmin = Administrador::find(Auth::userAdmin()->get()->id);
    $imagen = $userAdmin->imgperfil;

    return View::make('admin.Administrador.registrar', compact('imagen'));
  }
	
	public function create()
  {
    // llamamos a la función de agregar departamento en el modelo y le pasamos los datos del formulario 
    $respuesta = Administrador::agregarAdministrador(Input::all());

    // Dependiendo de la respuesta del modelo 
    // retornamos los mensajes de error con los datos viejos del formulario 
    // o un mensaje de éxito de la operación 
    if ($respuesta['error'] == true){
        return Redirect::to('admin/admin_user/create')->withErrors($respuesta['mensaje'] )->withInput();
    }
    else {
        return Redirect::to('admin/admin_user/create')->with('mensaje', $respuesta['mensaje']);
    }
  }




    public function show(){

      $userAdmin = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $userAdmin->imgperfil;
    
      return View::make('admin.Administrador.ver', array('userAdmin'=> $userAdmin, 'imagen' => $imagen));

    }




                            // METODO PARA EDITAR PERFIL DE ADMIN AUTENTICADO
    public function edit()
    {

      $administrador = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $administrador->imgperfil;
      $id = $administrador->id;
        
      return View::make('admin.Administrador.edit', array('administrador'=> $administrador, 
                          'imagen'=> $imagen));
    }




    public function update()
    {

      $administrador = Administrador::find(Auth::userAdmin()->get()->id);
      $id = $administrador->id;
      $first_name = $administrador->first_name;
      $last_name = $administrador->last_name;

      $reglas = array( 
        'first_name' => 'required | max:50 ',
        'last_name'  => 'required | max:50 ',
        'username'   => 'required | between:10,20 | alpha_custom | unique:administrador,username,'.$id.',id'
      ); 

      $mensajes = array(
          
        'first_name.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>nombre</strong> es obligatorio.</div>',

        'first_name.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> Máximo 50 caracteres.</div>',

        'last_name.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>apellidos</strong> es obligatorio.</div>',

        'last_name.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> Máximo 50 caracteres.</div>',
            
        'username.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>usuario</strong> es obligatorio.</div>',

        'username.between' => '<div class="alert alert-danger"><strong>¡Error! </strong> El <strong>usuario</strong> debe ser entre 10 y 20 caracteres.</div>',

        'username.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong>El <strong>usuario</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, .).</div>',

        'username.unique' => '<div class="alert alert-danger"><strong>¡Error! </strong> Ya existe una cuenta asociada con este nombre de usuario</div>',

      );

      $validator = Validator::make(Input::all(), $reglas, $mensajes); 

        // Procesa el validador
        if ($validator->fails()) {
            // Si falla el validador retorna a la misma vista con los posibles errores de validacion.
            return Redirect::to('admin/admin_user/editPerfil')->withErrors($validator)->withInput();
        } 
            
        else {
          // pasamos a los campos de la base de datos los nuevos datos de las variables de cada campo.
                
          $file = Input::file('imgperfil');

          if(!empty($file)){

            $date = Carbon::now();
            $dateAct = $date->format('d-m-Y h-i-s A');
            $destinoPath = public_path().'/imagenPERFIL/';
            $filename = $file->getClientOriginalName();
            $subir = $file->move($destinoPath,$dateAct.'-'.$filename);

            $administrador = Administrador::find(Auth::userAdmin()->get()->id);
            $administrador->first_name  = Input::get('first_name');
            $administrador->last_name   = Input::get('last_name');
            $administrador->imgperfil   = $dateAct.'-'.$filename;
            $administrador->username    = Input::get('username');
            $administrador->save();

            if($administrador->save()){
                  
              Session::flash('message', ' Información: ¡ Tus datos fueron actualizados con éxito !');
              return Redirect::to('admin/admin_user/perfil');

            } 
            else {

              Session::flash('messageFallo', ' Información: ¡<strong>Error</strong>! - Tus datos no se pudieron actualizar');
              return Redirect::to('admin/admin_user/perfil');
            }
                

          }
          else{

            $date = Carbon::now();
            $dateModif = $date->toDateTimeString();

            $administrador = Administrador::find(Auth::userAdmin()->get()->id);
            $administrador->first_name  = Input::get('first_name');
            $administrador->last_name   = Input::get('last_name');
            $administrador->username    = Input::get('username');
            $administrador->save();

            if($administrador->save()){

              Session::flash('message', ' Información: ¡ Tus datos fueron actualizados con éxito !');
              return Redirect::to('admin/admin_user/perfil');

            } 
            else {

              Session::flash('messageFallo', ' Información: ¡<strong>Error</strong>! - Tus datos no se pudieron actualizar');
              return Redirect::to('admin/admin_user/perfil');

            }
          }
        }
    }



                            // METODO PARA EDITAR  CONTRASEÑA DE ADMIN AUTENTICADO

    public function editPasswd()
    {
      
      $administrador = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $administrador->imgperfil;
        
      return View::make('admin.Administrador.editarPasswd')->with('administrador', $administrador)->with('imagen', $imagen);
                    
    }


    public function updatePasswd()
    {

      $administrador = Administrador::find(Auth::userAdmin()->get()->id);
      $password = $administrador->password;

      $reglas = array(
          'passwordAct' => 'required',
          'newpassword' => 'required | min:15 | max:20 | alpha_custom | confirmed'
        );

      $mensajes = array(

          'passwordAct.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> Debes escribir la <strong>contraseña</strong> actual</div>',

          'newpassword.required' => '<div class="alert alert-danger"><strong>¡Error! </strong>El campo <strong>nueva contraseña</strong> y <strong>comfirmación</strong> son obligatorios.</div>',

          'newpassword.min' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong> nueva contraseña</strong> está muy corta, se permiten mínimo 15 caracteres.</div>',

          'newpassword.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong> nueva contraseña</strong> está muy larga, se permiten máximo 20 caracteres.</div>',

          'newpassword.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>nueva contraseña</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, .).</div>',

          'newpassword.confirmed' => '<div class="alert alert-danger"><strong>¡Error! </strong> Las <strong>nuevas contraseñas</strong> no coinciden, intenta de nuevo.</div>'
        );

      $validator = Validator::make(Input::all(), $reglas, $mensajes); 

        // Procesa el validador
        if ($validator->fails()) {
          // Si falla el validador retorna a la misma vista con los posibles errores de validacion.
          return Redirect::to('admin/admin_user/editPasswd')->withErrors($validator)->withInput();
                   
        } 
        else {

          #$passwordAct = Hash::check(Input::get('passwordAct'), Auth::user()->password );
          $passwordAct = Input::get('passwordAct');

          if (Hash::check($passwordAct, $password)) {
                   
            $administrador = Administrador::find(Auth::userAdmin()->get()->id);
            $administrador->password  = Hash::make(Input::get('newpassword'));
            $administrador->save();

            if($administrador->save()){

              return Redirect::to('admin/admin_user/perfil')->with('messageSuccessPasswd', ' Información: ¡ La nueva contraseña se registró correctamente !');

            } else {

              return Redirect::to('admin/admin_user/editPasswd')->with('messageFallo', ' Información: ¡<strong>Error</strong>! - La nueva contraseña no se pudo guardar !');

            }        
          }

          else{ 

          return Redirect::to('admin/admin_user/editPasswd')->with('messageWarningPasswd', '<strong> ¡ Error ! </strong> - La contraseña actual no es correcta ');
                
          }
        }
    }

                      
                      // FUNCION PARA EDITAR EL PASSWORD DE OTROS ADMINISTRADORES

    public function userEditPasswd($id){

        $userAdministrador = Administrador::find($id); // Usuario admin
        $administrador = Administrador::find(Auth::userAdmin()->get()->id); // Usuario admin autenticado
        $imagen = $administrador->imgperfil; // Buscamos la imagen del usuario admin autenticador
        return View::make('admin.Administrador.UserEditarPasswd', array(
                                                      'userAdministrador' => $userAdministrador,
                                                      'imagen' => $imagen));
    }


    public function userUpdatePasswd($id)
    {
    
      $reglas = array(
          'password' => 'required | min:15  | max:20 | alpha_custom | confirmed'
      );

      $mensajes = array(

          'password.required' => '<div class="alert alert-danger"><strong>¡Error! </strong>El campo <strong>nueva contraseña</strong> y <strong>comfirmación</strong> son obligatorios.</div>',

          'password.min' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong> nueva contraseña</strong> está muy corta, se permiten mínimo 15 caracteres.</div>',

          'password.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong> nueva contraseña</strong> está muy larga, se permiten máximo 20 caracteres.</div>',

          'password.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>nueva contraseña</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, .).</div>',

          'password.confirmed' => '<div class="alert alert-danger"><strong>¡Error! </strong> Las <strong>nuevas contraseñas</strong> no coinciden, intenta de nuevo.</div>'
      );

      $validator = Validator::make(Input::all(), $reglas, $mensajes);

        // Procesa el validador
        if ($validator->fails()) {
           // Si falla el validador retorna a la misma vista con los posibles errores de validacion.
            return Redirect::to('admin/admin_user/'.$id.'/editPasswd')->withErrors($validator);
                   
        } 
        else {
            // pasamos a los campos de la base de datos los nuevos datos de las variables de cada campo.
            $password = Input::get('password');

            $administrador = Administrador::find($id);
            $administrador->password  = Hash::make($password);
            $administrador->save();
            //Crypt::encrypt('Contrasena'); puras letras y numeros
            //Hash::make('Contrasena'); letras, numeros y signos de pesos.
    
            if($administrador->save()){

              Session::flash('message', 'Información: ¡ La contraseña del administrador [ ' .$administrador->first_name. ' ' .$administrador->last_name. ' ] con el Id [ '. $administrador->id . ' ] se ha modificado correctamente en la Base de Datos !');
               return Redirect::to('admin/admin_user/store');

            } else {

              Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - La contraseña del administrador no se pudo modificar');
               return Redirect::to('admin/admin_user/'.$id.'/editPasswd');
            } 
        }
    }




      // FUNCION PARA ALIMINAR LA IMAGEN DE LA CUENTA DE ADMINISTRADOR
    public function deleteMyImage(){

        $administradorAuth = Administrador::find(Auth::userAdmin()->get()->id);
        $imagenPerfil = $administradorAuth->imgperfil;

        $model = new Administrador;
        $imagen = $model->where('imgperfil','=',$imagenPerfil)->first();

        $deleteImage = $imagen->update(array('imgperfil' => null));

        return Redirect::to('admin/admin_user/perfil')->with('message', ' Información: ¡ La imágen se elimino correctamente !');

    }






      // FUNCION PARA ELIMINAR A UN ADMINISTRADOR
    public function destroy($id)
    {
        $userAdministrador = Administrador::find($id);
        $deleteAdmin = $userAdministrador->delete();

        if($deleteAdmin){

          Session::flash('message', 'Información: ¡El webmaster [ ' .$userAdministrador->first_name.' ' .$userAdministrador->last_name . ' ], con el Id [ ' .$userAdministrador->id. ' ] fue eliminado de la Base de Datos !');
          return Redirect::to('admin/admin_user/store');

        }
        else {

          Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - El webmaster no se pudo eliminar de la base de datos !');
            return Redirect::to('admin/admin_user/store');
        }
    }
   
} // FIN DEL CONTROLADOR



?>

                    