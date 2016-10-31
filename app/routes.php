<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/* Rutas de LOGIN ADMINISTRADOR, CLIENTE Y COORDINADOR -------------------------------------------------------- */

Route::group(array('prefix' => 'login'), function(){



    Route::get('/Login_Clientes', array(

    	'as' => 'login.LoginClientes',
    	'uses' => 'LoginClienteController@index'
    	
    	)
    );

    Route::get('/Login_Coordinadores',  array(

    	'as' => 'login.LoginCoordinadores',
    	'uses' =>'LoginCoordController@index'
    	)
    
    );

   
    Route::get('/LoginAdministrador_rmp', array(

    	'as' => 'login.LoginAdministrador',
    	'uses' =>'LoginController@index'
    	)
    );


});

// RUTA PARA ERRORES LOGS
Route::get('admin/adminRMP/logs', array(
				'as' => 'Admin.logs',
				'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index',
				'before' => 'auth'
		)
);

/* Termina rutas de Login -------------------------------------------------------- */


/* -------------------  U S E R    A D M I N I S T R A D O R -----------------------------------------------*/


/* Rutas de procesamiento de login ADMINISTRADOR ---------------------------------- */

 Route::get('Error/Error_Redireccion', function()
    {
    	return View::make('admin.Errores.Redireccion');
    });


Route::post('login/FrmLoginAdmin', array(

	     'as' => 'FrmLoginAdmin',
	     'uses' => 'LoginController@post_login'
	     
	)
);

Route::get('admin/Logout', array(
	      
	       'as' =>'Logout.administrador',
	       'uses' => 'ActividadController@get_logout'
	        )
);


/* TERMINA Rutas de procesamiento de login ADMINISTRADOR--------------------------------- */


/* Ruta para Actividad ADMINISTRADOR-------------------------------------------------------- */

Route::get('admin/Actividad', array(

		   'as' => 'Actividad.store',
		   'uses' => 'ActividadController@index',
		   'before' => 'auth'
	       
	      )

);

/* Termina ruta para Actividad-------------------------------------------------------- */

/* Rutas para módulo Administrador-------------------------------------------------------- */

Route::get('admin/admin_user/create', array(

		   'as' => 'Admin.create',
		   'uses' => 'AdministradorController@form',
		   'before' => 'auth'
		  
		 )

);

Route::post('admin/FrmRegis_AdminUser', array(
	      
	       'as' =>'FrmRegis_AdminUser',
	       'uses' => 'AdministradorController@create',
	       'before' => 'auth',
	        )
);

Route::get('admin/admin_user/perfil', array(
	      
	      'as' => 'Admin.ver', 
	      'uses' => 'AdministradorController@show',
	      'before' => 'auth'
	      )
);

Route::get('admin/admin_user/editPerfil', array(
	      
	      'as' => 'Admin.edit', 
	      'uses' => 'AdministradorController@edit',
	      'before' => 'auth'
	      )
);

Route::put('admin/admin_user/updatePerfil', array(
	      
	      'as' => 'Admin.update', 
	      'uses' => 'AdministradorController@update',
	      'before' => 'auth'
	      )
);

// FUNCIONES DE ADMIN AUTENTICADO 
Route::get('admin/admin_user/editPasswd', array(
	      
	      'as' => 'Admin.editPasswd', 
	      'uses' => 'AdministradorController@editPasswd',
	      'before' => 'auth'
	      )
);

Route::put('admin/admin_user/updatePasswd', array(
	      
	      'as' => 'Admin.updatePasswd', 
	      'uses' => 'AdministradorController@updatePasswd',
	      'before' => 'auth'
	      )
);

Route::get('admin/admin_user/store', array(
	      
	      'as' => 'Admin.store', 
	      'uses' => 'AdministradorController@indexAdmins',
	      'before' => 'auth'
	      )
);

// FUNCIONES DE ADMIN SELECCIONADO
Route::get('admin/admin_user/{id}/editPasswd', array(
	      
	      'as' => 'userAdmin.editPasswd', 
	      'uses' => 'AdministradorController@userEditPasswd',
	      'before' => 'auth'
	      )
);

Route::put('admin/admin_user/{id}/updatePasswd', array(
	      
	      'as' => 'userAdmin.updatePasswd', 
	      'uses' => 'AdministradorController@userUpdatePasswd',
	      'before' => 'auth'
	      )
);

Route::delete('admin/admin_user/{id}', array(
	          
	          'as' =>   'userAdmin.delete',
	          'uses' => 'AdministradorController@destroy',
	          'before' => 'auth'
            )
);

Route::get('admin/admin_user/deletemyImage', array(
			
			'as' => 'userAdminImage.delete',
			'uses' => 'AdministradorController@deleteMyImage',
			'before' => 'auth'
	)
);





/* Termina rutas para Administrador-------------------------------------------------------- */




/* Rutas para módulo Departamentos-------------------------------------------------------- */


Route::get('admin/Departamentos/create', array(

	       'as' => 'Departamento.create', 
	       'uses' => 'DepartamentoController@form',
	       'before' => 'auth'

	       )
);


Route::get('admin/Departamentos/store', array(
	      
	      'as' => 'Departamento.store', 
	      'uses' => 'DepartamentoController@index',
	      'before' => 'auth'
	      )
);



