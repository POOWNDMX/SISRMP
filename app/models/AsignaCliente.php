<?php
use Carbon\Carbon;

/**
* 
*/
class AsignaCliente extends Eloquent
{
	
	protected $table = 'clientecoord';
	protected $primaryKey = 'Id_FolioCC';
	protected $fillable = array('Id_Coordinador', 'Id_Cliente');

	
	public static function agregarAsignacion($input)
	{
		
		$respuesta = array();

		
		$reglas = array(

            'Id_Coordinador' => 'required',
			'Id_Cliente' =>     'required'
			
			); 

		$mensajes = array(

            
            'Id_Coordinador.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> Se requiere seleccione un coordinador</div>',
            'Id_Cliente.required' => '<div class="alert alert-danger"><strong>¡Error! </strong> Se requiere seleccione un cliente</div>'
			);

		 $validator = Validator::make($input, $reglas, $mensajes);

		
        if ($validator->fails()){
        	
            $respuesta['mensaje'] = $validator;
            $respuesta['error']   = true;
        }else{
            
        	 //$asignacion = static::create($input);
            $adminCreated = Auth::userAdmin()->get()->first_name.' '.Auth::userAdmin()->get()->last_name;

        	$asignacion = new AsignaCliente;
            $asignacion->Id_Cliente = Input::get('Id_Cliente');
            $asignacion->Id_Coordinador = Input::get('Id_Coordinador');    
            $asignacion->AdminCreated =  $adminCreated;       
            $asignacion->save();

            if($asignacion->save()){

                $respuesta['mensaje'] = 'Información: ¡ Asignación creada correctamente !';
                $respuesta['error']   = false;
                $respuesta['data']    = $asignacion;

            }
            else {

                Session::flash('messageFallo', 'Información: ¡<strong>Error</strong>! - No se pudo crear la asignación');
                return Redirect::to('admin/Asignar/store');

            }
            
            
        }

        return $respuesta; 
	}

	// RELACIONES ENTRE MODELOS

	// Una asignación tiene un coordinador
	public function coordnator(){
       
        return $this->hasMany('Coordinador', 'id');
    } 

    // Una asignacion tiene un cliente
    public function client(){
       
        return $this->hasMany('Cliente', 'id');
    } 

    //---------------Consultando la llave foránea de Id_Cliente-----------------
    public function Cliente_Name(){ // taremos el nombre de la empresa

        $nombre_id_cliente = Cliente::find($this->Id_Cliente);
        return $nombre_id_cliente->NombreEmpresa; 
    }

    public function Cliente_Contacto(){ //Traemos el nombre y apellido del contacto

        $nombre_contacto = Cliente::find($this->Id_Cliente);
        return $nombre_contacto->NombreContacto.' '.$nombre_contacto->ApellidosContacto;
    }

    public function Cliente_Id(){ //Traemos el id del cliente

        $id_cliente = Cliente::find($this->Id_Cliente);
        return $id_cliente->id;
    }

    


    //Consulta la llave foránea de Id_Coordinador
    public function Coordinador_Name(){

        $nombre_id_coordinador = Coordinador::find($this->Id_Coordinador);
        return $nombre_id_coordinador->Nombre.' '.$nombre_id_coordinador->Apellidos;
    }

     public function Coordinador_Id(){ //Traemos el id del cliente

        $id_coordinador = Coordinador::find($this->Id_Coordinador);
        return $id_coordinador->id;
    }

     public function Correo(){ //Traemos el id del cliente

        $id_coordinador = Coordinador::find($this->Id_Coordinador);
        return $id_coordinador->Correo;
    }
}




?>