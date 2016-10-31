<?php
use Carbon\Carbon;

/**
* 
*/
class Cliente extends Eloquent
{
	
	protected $table = 'clientes';
	protected $primaryKey = 'id';
	protected $fillable = array(

							'NombreEmpresa', 
							'RFC', 
							'NombreRepLegal', 
							'ApellidosRepLegal', 
							'DomicilioFiscal',
              'Domicilio',
              'RegimenFiscal', 
							'NombreContacto',
							'ApellidosContacto', 
							'Telefono', 
							'Correo', 
							'username', 
							'password',
							'imgperfil'
						);


    
	public static function agregarCliente($input)
	{
		
		 $respuesta = array();

		 
		$reglas = array(

			'NombreEmpresa'     => 'required | unique:clientes,NombreEmpresa',
			'RFC'               => 'required | alpha_num | between: 12,13 | unique:clientes,RFC',
			'DomicilioFiscal'   => 'required',
			'NombreContacto'    => 'required',
			'ApellidosContacto' => 'required',
			'Telefono'          => 'required ',
			'Correo'            => 'required ',// | unique:clientes,Correo
			'username'          => 'required | between: 12,13 | alpha_num | unique:clientes,username',
			'password'        	=> 'required | min:10 | max:15 | alpha_custom | confirmed'
			); 

		
		$mensajes = array(
			'NombreEmpresa.required' => '<div class="alert alert-danger"><strong>¡Error! </strong>El campo <strong>Nombre de la empresa</strong> es obligatorio. </div>',

			'NombreEmpresa.unique' => '<div class="alert alert-warning"><strong>¡Error! </strong> Esta empresa ya se encuentra registrada </div>',


			'RFC.required' => '<div class="alert alert-danger"><strong>¡Error! </strong>El campo <strong>RFC</strong> es obligatorio.</div>',

			'RFC.alpha_num' => '<div class="alert alert-danger"><strong>¡Error!</strong> Solo caracteres [A-Z, 0-9]</div>',

			'RFC.between' => '<div class="alert alert-danger"><strong>¡Error!</strong> EL <strong>RFC</strong> debe ser entre 12 y 13 caracteres</div>',

			'RFC.unique' => '<div class="alert alert-warning"><strong>¡Error! </strong> Este <strong>RFC</strong> ya está asociado con otra cuenta.</div>',

			
			'DomicilioFiscal.required' => '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>domicilio fiscal</strong> es obligatorio.</div>',


			'NombreContacto.required' => '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>nombre</strong> es obligatorio.</div>',


             'ApellidosContacto.required' => '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>Apellidos</strong> es obligatorio.</div>',
            

             'Telefono.required'  =>  '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>:attribute</strong> es obligatorio.</div>',

             'Correo.required' => '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>:attribute</strong> es obligatorio.</div>',

             //'Correo.unique' => '<div class="alert alert-warning"><strong>¡Error!</strong> Este <strong>correo</strong> ya está asociado con otra cuenta</div>',


             'username.required' => '<div class="alert alert-danger"><strong>¡Error!</strong> El campo <strong>usuario</strong> es obligatorio.</div>',

             'username.between' => '<div class="alert alert-danger"><strong>¡Error!</strong> El <strong>usuario</strong> debe ser entre 12 y 13 caracteres</div>',

             'username.alpha_num' => '<div class="alert alert-danger"><strong>¡Error! </strong>El nombre de usuario debe ser sin espacios, solo se permiten letras, números.</div>',

             'username.unique' => '<div class="alert alert-warning"><strong>¡Error!</strong> No puedes registrar este nombre de usuario, ya está asociado a otra cuenta.</div>',



             'password.required' => '<div class="alert alert-danger"><strong>Error</strong> El campo <strong>contraseña</strong> es obligatorio.</div>',

             'password.min' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> está muy corta, se permiten mínimo 10 caracteres.</div>',

            'password.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> está muy larga, se permiten máximo 15 caracteres.</div>',

              'password.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong> La 
               <strong>contraseña</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, +, -, .).</div>',

             'password.confirmed' => '<div class="alert alert-danger"><strong>¡Error! </strong> Las contraseñas no coinciden, intenta de nuevo.</div>'
			
		);

		 $validator = Validator::make($input, $reglas, $mensajes);
		
        if ($validator->fails()){
            
            $respuesta['mensaje'] = $validator;
            $respuesta['error']   = true;

        }
        else{

            //$cliente = static::create($input);
            $date = Carbon::now();
            $dateModif = $date->toDateTimeString();
            
            $updatedNotExists = '[No se ha modificado]';
            $adminCreated = Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name;

            $password = Input::get('password');       
            $cliente = new Cliente;
            $cliente->NombreEmpresa  	= Input::get('NombreEmpresa');
            $cliente->RFC 				= Input::get('RFC');
            $cliente->DomicilioFiscal   = Input::get('DomicilioFiscal');    
            $cliente->Domicilio         = Input::get('Domicilio');
            $cliente->RegimenFiscal     = Input::get('RegimenFiscal');
            $cliente->NombreRepLegal    = Input::get('NombreRepLegal');
            $cliente->ApellidosRepLegal = Input::get('ApellidosRepLegal');
            $cliente->NombreContacto    = Input::get('NombreContacto');
            $cliente->ApellidosContacto = Input::get('ApellidosContacto');
            $cliente->Telefono    		= Input::get('Telefono'); 
            $cliente->Correo    		= Input::get('Correo');
            $cliente->username    		= Input::get('username');
            $cliente->AdminCreated 		= $adminCreated;
            $cliente->UserUpdated 		= $updatedNotExists;
            $cliente->last_modification = $dateModif;
            $cliente->password    		= Hash::make($password);
            $cliente->Observaciones     = Input::get('Observaciones');            
            $cliente->save();

            if($cliente->save()){
            
            $respuesta['mensaje'] = 'Información: ¡ Cliente creado !';
            $respuesta['error']   = false;
            $respuesta['data']    = $cliente;

        	} else {

        		Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - No se pudo crear el coordinador');
                return Redirect::to('admin/Clientes/store');
        	}
        }     

        return $respuesta; 

	}

	// RELACIONES ENTRE MODELOS --------------------------

	// Un cliente tiene varias asignaciones
	public function asignaciones(){
        // creamos una relación con el modelo de coordinador
        return $this->hasMany('AsignaCLiente', 'Id_Cliente');
    }

    // Un cliente tiene varios archivos
	public function filesCliente(){
        // creamos una relación con el modelo de coordinador
        return $this->hasMany('Archivo', 'Id_Cliente');
    }
}



?>