Route::post('admin/FrmRegis_Dpto', array(
	      
	       'as' =>'FrmRegis_Dpto',
	       'uses' => 'DepartamentoController@create',
	       'before' => 'auth'
	        )
);

Route::get('admin/Departamentos/{Id_Depto}/edit', array(
	      
	      'as' => 'Departamento.edit', 
	      'uses' => 'DepartamentoController@edit',
	      'before' => 'auth'
	      )
);

Route::get('admin/Departamentos/{Id_Depto}/show', array(
	      
	      'as' => 'Departamento.ver', 
	      'uses' => 'DepartamentoController@show',
	      'before' => 'auth'
	      )
);

Route::put('admin/Departamentos/{Id_Depto}', array(
	      
	      'as' => 'Departamento.update', 
	      'uses' => 'DepartamentoController@update',
	      'before' => 'auth'
	      )
);

Route::delete('admin/Departamentos/{Id_Depto}', array(
	      
	      'as' => 'Departamento.delete', 
	      'uses' => 'DepartamentoController@destroy',
	      'before' => 'auth'
	      )
);

/* Terminan las Rutas para módulo Departamentos-------------------------------------------------------- */


/* Rutas para módulo Coordinadores-------------------------------------------------------- */

Route::get('admin/Coordinadores/create', array(

	           'as' => 'Coordinador.create', 
	           'uses' => 'CoordinadorController@mostrarCoordRegistro',
	           'before' => 'auth'
	        )
);

Route::post('admin/FrmRegis_Coordi', array(

	           'as' => 'FrmRegis_Coordi', 
	           'uses' => 'CoordinadorController@create',
	           'before' => 'auth'
	           )
);

Route::get('admin/Coordinadores/store', array(

	           'as' => 'Coordinador.store', 
	           'uses' => 'CoordinadorController@index',
	           'before' => 'auth'
	        )
);

Route::get('admin/Coordinadores/storeDC', array(

	           'as' => 'Coordinador.storeDC', 
	           'uses' => 'CoordinadorController@indexDC',
	           'before' => 'auth'
	        )
);

Route::get('admin/Coordinadores/{id}/show', array(
	          
	          'as' => 'Coordinador.ver',
              'uses' => 'CoordinadorController@show',
              'before' => 'auth'
            )
);


Route::get('admin/Coordinadores/{id}/edit', array(
	          
	          'as' => 'Coordinador.edit',
              'uses' => 'CoordinadorController@edit',
              'before' => 'auth'
            )
);


Route::put('admin/Coordinadores/{id}/update', array(
	      
	      'as' => 'Coordinador.update', 
	      'uses' => 'CoordinadorController@update',
	      'before' => 'auth'
	      )
);


Route::get('admin/Coordinadores/{id}/editPasswd', array(
	          
	          'as' => 'Coordinador.editPasswd',
              'uses' => 'CoordinadorController@editPasswd',
              'before' => 'auth'
            )
);

Route::put('admin/Coordinadores/{id}/updatePasswd', array(
	      
	      'as' => 'Coordinador.updatePasswd', 
	      'uses' => 'CoordinadorController@updatePasswd',
	      'before' => 'auth'
	      )
);


Route::delete('admin/Coordinadores/{id}/delete', array(
	          
	          'as' =>   'Coordinador.delete',
	          'uses' => 'CoordinadorController@destroy',
	          'before' => 'auth'
            )
);

Route::get('admin/Coordinadores/CoordinadorId{id}/panel_statistics_files', array(

			   'as' => 'statisticPanelCoord.Files',
			   'uses' => 'StatisticsCoordinadorController@indexPanel',
			   'before' => 'auth'
	)
);

Route::get('admin/Coordinadores/coordinadorId{id}/FilesAll', array(

		 	'as' => 'Coordinador.filesMine',
		 	'uses' => 'StatisticsCoordinadorController@viewFilesMine',
		 	'before' => 'auth'
		  )
);

Route::get('admin/Coordinadores/CoordinadorId{id}/filesReceived', array(

			'as' => 'Coordinador.filesReceived',
			'uses' => 'StatisticsCoordinadorController@viewMyFilesReceived',
			'before' => 'auth'
	)
);

Route::get('admin/coordinadores/CoordinadorId{id}/filesSubmit', array(

			'as' => 'Coordinador.filesSubmit',
			'uses' => 'StatisticsCoordinadorController@viewMyFilesSubmit',
			'before' => 'auth'
	)
);

Route::get('admin/coordinadores/CoordinadorId{id}/filesDeleted', array(

			'as' => 'Coordinador.filesDeleted',
			'uses' => 'StatisticsCoordinadorController@viewMyFilesDeletedForAnyUsers',
			'before' => 'auth'
	)
);

Route::get('admin/coordinadores/CoordinadorId{id}/imagePerfil', array(

			'as' => 'imagePerfilCoord.view',
			'uses' => 'CoordinadorController@viewImagePerfil',
			'before' => 'auth'
	)
);



/* Terminan las Rutas para módulo Coordinadores-------------------------------------------------------- */


/* Rutas para módulo Clientes-------------------------------------------------------- */

Route::get('admin/Clientes/create', array(

	           'as' =>'Cliente.create',
	           'uses' => 'ClienteController@form',
	           'before' => 'auth' 
               )
);


