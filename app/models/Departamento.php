<?php


class Departamento extends Eloquent  {
    // declaramos la tabla que usa el modelo 
    protected $table = 'departamento';

    // declaramos la clave primaria de la tabla que usa el modelo
    protected $primaryKey = 'Id_Depto';

    // declaramos los campos con los que se puede crear el objeto desde el form
    protected $fillable = array('Nombre', 'Firma', 'Comentarios', );

         
   
     // función que recibe como parámetro la información del formulario para crear un Departamento
    public static function agregarDepartamento($input){

    	 $respuesta = array();
    
          // Declaramos reglas para validar que el nombre y firma sean obligatorios y una longitud maxima
    	 $reglas = array(

			'Nombre'        => 'required | max:50 | unique:departamento,Nombre',
			'Firma'         => 'required | max:70'
            
			
			); 

         // Creamos la matriz de mensajes
    	 $mensajes = array(
			
			 'Nombre.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>:attribute</strong> es bligatorio.</div>',

			 'Nombre.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> Máximo 50 caracteres.</div>',

             'Nombre.unique' => '<div class="alert alert-warning"><strong>¡Error! </strong> Este departamento ya se encuentra registrado.</div>',

			 'Firma.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio</div>',

			 'Firma.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> Máximo 70 caracteres.</div>'


			);

    	 $validator = Validator::make($input, $reglas, $mensajes); 

    	  // verificamos que los datos cumplan la validación 
        if ($validator->fails()){

            // si no cumple las reglas se van a devolver los errores al controlador 
            $respuesta['mensaje'] = $validator;
            $respuesta['error']   = true;

         }
         else{

            // en caso de cumplir las reglas se crea el objeto Departamento
           // $departamento = static::create($input); 
              
            $updatedNotExists = '[No se ha modificado]';
            $adminCreated = Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name;
             
            $mayusDepto = Str::upper(Input::get('Nombre'));
            $mayusFirma = Str::upper(Input::get('Firma'));

            $departamento = new Departamento;
            $departamento->Nombre          = $mayusDepto;
            $departamento->Firma           = $mayusFirma;
            $departamento->Comentarios     = Input::get('Comentarios');
            $departamento->AdminCreated    = $adminCreated;
            $departamento->AdminUpdated    = $updatedNotExists;
            $departamento->save();        

            if($departamento->save()){

              $respuesta['mensaje'] = 'Información: ¡ Departamento creado !';
              $respuesta['error']   = false;
              $respuesta['data']    = $departamento;
            }
            else {

                Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - No se pudo crear el departmento');
                return Redirect::to('admin/Departamentos/store');
            }
            
        }     

        return $respuesta; 
     }


    

  // RELACIONES ENTRE MODELOS --------------------------------

     //Un departamento tiene varios coordinadores

     public function coordinadores(){
        // creamos una relación con el modelo de coordinador
        return $this->hasMany('Coordinador', 'Id_Depto');
    }

    public function adminCreated(){
       
        return $this->belongsTo('Administrador', 'id');
    } 

    public function adminUpdated(){
       
        return $this->belongsTo('Administrador', 'Id_AdminUpdated');
    } 

}

?>