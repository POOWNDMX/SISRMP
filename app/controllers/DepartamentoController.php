<?php

class DepartamentoController extends BaseController {



	   public function index()
    {

        if(isset($_GET['buscar']))
        {
            $resultado = htmlspecialchars(Input::get('buscar'));
            $departamentos = Departamento::where('Nombre', 'LIKE', '%'.$resultado.'%')
                                         ->orwhere('Firma', 'LIKE', '%'.$resultado.'%')
                                         ->orwhere('Comentarios', 'LIKE', '%'.$resultado.'%' )
                                         ->paginate(7);
        }

        else
        {
            $departamentos = Departamento::orderBy('Id_Depto', 'DESC')->paginate(7);
            
        }
        // obtenemos todos los departamentos y los pasamos a la vista 
        $img = Administrador::find(Auth::userAdmin()->get()->id);
        $imagen = $img->imgperfil;
        return View::make('admin.Departamentos.consultar', array('departamentos' => $departamentos, 'imagen' => $imagen));
        //
    }



    public function show($Id_Depto)
    {

        $departamento = Departamento::find($Id_Depto);
        $coordinadores = Coordinador::all();

        //Traemos el admin que creo al departamento con las relaciones entre modelos 
        // (ADMINISTRADOR - departamentosCreate )(DEPARTAMENTO - adminCreate)
        $adminCreated = $departamento->adminCreated;

        //Traemos el admin que modifico al departamento con las relaciones entre modelos 
        // (ADMINISTRADOR - departamentosUpdated )(DEPARTAMENTO - adminUpdated)
        $adminUpdated = $departamento->adminUpdated;

        $administrador = Administrador::find(Auth::userAdmin()->get()->id);
        $imagen = $administrador->imgperfil;
       
        return View::make('admin.Departamentos.ver', array('departamento' => $departamento, 'coordinadores'=> $coordinadores, 'imagen' => $imagen, 'adminCreated' => $adminCreated, 'adminUpdated' => $adminUpdated));
    }


    public function form()
    {
      $img = Administrador::find(Auth::userAdmin()->get()->id);
      $imagen = $img->imgperfil;

      return View::make('admin.Departamentos.registrar', compact('imagen'));
    }



    public function create(){

        // llamamos a la función de agregar departamento en el modelo y le pasamos los datos del formulario 
        $respuesta = Departamento::agregarDepartamento(Input::all());

        // Dependiendo de la respuesta del modelo 
        // retornamos los mensajes de error con los datos viejos del formulario 
        // o un mensaje de éxito de la operación 
        if ($respuesta['error'] == true){
            return Redirect::to('admin/Departamentos/create')->withErrors($respuesta['mensaje'] )->withInput();
        }else{
            return Redirect::to('admin/Departamentos/create')->with('mensaje', $respuesta['mensaje']);
        }
    }



        // Funcion edit : recibe un parametro Id_Depto para editar los datos del mismo. 
    public function edit($Id_Depto)
    {
        $departamento = Departamento::find($Id_Depto); 
        $administrador = Administrador::find(Auth::userAdmin()->get()->id);
        $imagen = $administrador->imgperfil; 

        //Traemos el admin que creo al departamento con las relaciones entre modelos 
        // (ADMINISTRADOR - departamentosCreate )(DEPARTAMENTO - adminCreate)
        $adminCreated = $departamento->adminCreated;

        //Traemos el admin que modifico al departamento con las relaciones entre modelos 
        // (ADMINISTRADOR - departamentosCreate )(DEPARTAMENTO - adminCreate)
        $adminUpdated = $departamento->adminUpdated;

        return View::make('admin.Departamentos.editar')->with('departamento', $departamento)->with('imagen', $imagen)->with('adminCreated', $adminCreated)->with('adminUpdated', $adminUpdated);       
    }



         // Funcion update : recibe un parametro Id_Depto desde el form::model que usaremos para actualizar los datos del mismo.
    public function update($Id_Depto){

        // Declaramos las reglas de validación.
          $reglas = array(
            'Nombre'       => 'required | max:50 | unique:departamento,Nombre,'.$Id_Depto.',Id_Depto',
            'Firma'      => 'required | max:70'
            
          );

        // Cremos la matriz de mensajes personalizados
          $mensajes = array(
            
             'Nombre.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio</div>',

             'Nombre.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> Máximo 50 caracteres.</div>',

              'Nombre.unique' => '<div class="alert alert-warning"><strong>¡Error! </strong> El departamento que intentabas poner ya se encuentra registrado registrado.</div>',

             'Firma.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio.</div>',

             'Firma.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> Máximo 70 caracteres.</div>'

            );

          $validator = Validator::make(Input::all(), $reglas, $mensajes);

        // Procesa el validador
           if ($validator->fails()) {
            // Si falla el validador retorna a la misma vista con los posibles errores de validacion.
            return Redirect::to('admin/Departamentos/' .$Id_Depto. '/edit')->withErrors($validator);
                
            } 
            else {
            // pasamos a los campos de la base de datos los nuevos datos de las variables de cada campo e nsertamos los mismos en el Id_Depto.
              $adminUpdated = Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name;
              $mayusDepto = Str::upper(Input::get('Nombre'));
              $mayusFirma = Str::upper(Input::get('Firma'));

              $departamento = Departamento::find($Id_Depto);
              $departamento->Nombre      = $mayusDepto;
              $departamento->Firma       = $mayusFirma;
              $departamento->Comentarios = Input::get('Comentarios');
              $departamento->AdminUpdated    = $adminUpdated;
              $departamento->save();

            // Retorna un mensaje de exito en la operacion
            if($departamento->save()){

              Session::flash('message', ' Información: ¡ El departamento [ ' .$departamento->Nombre. ' ] con el Id [ '. $departamento->Id_Depto . ' ] se ha modificado correctamente en la Base de Datos !');
              return Redirect::to('admin/Departamentos/store');

            } else {

              Session::flash('messageFallo', ' Información: ¡<strong>Error</strong>! - El departamento [ ' .$departamento->Nombre. ' ] con el Id [ '. $departamento->Id_Depto . ' ] no se pudo modificar');
              return Redirect::to('admin/Departamentos/store');

            }
        }
    }



    // Funcion destroy : recibe un parametro Id_Depto y destruye el registro en la base de datos del Id_Depto.
    public function destroy($Id_Depto)
    {
         $departamento = Departamento::find($Id_Depto);
         $deleteDepto = $departamento->delete();

         /* Realizarlo de esta forma tambien es correcto... Pero no tendria guardado el registro para mostrarlo
         * Departamento::destroy($Id_Depto); 
         */
         if($deleteDepto)
         {

          Session::flash('message', 'Información: ¡ El Departamento [ '. $departamento->Nombre .' ] con el Id [ '. $departamento->Id_Depto . ' ] fue eliminado de la Base de Datos !');

          return Redirect::to('admin/Departamentos/store');

         } else {

          Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - El departamento [ '. $departamento->Nombre .' ] con el Id [ '. $departamento->Id_Depto . ' ] no se pudo eliminar');

          return Redirect::to('admin/Departamentos/store');

         }
    }
}



?>