Route::get('admin/Clientes/store', array(

	          'as' =>'Cliente.store', 
	          'uses' => 'ClienteController@index',
	          'before' => 'auth'
	         )
);

Route::post('admin/FrmRegis_Client', array(

	          'as' => 'FrmRegis_Client', 
	          'uses' => 'ClienteController@create',
	          'before' => 'auth'
	        )
);

Route::get('admin/clientes/{id}/show', array(
              
              'as' => 'Cliente.ver',
              'uses' => 'ClienteController@show',
              'before' => 'auth'
	      )
);

Route::get('admin/Clientes/{id}/edit', array(

	          'as' =>'Cliente.edit', 
	          'uses' => 'ClienteController@edit',
	          'before' => 'auth'
	         )
);

Route::put('admin/Clientes/{id}/update', array(

	          'as' =>'Cliente.update', 
	          'uses' => 'ClienteController@update',
	          'before' => 'auth'
	         )
);


Route::get('admin/Clientes/{id}/editPasswd', array(

	          'as' =>'Cliente.editPasswd', 
	          'uses' => 'ClienteController@editPasswd',
	          'before' => 'auth'
	         )
);

Route::put('admin/Clientes/{id}/updatePasswd', array(

	          'as' =>'Cliente.updatePasswd', 
	          'uses' => 'ClienteController@updatePasswd',
	          'before' => 'auth'
	         )
);


Route::delete('admin/Clientes/{id}', array(

	          'as' =>'Cliente.delete', 
	          'uses' => 'ClienteController@destroy',
	          'before' => 'auth'
	         )
);

Route::get('admin/clientes/ClienteId{id}/imagePerfil', array(

			'as' => 'imagePerfilClient.view',
			'uses' => 'ClienteController@viewImagePerfil',
			'before' => 'auth'
	)
);



Route::get('admin/Clientes/ClienteId{id}/panel_statistics_files', array(

			   'as' => 'statisticPanelClient.Files',
			   'uses' => 'StatisticsClienteController@indexPanel',
			   'before' => 'auth'
	)
);

Route::get('admin/Clientes/ClienteId{id}/FilesAll', array(

				'as' => 'Cliente.filesMine',
				'uses' => 'StatisticsClienteController@viewFilesAllClient',
				'before' => 'auth'
	)
);

Route::get('admin/Clientes/ClienteId{id}/filesReceived', array(

				'as' => 'Cliente.filesReceived',
				'uses' => 'StatisticsClienteController@viewFilesReceivedClient',
				'before' => 'auth'
	)
);

Route::get('admin/Clientes/ClienteId{id}/filesSubmit', array(

				'as' => 'Cliente.filesSubmit',
				'uses' => 'StatisticsClienteController@viewFilesSubmitClient',
				'before' => 'auth'
	)
);

Route::get('admin/Clientes/ClienteId{id}/filesDeleted', array(

				'as' => 'Cliente.filesDeleted',
				'uses' => 'StatisticsClienteController@viewFilesDeletedClient',
				'before' => 'auth'
	)
);



/* Terminan las Rutas para módulo Clientes-------------------------------------------------------- */


/* Rutas para Asignar clientes a Coordinadores-------------------------------------------------------- */

Route::get('admin/Asignar/store', array(

	         'as' => 'Asignar.store', 
	         'uses' => 'AsignaclienteController@index',
	         'before' => 'auth'
	        )
);


Route::get('admin/Asignar/create', array(

	         'as' => 'Asignar.create', 
	         'uses' => 'AsignaclienteController@mostrarCoordCliente',
	         'before' => 'auth'
	      )
);


Route::post('admin/FrmRegis_Asignacion', array(

	         'as' => 'FrmRegis_Asignacion', 
	         'uses' => 'AsignaclienteController@create',
	         'before' => 'auth'
	     )
);

Route::delete('admin/Asignar/{Id_FolioCC}', array(

	         'as' => 'Asignar.delete', 
	         'uses' => 'AsignaclienteController@destroy',
	         'before' => 'auth'
	      )
);

/* Terminan las Rutas para Asignar clientes a Coordinadores-------------------------------------------------------- */




/* Rutas para archivos (Files) en panel de administrador-------------------------------------*/

Route::get('admin/panel_Statistics_files', array(

			'as' => 'statisticPanel.Files',
			'uses' => 'FilesAdminController@getEstadisticaFile',
			'before' => 'auth'
	));

Route::get('admin/Files/Store', array(

			'as' => 'Files.store',
			'uses' => 'FilesAdminController@index',
			'before' => 'auth'
	));

Route::get('admin/Files/deletedFiles/forUser', array(

			'as' => 'Files.deletedForUSer',
			'uses' => 'FilesAdminController@getDeletedFilesForUser',
			'before' => 'auth'
	));


Route::get('admin/Files/submitFiles/Coordinador', array(

			'as' => 'Files.submitCoordinador',
			'uses' => 'FilesAdminController@viewListaEnviadosCoord',
			'before' => 'auth'
	));

Route::get('admin/Files/submitFiles/Cliente', array(

			'as' => 'Files.submitCliente',
			'uses' => 'FilesAdminController@viewListaEnviadosClient',
			'before' => 'auth'
	));

