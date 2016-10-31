<?php
use Carbon\Carbon;
/**
* 
*/
class CoordinadorController extends BaseController
{
	
    public function index()
	  {
	      if(isset($_GET['buscar']))
        {
            $resultado = htmlspecialchars(Input::get('buscar'));
            $coordinadores = Coordinador::where('Nombre', 'LIKE', '%'.$resultado.'%')
                                         ->orwhere('Apellidos', 'LIKE', '%'.$resultado.'%')
                                         ->orwhere('Correo', 'LIKE', '%'.$resultado.'%' )
                                         ->paginate(7);
        }
        else
        {
          $coordinadores = Coordinador::orderBy('id', 'DESC')->paginate(7);       
        }
        $img = Administrador::find(Auth::userAdmin()->get()->id);
        $imagen = $img->imgperfil;  

        
        return View::make('admin.Coordinadores.consultar', array('coordinadores' => $coordinadores, 'imagen' => $imagen
          ));
	  }


    public function show($id)
    {
      $coordinador = Coordinador::find($id);
      $departamento = $coordinador->departament;
      $imgPerfilCoord = $coordinador->imgperfil;
      $id = $coordinador->id;

      $img = Administrador::find(Auth::userAdmin()->get()->id);      
      $imagen = $img->imgperfil; 

      $model = new AsignaCliente;
      $clientes = $model->where('Id_Coordinador','=',$id)->get();      
          
      return View::make('admin.Coordinadores.ver', array('coordinador' => $coordinador, 'departamento'=> $departamento, 'imagen' => $imagen, 'imgPerfilCoord' => $imgPerfilCoord, 'clientes' => $clientes));  
    }

    // FUNCION PARA VER IMAGEN DEL PERFIL
    public function viewImagePerfil($id)
    {
      $img = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $img->imgperfil;

      $coordinador = Coordinador::find($id);
      $imgperfil = $coordinador->imgperfil;

      return View::make('admin.Actividad.viewImagePerfilCoord', array(
                                'imagen' => $imagen,
                                'coordinador' => $coordinador, 
                                'imgperfil' => $imgperfil,
                                'coordinador' => $coordinador
                                ));
    }




	  public function mostrarCoordRegistro()
	  {
		# code...
		  $img = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $img->imgperfil;
      $departamentos = Departamento::all();
      return View::make('admin.Coordinadores.registrar', array('departamentos'=> $departamentos, 'imagen' => $imagen));
	   }



	  public function create()
    {
       
      $respuesta = Coordinador::agregarCoordinador(Input::all());

      if ($respuesta['error'] == true){
          return Redirect::to('admin/Coordinadores/create')->withErrors($respuesta['mensaje'] )->withInput();
      }else{
          return Redirect::to('admin/Coordinadores/create')->with('mensaje', $respuesta['mensaje']);
      }
    }
     
     


