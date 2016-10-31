<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Administrador extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('administrador', function($tabla){
 
        $tabla->increments('Id_Admin');
        $tabla->string('first-name', 50);
        $tabla->string('last-name', 50);
        $tabla->string('username', 20)->unique();
        $tabla->string('password', 100);
        $tabla->rememberToken();
        $tabla->timestamps();
 
    });
 
    DB::table('administrador')->insert(
         array(
             'username' => 'juankeke9929921',
             'password' => Hash::make('juankeke9929921')
         )
     );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('administrador');
	}

}