Route::get('admin/Files/detalleFile/{Id_File}/show', array(

			'as' => 'Files.show',
			'uses' => 'FilesAdminController@show',
			'before' => 'auth'
	));


Route::get('admin/Files/Image/{Id_File}/show', array(

			'as' => 'Img.show',
			'uses' => 'FilesAdminController@imageShow',
			'before' => 'auth'
	));

Route::delete('admin/Files/{Id_File}/delete', array(

			'as' => 'File.delete',
			'uses' => 'FilesAdminController@getDeleteFile',
			'before' => 'auth' 
	));


Route::get('admin/Files/file/recovery/{Id_File}', array(

			'as' => 'FileStPanelDelete.recovery',
			'uses' => 'FilesAdminController@getRecoveryPanelDelete',
			'before' => 'auth'
	));



/* Terminan rutas para archivos (Files en panel adinistrador) */

/*-------------------------------------- Rutas para Truncar Base de datos -------------------------------*/

Route::get('admin/login/truncate', array(

			'as' => 'login.truncate',
			'uses' => 'DataTruncateController@login',
			'before' => 'auth'
	)
);

Route::put('admin/login/truncate', array(

			'as' => 'Admin.truncateAccess',
			'uses' => 'DataTruncateController@frmLogin',
			'before' => 'auth'
	)
);

Route::get('admin/index/truncate', array(

			'as' => 'adminIndex.truncate',
			'uses' => 'DataTruncateController@index',
			'before' => 'auth'
	)
);

Route::get('admin/index/truncate/files', array(

			'as' => 'FilesTruncate.truncar',
			'uses' => 'DataTruncateController@truncateTableFiles',
			'before' => 'auth'
	)
);

Route::get('admin/index/truncate/departamentos', array(

			'as' => 'DeptoTruncate.truncar',
			'uses' => 'DataTruncateController@truncateTableDepto',
			'before' => 'auth'
	)
);

Route::get('admin/index/truncate/coordinadores', array(

			'as' => 'CoordTruncate.truncar',
			'uses' => 'DataTruncateController@truncateTableCoord',
			'before' => 'auth'
	)
);

Route::get('admin/index/truncate/clientes', array(

			'as' => 'ClientTruncate.truncar',
			'uses' => 'DataTruncateController@truncateTableClient',
			'before' => 'auth'
	)
);

Route::get('admin/index/truncate/relaciones', array(

			'as' => 'RelationTruncate.truncar',
			'uses' => 'DataTruncateController@truncateTableRelation',
			'before' => 'auth'
	)
);


Route::get('admin/index/truncate/fileServer', array(

			'as' => 'fileServerTruncate.truncar',
			'uses' => 'DataTruncateController@deleteFilesServer',
			'before' => 'auth'
	)
);

Route::get('admin/index/truncate/fileImgPerfilCLienteServer', array(

			'as' => 'fileImgPerfilServerTruncate.cliente',
			'uses' => 'DataTruncateController@deleteImageClienteServer',
			'before' => 'auth'
	)
);

Route::get('admin/index/truncate/fileImgPerfilCoordServer', array(

			'as' => 'fileImgPerfilServerTruncate.coordinador',
			'uses' => 'DataTruncateController@deleteImageCoordServer',
			'before' => 'auth'
	)
);

Route::get('admin/index/truncate/fileImgPerfilAdminServer', array(

			'as' => 'fileImgPerfilServerTruncate.administrador',
			'uses' => 'DataTruncateController@deleteImageAdminServer',
			'before' => 'auth'
	)
);




/*-------------------------------------- Rutas para REPORTES-------------------------------------------------------- */

Route::get('admin/Reportes/view', array(

			'as' => 'Reportes.view',
			'uses' => 'ReportsController@viewReports',
			'before' => 'auth'
	));
// Vista de reporte en pdf estadistica de la tabla archivos (Numero de registros, tamaño en MB y GB) ((((( REPORTE 1 )))))
Route::get('admin/Reportes/estadisticasFiles', array(

			'as' => 'estadisticaFiles.view',
			'uses' => 'ReportsController@viewReportEstatusTableFile',
			'before' => 'auth'
	));
// Descarga de reporte estadistica de la tabla archivos (Numero de registros, tamaño en MB y GB)
Route::get('admin/Reportes/downloadEstadisticasFiles', array(

			'as' => 'estadisticaFiles.download',
			'uses' => 'ReportsController@downloadReportEstadFile',
			'before' => 'auth'
	));

// Vista de reporte en pdf de archivos enviados por clientes ((((((( REPORTE 2 )))))))
Route::get('admin/Reportes/listaFiles/envia/Cliente', array(

			'as' => 'listaFilesEnviaCliente.view',
			'uses' => 'ReportsController@viewReportlistFilesEnviaCliente',
			'before' => 'auth'
	));

// Descarga de reporte en pdf de archivos enviados por clientes.
Route::get('admin/Reportes/downloadlistaFiles/envia/Cliente', array(

			'as' => 'listaFilesEnviaCliente.download',
			'uses' => 'ReportsController@downloadReportlistFilesEnviaCliente',
			'before' => 'auth'
	));


