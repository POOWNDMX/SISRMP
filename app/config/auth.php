<?php

/*return array(

	
	'driver' => 'eloquent',
    'model' => 'User',
    'table' => '',
     
     

); */

return array(

    'multi' => array(

        'userAdmin' => array(
            'driver' => 'eloquent',
            'model' => 'UserAdmin'
            
        ),

        'userCoord' => array(
            'driver' => 'eloquent',
            'model' => 'UserCoord',
            'Id_Coordinador' => 'id'
            
        ),

        'userCliente' => array(
            'driver' => 'eloquent',
            'model' => 'UserCliente',
            'Id_Cliente' => 'id'
            
        ),

        
    )
);