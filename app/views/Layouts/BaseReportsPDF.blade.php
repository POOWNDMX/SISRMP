<!DOCTYPE html>

<html lang="en">

<head>

	   <!--meta charset="UTF-8"-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
	  <title>@yield('titulo')</title>

    {{HTML::style('assetsPDF/estiloPDF.css')}}


    @section('cabecera')

    @show
</head>

      {{ HTML::image('assets/img/logo.png', "", array('class' => 'logo')) }} 
    
  <header class="clearfix">
    <div id="company">
      <h2 class="name">Ramírez Medellín S.C.</h2>
      <div><font color="#043C70">Departamento de Tecnologías de la Información y Comunicación - TIC's</font></div><br>
      <div>@yield('tituloReport')</div>
    </div>
    </div>
  </header>

  <body>

        @yield('cuerpo')
        
        
        
       
  </body>
  
  
</html>