// Vista de reporte en pdf de archivos enviados por coordinadores ((((((( REPORTE 3 )))))))
Route::get('admin/Reportes/listaFiles/envia/Coordinador', array(

			'as' => 'listaFilesEnviaCoordinador.view',
			'uses' => 'ReportsController@viewReportlistFilesEnviaCoord',
			'before' => 'auth'
	));

// Descarga de reporte en pdf de archivos enviados por coordinadores.
Route::get('admin/Reportes/downloadlistaFiles/envia/Coordinador', array(

			'as' => 'listaFilesEnviaCoordinador.download',
			'uses' => 'ReportsController@downloadReportlistFilesEnviaCoord',
			'before' => 'auth'
	));


// Vista de reporte en pdf de archivos eliminados por algun usuario ((((((( REPORTE 4 )))))))
Route::get('admin/Reportes/listaFiles/deleted/Users', array(

			'as' => 'listaFilesDeletedForUsers.view',
			'uses' => 'ReportsController@viewReportlistFilesDeletedForUsers',
			'before' => 'auth'
	));

// Descarga de reporte en pdf de archivos eliminados por algun usuario.
Route::get('admin/Reportes/downloadlistaFiles/deleted/Users', array(

			'as' => 'listaFilesDeletedForUsers.download',
			'uses' => 'ReportsController@downloadReportlistFilesDeletedForUsers',
			'before' => 'auth'
	));


// Vista de reprte en pdf lista de archivos en la base de datos con su cliente y coordinador de propiedad.((( REPORTE 5 )))
Route::get('admin/Reportes/listaFiles', array(

			'as' => 'listaFiles.view',
			'uses' => 'ReportsController@viewReportListFile',
			'before' => 'auth'
	));

// Descarga reporte de lista de archivos existentes.
Route::get('admin/Reportes/downloadlistaFiles', array(

			'as' => 'listaFiles.download',
			'uses' => 'ReportsController@downloadReportListFile',
			'before' => 'auth'
	));

// Vista de reporte en pdf lista de archivos por nombre normal y encriptado   ((((( REPORTE 6 )))))
Route::get('admin/Reportes/listaFilesforName', array(

			'as' => 'listaFilesforName.view',
			'uses' => 'ReportsController@viewReportListFileNameOrg',
			'before' => 'auth'
	));

// Descarga reporte de lista de archivos por nombre normal y encriptado
Route::get('admin/Reportes/downloadlistaFilesforName', array(

			'as' => 'listaFilesforName.download',
			'uses' => 'ReportsController@downloadReportListFileNameOrg',
			'before'=> 'auth'
	));


// Vista de lista en pdf de clientes registrados        ((((( REPORTE 7 )))))
Route::get('admin/Reportes/listaClientes', array(

			'as' => 'listaCliente.view',
			'uses' => 'ReportsController@viewReportListClient',
			'before' => 'auth'
	));

// Descarga reporte en pdf de lista de clientes.
Route::get('admin/Reportes/downloadlistaClientes', array(

			'as' => 'listaCliente.download',
			'uses' => 'ReportsController@downloadReportListClient',
			'before' => 'auth'
	));



// Vista de lista en pdf de coordinadores regitrados  ((((( REPORTE 8 )))))
Route::get('admin/Reportes/listaCoordinadores', array(

			'as' => 'listaCoord.view',
			'uses' => 'ReportsController@viewReportListCoords',
			'before' => 'auth'
	));

// Descarga de lista en pdf de coordinadores regitrados
Route::get('admin/Reportes/downloadlistaCoordinadores', array(

			'as' => 'listaCoord.download',
			'uses' => 'ReportsController@downloadReportListCoords',
			'before' => 'auth'
	));

// Vista de lista en pdf de asignaciones o relaciones cliente coordinador ((((( REPORTE 9 )))))
Route::get('admin/Reportes/listaRelaciones', array(

			'as' => 'listaRelacion.view',
			'uses' => 'ReportsController@viewReportListRel',
			'before' => 'auth'
	));

// Descarga de lista en pdf de asignaciones o relaciones cliente coordinador
Route::get('admin/Reportes/downloadlistaRelaciones', array(

			'as' => 'listaRelacion.download',
			'uses' => 'ReportsController@downloadReportListRel',
			'before' => 'auth'
	));


// Vista de lista en pdf de imagenes de cuenta de coordinador ((((( REPORTE 10 )))))
Route::get('admin/Reportes/listaImagesCoord/view', array(

			'as' => 'listaImagesCoord.view',
			'uses' => 'ReportsController@viewReportListImageCoord',
			'before' => 'auth'
	));

// download lista en pdf de imagenes de cuenta de coordinador
Route::get('admin/Reportes/downloadlistaImagesCoord/view', array(

			'as' => 'listaImagesCoord.download',
			'uses' => 'ReportsController@downloadViewReportListImageCoord',
			'before' => 'auth'
	));

// Vista de lista en pdf de imagenes de cuenta de cliente ((((( REPORTE 11 )))))
Route::get('admin/Reportes/listaImagesClient/view', array(

			'as' => 'listaImagesClient.view',
			'uses' => 'ReportsController@viewReportListImageClient',
			'before' => 'auth'
	));

