
<?php


use Carbon\Carbon;

class Administrador extends Eloquent 
{
    
	
	  protected $table      = 'administrador';
	  protected $primarykey = 'id';
    protected $fillable = array('first_name', 'last_name', 'username', 'password', 'imgperfil');
    
    public static function agregarAdministrador($input){

    	 
         $respuesta = array();

    	 $reglas = array(

			'first_name' => 'required | max:50 ',
      'last_name'  => 'required | max:50 ',
      //'imgperfil'  => 'unique:administrador,imgperfil',
			'username'	 => 'required | between:10,20 | alpha_custom | unique:administrador,username',
			'password'	 => 'required | min:15 | max:20 | alpha_custom | confirmed'
			
			); 

    	 $mensajes = array(
			
			    'first_name.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>nombre</strong> es obligatorio.</div>',

			    'first_name.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> Máximo 50 caracteres.</div>',

			

          'last_name.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>apellidos</strong> es obligatorio.</div>',

          'last_name.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> Máximo 50 caracteres.</div>',


      
          'username.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> El campo <strong>usuario</strong> es obligatorio.</div>',

			    'username.between' => '<div class="alert alert-danger"><strong>¡Error! </strong> El <strong>usuario</strong> debe ser entre 10 y 20 caracteres.</div>',

          'username.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong>El <strong>usuario</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, .).</div>',

		      'username.unique' => '<div class="alert alert-danger"><strong>¡Error! </strong> No puedes registrar este nombre de usuario, ya está en uso.</div>',



          'password.required' => '<div class="alert alert-danger"><strong>¡Error! </strong>El campo <strong>contraseña</strong> y <strong>comfirmación</strong> son obligatorios.</div>',

          'password.min' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> está muy corta, se permiten mínimo 15 caracteres.</div>',

          'password.max' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> está muy larga, se permiten máximo 20 caracteres.</div>',

          'password.alpha_custom' => '<div class="alert alert-danger"><strong>¡Error! </strong> La <strong>contraseña</strong> debe ser sin espacios, solo se permiten letras, números y (@, *, _, .).</div>',

          'password.confirmed' => '<div class="alert alert-danger"><strong>¡Error! </strong> Las contraseñas no coinciden, intenta de nuevo.</div>'

			);

    	 $validator = Validator::make($input, $reglas, $mensajes); 

    	  // verificamos que los datos cumplan la validación 
        if ($validator->fails()){

            // si no cumple las reglas se van a devolver los errores al controlador 
            $respuesta['mensaje'] = $validator;
            $respuesta['error']   = true;

         }
         else{

            $date = Carbon::now();
            $dateModif = $date->toDateTimeString();
            
            $password = Input::get('password');

            $administrador = new Administrador;
            $administrador->first_name        = Input::get('first_name');
            $administrador->last_name         = Input::get('last_name');
            $administrador->username          = Input::get('username');
            $administrador->password          = Hash::make($password); 
            $administrador->save();        

            if($administrador->save()){
            // se retorna un mensaje de éxito al controlador
            $respuesta['mensaje'] = 'Información: ¡ Usuario administrador creado !';
            $respuesta['error']   = false;
            $respuesta['data']    = $administrador;

            } else {

              Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - No se pudo crear la asignación');
              return Redirect::to('admin/admin_user/store');

            }
             
          }

        return $respuesta; 
     }
            

   


    public function coordinadores(){
        
        return $this->hasMany('Coordinador', 'Id_Admin');
    }

    //Un administrador tiene varios departamentos creados
    public function departamentoCreateds(){

        return $this->hasMany('Departamento', 'Id_Admin');
    }

    //UN administrador tiene varios departamentos modificados
    public function departamentoUpdateds(){

        return $this->hasMany('Departamento', 'Id_AdminUpdated');
    }

    public function clientes(){

        return $this->hasMany('Cliente', 'Id_Admin');
    }

    public function Asignados(){

        return $this->hasMany('AsignaCliente', 'Id_Admin');
    }


    }

    




   


?>