<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="shortcut icon" href="/storage/images/favicon.png"/>
    <title>Colégio Liceu Unid. II</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#00008B">
	<meta name="apple-mobile-web-app-status-bar-style" content="#00008B">
    <meta name="msapplication-navbutton-color" content="#00008B">
        
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body{
            padding: 20px;
        }
        .container{
            margin-top: 20px;
        }
        td{
            text-align: justify;
        }
        #navLogin {
            color:red;
        }
        .float-button{
			position: fixed;
			bottom: 40px;
			right: 40px;
        }
        .material-icons.blue { 
			color:#0000CD;
		}

		.material-icons.white { 
			color: white;
		}

		.material-icons.md-60 { 
			font-size: 60px; 
        }
        table tbody tr td{
            text-align: center;
        }
        table thead tr th{
            text-align: center;
        }
        .centralizado {
            margin: 5px;
        }               
    }
    </style>
</head>
<body>
    <div class="container-xl">
        <header>
            @component('components.componente_navbar_logado', ["current"=>$current ?? ''])
            @endcomponent
        </header>
        @auth
            <main>
                @hasSection ('body')
                    @yield('body')   
                @endif
            </main>
        @endauth
        @guest
            <main class="py-4">
                @yield('content')
            </main>
        @endguest
        @component('components.componente_footer_logado')
        @endcomponent
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function validarSenhaForca(){
            var senha = document.getElementById('senhaForca').value;
            var forca = 0;
            /*Imprimir a senha*/
            /*document.getElementById("impSenha").innerHTML = "Senha " + senha;*/
        
            if((senha.length >= 4) && (senha.length <= 8)){
                forca += 10;
            }else if(senha.length > 8){
                forca += 25;
            }
        
            if((senha.length >= 5) && (senha.match(/[a-z]+/))){
                forca += 10;
            }
        
            if((senha.length >= 6) && (senha.match(/[A-Z]+/))){
                forca += 20;
            }
        
            if((senha.length >= 7) && (senha.match(/[@#$%&;*]/))){
                forca += 25;
            }
        
            if(senha.match(/([1-9]+)\1{1,}/)){
                forca += -25;
            }
        
            mostrarForca(forca);
        }
        
        function mostrarForca(forca){
            /*Imprimir a força da senha*/
            /*document.getElementById("impForcaSenha").innerHTML = "Força: " + forca;*/
        
            if(forca < 30 ){
                document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
            }else if((forca >= 30) && (forca < 50)){
                document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>';
            }else if((forca >= 50) && (forca < 70)){
                document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div>';
            }else if((forca >= 70) && (forca < 100)){
                document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
            }
        }
        function id(campo){
            return document.getElementById(campo);
        }

        function mostrarSenha(){
            var tipo = document.getElementById("senha");
            if(tipo.type=="password"){
                tipo.type = "text";
                id('icone-senha').innerHTML = "visibility_off";
                id('botao-senha').className = "btn btn-warning btn-sm";
                id('botao-senha').title = "Ocultar Senha";
            } else {
                tipo.type = "password";
                id('icone-senha').innerHTML = "visibility";
                id('botao-senha').className = "btn btn-success btn-sm";
                id('botao-senha').title = "Mostrar Senha";
            }
        }
    </script>
</body>
</html>