// download lista en pdf de imagenes de cuenta de coordinador
Route::get('admin/Reportes/downloadlistaImagesCoord/view', array(

			'as' => 'listaImagesClient.download',
			'uses' => 'ReportsController@downloadViewReportListImageClient',
			'before' => 'auth'
	));


					// REPORTES DE ARCHIVOS DE COORDINADOR EXLUSIVO

// Generar y descargar reporte de estadistica de archivos de coordinador seleccionado. (((((( REPORTE 1 )))))
					// SOLO DESCARGA
Route::get('admin/Reportes/estadisticaFiles/Coordinador/{id}', array(

			'as' => 'estadisticaFilesCoordReport.download',
			'uses' => 'ReportsCoordController@statisticFilesCoord',
			'before' => 'auth'
	));

// Ver y descargar lista en pdf de archivos de coordinador seleccionado ((((( REPORTE 2 )))))
Route::get('admin/Reportes/listaFilesCoord/{id}', array(

			'as' => 'listaFilesCoord.view',
			'uses' => 'ReportsCoordController@viewReportListCoordFiles',
			'before' => 'auth'
	));

Route::get('admin/Reportes/downloadlistaFilesCoord/{id}', array(

			'as' => 'listaFilesCoord.download',
			'uses' => 'ReportsCoordController@downloadReportListCoordFiles',
			'before' => 'auth'
	));

// Ver y descargar lista en pdf de archivos recibidos de coordinador seleccionado (((((( REPORTE 3 ))))))
Route::get('admin/Reportes/listaFilesReceivedCoord/{id}', array(

			'as' => 'listaFilesReceivedCoord.view',
			'uses' => 'ReportsCoordController@viewListReportReceivedCoordFiles',
			'before' => 'auth'
	));


Route::get('admin/Reportes/downloadlistaFilesReceivedCoord/{id}', array(

			'as' => 'listaFilesReceivedCoord.download',
			'uses' => 'ReportsCoordController@downloadListReportReceivedCoordFiles',
			'before' => 'auth'
	));

// Ver y descargar lista de archivos enviados por coordinador seleccionado. (((((( REPORTE 4 ))))))
Route::get('admin/Reportes/listaFilesSubmitCoord/{id}', array(

			'as' => 'listaFilesSubmitCoord.view',
			'uses' => 'ReportsCoordController@viewlistReportSubmitCoordFiles',
			'before' => 'auth'
	));

Route::get('admin/Reportes/downloadlistaFilesSubmitCoord/{id}', array(

			'as' => 'listaFilesSubmitCoord.download',
			'uses' => 'ReportsCoordController@downloadlistReportSubmitCoordFiles',
			'before' => 'auth'
	));

// Ver y descargar lista de archivos eliminados por algun usuario pertenecientes al coordinador seleccionado. (( REPORTE 5 ))
Route::get('admin/Reportes/listaFilesDeletedCoord/{id}', array(

			'as' => 'listaFilesDeletedCoord.view',
			'uses' => 'ReportsCoordController@viewlistReportDeletedCoordFilesForUser',
			'before' => 'auth'
	));

Route::get('admin/Reportes/downloadlistaFilesDeletedCoord/{id}', array(

			'as' => 'listaFilesDeletedCoord.download',
			'uses' => 'ReportsCoordController@downloadlistReportDeletedCoordFilesForUser',
			'before' => 'auth'
	));

// DESCARGAR INFORMACION DEL CLIENTE SELECCIONADO
Route::get('admin/Reportes/downloadDetalleCliente/{id}', array(

			'as' => 'detalleCliente.download',
			'uses' => 'ReportsClienteController@downloadPerfilCliente',
			'before' => 'auth'
	)
);


// DESCARGAR INFORMACION DEL COORDINADOR SELECCIONADO
Route::get('admin/Reportes/downloadDetalleCoordinador/{id}', array(

			'as' => 'detalleCoordinador.download',
			'uses' => 'ReportsCoordController@downloadPerfilCoord',
			'before' => 'auth'
	)
);

//DESCARGAR INFORMACION DEL DEPARTAMENTO SELECCIONADO
Route::get('admin/Reportes/downloadDetalleDepto/{Id_Depto}', array(

			'as' => 'detalleDepto.download',
			'uses' => 'ReportsController@downloadDetalleDepto',
			'before' => 'auth'
	)
);

					


					// REPORTES DE ARCHIVOS DE CLIENTE EXLUSIVO

// Generar y descargar reporte de estadistica de archivos del cliente seleccionado. (((((( REPORTE 1 )))))
					// SOLO DESCARGA
Route::get('admin/Reportes/estadisticaFiles/Cliente/{id}', array(

			'as' => 'estadisticaFilesClientReport.download',
			'uses' => 'ReportsClienteController@statisticFilesClient',
			'before' => 'auth'
	));

// Ver y descargar lista en pdf de archivos del cliente seleccionado ((((( REPORTE 2 )))))
Route::get('admin/Reportes/listaFilesClient/{id}', array(

			'as' => 'listaFilesClient.view',
			'uses' => 'ReportsClienteController@viewReportListClientFiles',
			'before' => 'auth'
	));

Route::get('admin/Reportes/downloadlistaFilesClient/{id}', array(

			'as' => 'listaFilesClient.download',
			'uses' => 'ReportsClienteController@downloadReportListClientFiles',
			'before' => 'auth'
	));