    public function edit($id)
    {
      
      $coordinador = Coordinador::find($id); 
      $img = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $img->imgperfil;  

      $departamento = $coordinador->departament;
      $departamentos = Departamento::all();

      return View::make('admin.Coordinadores.editar', array('coordinador' => $coordinador, 'imagen' => $imagen, 'departamentos' => $departamentos, 'departamento' => $departamento));
    }

     
    public function update($id)
    {

      $reglas = array(

        'Nombre'        => 'required',
        'Apellidos'     => 'required',
        'Correo'        => 'required | unique:coordinador,Correo,'.$id.',id',
        'username'       => 'required | between: 9,15 | alpha_custom | unique:coordinador,username,'.$id.',id'
                
      ); 

                
      $mensajes = array(
     
        'Nombre.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio. </div>',

        'Apellidos.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio. </div>',

        'Correo.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio. </div>',

        'Correo.unique' => '<div class="alert alert-warning"><strong>¡Error! </strong> El correo electrónico que intentabas poner ya esta asociado con otra cuenta.</div>',

        'username.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>usuario</strong> es obligatorio. </div>',

        'username.unique' => '<div class="alert alert-warning"><strong>¡Error! </strong> El usuario que intentabas poner ya está asociado con otra cuenta.</div>',

        'username.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong> El <strong>:attribute</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, +, -, .).</div>', 

        'username.between' => '<div class="alert alert-danger"><strong>¡Error! </strong> El nombre de usuario debe ser entre 9 y 15 caracteres </div>'

      );

      $validator = Validator::make(Input::all(), $reglas, $mensajes);

        // Procesa el validador
        if ($validator->fails()) {
          // Si falla el validador retorna a la misma vista con los posibles errores de validacion.
          return Redirect::to('admin/Coordinadores/' .$id. '/edit')->withErrors($validator);
                   
        } 
        else {
          // pasamos a los campos de la base de datos los nuevos datos de las variables de cada campo.
            $Nuevo_Id_Depto = Input::get('Nuevo_Id_Depto');
        
            if (!empty($Nuevo_Id_Depto)) {

              $date = Carbon::now();
              $dateModif = $date->toDateTimeString();              

              $coordinador = Coordinador::find($id);
              $coordinador->Nombre = Input::get('Nombre');
              $coordinador->Apellidos  = Input::get('Apellidos');
              $coordinador->Correo = Input::get('Correo');
              $coordinador->Id_Depto = Input::get('Nuevo_Id_Depto');
              $coordinador->username = Input::get('username');
              $coordinador->UserUpdated = Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name;
              $coordinador->last_modification  = $dateModif;
              $coordinador->save();

              if($coordinador->save()){

                Session::flash('message', 'Información: ¡ El Coordinador [ ' .$coordinador->Nombre. ' ' .$coordinador->Apellidos. ' ] con el Id [ '. $coordinador->id . ' ] se ha modificado correctamente en la Base de Datos !');
               return Redirect::to('admin/Coordinadores/store');

              } else {

                Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - El Coordinador no se pudo modificar ');
               return Redirect::to('admin/Coordinadores/store');

              }
        
            }
            else{

               $date = Carbon::now();
               $dateModif = $date->toDateTimeString();

               
               $coordinador = Coordinador::find($id);
               $coordinador->Nombre      = Input::get('Nombre');
               $coordinador->Apellidos   = Input::get('Apellidos');
               $coordinador->Correo      = Input::get('Correo');
               $coordinador->last_modification  = $dateModif;
               $coordinador->UserUpdated = Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name;
               $coordinador->username     = Input::get('username');
               $coordinador->save();

               if($coordinador->save()){

                  Session::flash('message', 'Información: ¡ El Coordinador [ ' .$coordinador->Nombre. ' ' .$coordinador->Apellidos. ' ] con el Id [ '. $coordinador->id . ' ] se ha modificado correctamente en la Base de Datos !');
                  return Redirect::to('admin/Coordinadores/store');

               } else {

                  Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - El Coordinador no se pudo modificar');
                  return Redirect::to('admin/Coordinadores/store');

               }
            } 
        }
    }


     
    public function editPasswd($id)
    {
      $coordinador = Coordinador::find($id);  
      $img = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $img->imgperfil;
      return View::make('admin.Coordinadores.editarPasswd', compact('coordinador'), compact('imagen'));
    }



    public function updatePasswd($id)
    {
      $reglas = array(
        'password'    => 'required | min:10 | max:15 | alpha_custom | confirmed '
      );

      $mensajes = array(
             
        'password.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>contraseña</strong> es obligatorio.</div>',

        'password.min' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> está muy corta, se permiten mínimo 10 caracteres.</div>',

        'password.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> está muy larga, se permiten máximo 15 caracteres.</div>',

        'password.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, +, -, .).</div>',

        'password.confirmed' => '<div class="alert alert-danger"><strong>¡Error! </strong> Las contraseñas no coinciden, intenta de nuevo.</div>'
      );

      $validator = Validator::make(Input::all(), $reglas, $mensajes);

        // Procesa el validador
        if ($validator->fails()) {
          // Si falla el validador retorna a la misma vista con los posibles errores de validacion.
          return Redirect::to('admin/Coordinadores/' .$id. '/editPasswd')->withErrors($validator);
                   
        } 
        else {
            // pasamos a los campos de la base de datos los nuevos datos de las variables de cada campo.
          $date = Carbon::now();
          $dateModif = $date->toDateTimeString();

          $password = Input::get('password');
          $coordinador = Coordinador::find($id);
          $coordinador->password  = Hash::make($password);
          $coordinador->UserUpdated = Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name;
          $coordinador->last_modification  = $dateModif;
          $coordinador->save();

          if($coordinador->save()){

            Session::flash('message', 'Información: ¡ La contraseña del coordinador [ ' .$coordinador->Nombre. ' ' .$coordinador->Apellidos. ' ] con el Id [ '. $coordinador->id . ' ] se ha modificado correctamente en la Base de Datos !');
            return Redirect::to('admin/Coordinadores/store');
          } 
          else {

            Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - La contraseña del coordinador no pudo modificar');
            return Redirect::to('admin/Coordinadores/' .$id. '/editPasswd');
          }
        }
    }



   // FUNCION QUE DESTRUYE UN REGISTRO DE COORDINADOR
      
    public function destroy($id)
    {
           
      $coordinador = Coordinador::find($id);
      $deleteCoordinador = $coordinador->delete(); 

      if($deleteCoordinador){

        Session::flash('message', 'Información: ¡ El Coordinador [ ' .$coordinador->Nombre. ' ' .$coordinador->Apellidos. ' ] con el Id [ ' .$coordinador->id . ' ] fue eliminado de la Base de Datos !');
            return Redirect::to('admin/Coordinadores/store');
      }
      else {

        Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - El coordinador no pudo ser eliminado');
            return Redirect::to('admin/Coordinadores/store');
      }            
    }

} // FIN DEL CONTROLADOR

?>