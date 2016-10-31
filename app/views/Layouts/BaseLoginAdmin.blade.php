<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>@yield('titulo')</title>

    {{HTML::style('assets/css-bootstrap/bootstrap.min.css')}}
    {{HTML::style('assets/css-Login/boots-alter.css')}}

	@section('cabecera')
    @show

</head>

<body>

    <div class="page-header">
        <h4><center>
        {{ HTML::image('assets/img/logo.png', "", array('width' => '25', 'height' => '25')) }} Ramírez Medellín, S.C.
        </center></h4>
    </div>
      
    @yield('cuerpo')

        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p>Page © - 2016</p>
                        <p>Developed by 
                            <strong>{{HTML::link('http://rmp.mx/', 'Ramírez Medellín, S.C.', 'target = _blank')}}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </footer>


     {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js') }}
     {{ HTML::script('assets/js-bootstrap/bootstrap.min.js') }}
     {{ HTML::script('assets/js-bootstrap/jquery.min.js') }}
     {{ html::script('assets/js-bootstrap/bootstrap-modal.js') }}
   

</body>
</html>