// Ver y descargar lista en pdf de archivos recibidos del cliente seleccionado (((((( REPORTE 3 ))))))
Route::get('admin/Reportes/listaFilesReceivedClient/{id}', array(

			'as' => 'listaFilesReceivedClient.view',
			'uses' => 'ReportsClienteController@viewListReportReceivedClientFiles',
			'before' => 'auth'
	));


Route::get('admin/Reportes/downloadlistaFilesReceivedClient/{id}', array(

			'as' => 'listaFilesReceivedClient.download',
			'uses' => 'ReportsClienteController@downloadListReportReceivedClientFiles',
			'before' => 'auth'
	));

// Ver y descargar lista de archivos enviados por cliente seleccionado. (((((( REPORTE 4 ))))))
Route::get('admin/Reportes/listaFilesSubmitClient/{id}', array(

			'as' => 'listaFilesSubmitClient.view',
			'uses' => 'ReportsClienteController@viewlistReportSubmitClientFiles',
			'before' => 'auth'
	));

Route::get('admin/Reportes/downloadlistaFilesSubmitClient/{id}', array(

			'as' => 'listaFilesSubmitClient.download',
			'uses' => 'ReportsClienteController@downloadlistReportSubmitClientFiles',
			'before' => 'auth'
	));

// Ver y descargar lista de archivos eliminados por algun usuario pertenecientes al cliente seleccionado. (( REPORTE 5 ))
Route::get('admin/Reportes/listaFilesDeletedClient/{id}', array(

			'as' => 'listaFilesDeletedClient.view',
			'uses' => 'ReportsClienteController@viewlistReportDeletedClientFilesForUser',
			'before' => 'auth'
	));

Route::get('admin/Reportes/downloadlistaFilesDeletedClient/{id}', array(

			'as' => 'listaFilesDeletedClient.download',
			'uses' => 'ReportsClienteController@downloadlistReportDeletedClientFilesForUser',
			'before' => 'auth'
	));




/* Termina rutas para REPORTES-------------------------------------------------------- */









/* --------------------------U S E R     C O O R D I N A D O R E S -----------------------------------------------*/


/* ------------------ Rutas de procesamiento de login COORDINADORES ---------------------------------------- */

Route::post('login/FrmLoginCoords', array(

	     'as' => 'FrmLoginCoords',
	     'uses' => 'LoginCoordController@post_login'
	     
	)
);

Route::get('coordinador/Logout', array(
	      
	       'as' =>'Logout.coordinador',
	       'uses' => 'LoginCoordController@get_logout'
	        )
);

Route::get('Error/Error_RedireccionCoordinador', function()
    {
    	return View::make('coordinador.ErrorRedireccion');
    });

/* -------------------TERMINA Rutas de procesamiento de login COORDINADORES -------------------------------- */

/* -----------Ruta para ACTIVIDAD COORDINADOR------------- */

/* PENDIENTE */
Route::get('coordinador/Actividad', array(

		'as' => 'Actividad.coordinador',
		'uses' => 'UserCdrActividadController@index',
		'before' => 'authCoord'
	)

);

/* -----------Termina ruta para ACTIVIDAD COORDINADOR------------- */

Route::get('coordinador/userProfile', array(

		'as' => 'userProfile.coordinador',
		'uses' => 'UserCdrConfigController@userProfile',
		'before' => 'authCoord'
	)
);

Route::put('coordinador/updateProfile', array(
	      
	      'as' => 'CoordinadorAuth.update', 
	      'uses' => 'UserCdrConfigController@updatedProfile',
	      'before' => 'authCoord'
	)
);


Route::get('coordinador/SubmitFiles/view', array(

		'as' => 'viewFilesOut.coordinador',
		'uses' => 'UserCdrUploadFilesController@viewFilesOut',
		'before' => 'authCoord'
	)
);

Route::get('coordinador/ReceivedFiles/view', array(

		'as' => 'viewFilesIn.coordinador',
		'uses' => 'UserCdrUploadFilesController@viewFilesIn',
		'before' => 'authCoord'
	)
);

Route::get('coordinador/myClients/view', array(

		'as' => 'viewMyClients.coordinador',
		'uses' => 'UserCdrUploadFilesController@viewMyClients',
		'before' => 'authCoord'
	)
);


Route::get('coordinador/uploadFiles/panelClient/{Cliente_Id}', array(

		'as' => 'viewPanelUpload.coordinador',
		'uses' => 'UserCdrUploadFilesController@viewPanelUpload',
		'before' => 'authCoord'
	)
);

Route::get('coordinador/detalleCliente/{Cliente_Id}', array(

		'as' => 'detalleMyCliente.Coordinador',
		'uses' => 'UserCdrConfigController@detalleMyCliente',
		'before' => 'authCoord'
	)
);

Route::get('coordinador/statistics/view', array(

		'as' => 'viewStatistics.coordinador',
		'uses' => 'UserCdrUploadFilesController@getStatistics',
		'before' => 'authCoord'	
	)
);

Route::post('coordinador/uploadFiles', array(

		'as' => 'uploadFiles.coordinador',
		'uses' => 'UserCdrUploadFilesController@postUploadFile',
		'before' => 'authCoord'
	)
);


Route::get('coordinador/myPassword/change', array(

		'as' => 'changeMyPassword.coordinador',
		'uses' => 'UserCdrConfigController@viewEditPasswd',
		'before' => 'authCoord'
	)
);

