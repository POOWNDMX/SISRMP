<?php
use Carbon\Carbon;

/**
* 
*/
class Archivo extends Eloquent
{

	protected $table = 'files';
	protected $primaryKey = 'Id_File';


	public function ClienteId(){

		return $this->belongsTo('Cliente', 'id');
	}

	public function CoordinadorId(){

		return $this->belongsTo('Coordinador', 'id');
	}


	//Traemos el nombre y apellido del coordinador dueño de uno o varios archivos
	public function NombreCoordinador()
	{ 
        $coordinador_name = Coordinador::find($this->Id_Coordinador);
        return $coordinador_name->Nombre.' '.$coordinador_name->Apellidos;
    }

    // Tremos el nombre de la empresa o el cliente dueño de uno o varios archivos
    public function NombreCliente()
    {
        $cliente_name = Cliente::find($this->Id_Cliente);
        return $cliente_name->NombreEmpresa;
    }

}




?>