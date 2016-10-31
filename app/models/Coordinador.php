<?php
use Carbon\Carbon;


class Coordinador extends Eloquent
{
	
	protected $table = 'coordinador';
	protected $primaryKey = 'id'; 
	protected $foreignKey = 'Id_Depto'; 
  protected $fillable = array('Nombre', 'Apellidos', 'Correo', 'Id_Depto', 'username', 'password', 'imgperfil');

   
    // Creamos la relación de coordinador con departamento. Donde solamente pertenece a un departamento.
    
	
	public static function agregarCoordinador($input)
	{
		# code...
		$respuesta = array();

		$reglas = array(

			'Nombre'        => 'required',
			'Apellidos'     => 'required',
			'Correo'        => 'required | unique:coordinador,Correo', 
			'Id_Depto'      => 'required',
			'username'      => 'required | between: 9,15 | alpha_custom | unique:coordinador,username',
			'password'      => 'required | min:10 | max:15 | alpha_custom | confirmed'
			); 

		
		$mensajes = array(
			
			'Nombre.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio</div>',


			'Apellidos.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio. </div>',


			'Correo.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>:attribute</strong> es obligatorio. </div>',

			'Correo.unique' => '<div class="alert alert-warning"><strong>¡Error! </strong> El correo electrónico que intentabas poner ya está asociado con otra cuenta.</div>',
			 
            'Id_Depto.required' => '<div class="alert alert-danger"><strong>¡Error! </strong>Si no hay departamentos, regístrelo primero.</div>',


            'username.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>usuario</strong> es obligatorio. </div>',

            'username.between' => '<div class="alert alert-danger"><strong>¡Error! </strong> El <strong>usuario</strong> debe ser entre 9 y 15 caracteres.</div>',

            'username.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong> El <strong>usuario</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, +, -, .).</div>',

            'username.unique' => '<div class="alert alert-warning"><strong>¡Error! </strong> Este <strong>usuario</strong>, ya está asociado con otra cuenta.</div>',


             
            'password.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>contraseña</strong> es obligatorio.</div>',

            'password.min' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> está muy corta, se permiten mínimo 10 caracteres.</div>',

            'password.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> está muy larga, se permiten máximo 15 caracteres.</div>',

            'password.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, +, -, .).</div>',

            'password.confirmed' => '<div class="alert alert-danger"><strong>¡Error! </strong> Las <strong>contraseñas</strong> no coinciden, intenta de nuevo.</div>'
		);

		$validator = Validator::make($input, $reglas, $mensajes);
  
        if ($validator->fails()){
        	
            $respuesta['mensaje'] = $validator;
            $respuesta['error']   = true;
      
        }
        else{
            
            //$coordinador = static::create($input);
            $date = Carbon::now();
            $dateModif = $date->toDateTimeString();

            $updatedNotExists = '[No se ha modificado]';
            $adminCreated = Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name;

            $password = Input::get('password'); 
            $coordinador = new Coordinador;
            $coordinador->Nombre            = Input::get('Nombre');
            $coordinador->Apellidos         = Input::get('Apellidos');
            $coordinador->Correo            = Input::get('Correo');
            $coordinador->Id_Depto          = Input::get('Id_Depto');
            $coordinador->username          = Input::get('username');
            $coordinador->adminCreated      = $adminCreated;
            $coordinador->UserUpdated       = $updatedNotExists;
            $coordinador->last_modification = $dateModif;
            $coordinador->password          = Hash::make($password);            
            $coordinador->save();

            if($coordinador->save()){

            $respuesta['mensaje'] = 'Información: ¡ Coordinador creado!';
            $respuesta['error']   = false;
            $respuesta['data']    = $coordinador;

            }
            else {

                Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - No se pudo crear el coordinador');
                return Redirect::to('admin/Coordinadores/store');
            }
        }

        return $respuesta; 
	}

    //RELACIONES ENTRE MODELOS ------------------------------

    // Un coordinador pertenece a un departamento
    public function departament(){
       
        return $this->belongsTo('Departamento', 'Id_Depto');
    } 

    //UN coordinador tiene varias asignaciones
    public function asignaciones(){
        // creamos una relación con el modelo de coordinador
        return $this->hasMany('AsignaCLiente', 'Id_Coordinador');
    }

    public function filesCoord(){
        // creamos una relación con el modelo de Archivo
        return $this->hasMany('Archivo', 'Id_Coordinador');
    }


    public function Departamento_name(){ //Traemos el nombre del departamento

        $nombre_departamento = Departamento::find($this->Id_Depto);
        return $nombre_departamento->Nombre;
    }



}



?>