Route::put('coordinador/myPassword/updated', array(

		'as' => 'updateMyPassword.coordinador',
		'uses' => 'UserCdrConfigController@updatePasswd',
		'before' => 'authCoord'
	)
);

Route::get('coordinador/myImagePerfil/delete', array(
		
		'as'=> 'deleteMyImagePerfil.coordinador',
		'uses' => 'UserCdrConfigController@deleteMyImage',
		'before' => 'authCoord'	
	)
);


Route::get('coordinador/detalle/Archivo/{Id_File}', array(

		'as' => 'detalleArchivo.coordinador',
		'uses' => 'UserCdrUploadFilesController@detalleFile',
		'before' => 'authCoord'
	)
);


Route::get('coordinador/deleteFile/{Id_File}', array(

			'as' => 'FileDeleted.Coordinador',
			'uses' => 'UserCdrUploadFilesController@getDeleteFileSt',
			'before' => 'authCoord'
	)
);

Route::get('coordinador/acerca/developed-Tics', array(

			'as' => 'acercaDeveloped.Coordinador',
			'uses' => 'UserCdrUploadFilesController@viewDeveloped',
			'before' => 'authCoord'
	)
);









/* --------------------------U S E R     C L I E N T E S  -----------------------------------------------*/


Route::post('login/FrmLoginClientes', array(

	     'as' => 'FrmLoginClientes',
	     'uses' => 'LoginClienteController@post_login'
	     
	)
);

Route::get('cliente/Logout', array(
	      
	       'as' =>'Logout.cliente',
	       'uses' => 'LoginClienteController@get_logout'
	        )
);

Route::get('Error/Error_RedireccionCliente', function()
    {
    	return View::make('cliente.ErrorRedireccion');
    });

/* -------------------TERMINA Rutas de procesamiento de login COORDINADORES -------------------------------- */

Route::get('cliente/receivedFiles/view', array(

		'as' => 'viewFilesIn.cliente',
		'uses' => 'UserClientUploadFilesController@viewFilesReceived',
		'before' => 'authCliente'
	)
);

Route::get('cliente/submitFiles/view', array(

		'as' => 'viewFilesout.cliente',
		'uses' => 'UserClientUploadFilesController@viewFilesSubmit',
		'before' => 'authCliente'
	)
);

Route::get('cliente/detalle/Archivo/{Id_File}', array(

		'as' => 'detalleArchivo.cliente',
		'uses' => 'UserClientUploadFilesController@detalleFile',
		'before' => 'authCliente'
	)
);


Route::get('cliente/contacts/view', array(

		'as' => 'contactsView.cliente',
		'uses' => 'UserClientUploadFilesController@viewMyCoords',
		'before' => 'authCliente'
	)
);

Route::get('cliente/detalleContact/{Coordinador_Id}', array(

		'as' => 'detalleMyCoord.Cliente',
		'uses' => 'UserClientConfigController@detalleMyCoord',
		'before' => 'authCliente'
	)
);


Route::get('cliente/uploadFiles/panelUser/{Coordinador_Id}', array(

		'as' => 'viewPanelUpload.cliente',
		'uses' => 'UserClientUploadFilesController@viewPanelUpload',
		'before' => 'authCliente'
	)
);

Route::post('cliente/uploadFiles', array(

		'as' => 'uploadFiles.cliente',
		'uses' => 'UserClientUploadFilesController@postUploadFile',
		'before' => 'authCliente'
	)
);

Route::get('cliente/statistics/view', array(

		'as' => 'viewStatistics.cliente',
		'uses' => 'UserClientUploadFilesController@getStatistics',
		'before' => 'authCliente'	
	)
);

Route::get('cliente/userProfile', array(

		'as' => 'userProfile.cliente',
		'uses' => 'UserClientConfigController@userProfile',
		'before' => 'authCliente'
	)
);

Route::put('cliente/updateProfile', array(
	      
	      'as' => 'ClienteAuth.update', 
	      'uses' => 'UserClientConfigController@updatedProfile',
	      'before' => 'authCliente'
	)
);

Route::get('cliente/myPassword/change', array(

		'as' => 'changeMyPassword.cliente',
		'uses' => 'UserClientConfigController@viewEditPasswd',
		'before' => 'authCliente'
	)
);

Route::put('cliente/myPassword/updated', array(

		'as' => 'updateMyPassword.cliente',
		'uses' => 'UserClientConfigController@updatePasswd',
		'before' => 'authCliente'
	)
);


Route::get('cliente/myImagePerfil/delete', array(
		
		'as'=> 'deleteMyImagePerfil.cliente',
		'uses' => 'UserClientConfigController@deleteMyImage',
		'before' => 'authCliente'	
	)
);

Route::get('cliente/deleteFile/{Id_File}', array(

			'as' => 'FileDeleted.Cliente',
			'uses' => 'UserClientUploadFilesController@getDeleteFileSt',
			'before' => 'authCliente'
	)
);

Route::get('cliente/acerca/developed-Tics', array(

			'as' => 'acercaDeveloped.Cliente',
			'uses' => 'UserClientUploadFilesController@viewDeveloped',
			'before' => 'authCliente'
	)
);
