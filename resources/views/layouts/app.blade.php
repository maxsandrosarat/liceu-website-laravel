<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="utf-8" />
        
        <link rel="shortcut icon" href="/storage/images/favicon.png"/>
        <title>Colégio Liceu Unid. II</title>
        
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/019f61e4ad.js" crossorigin="anonymous"></script>
	</head>
	<body>
        <div class="subpage">
            @component('components.componente_header')
		    @endcomponent

		    @component('components.componente_menu')
            @endcomponent

            <main class="content">
                @hasSection ('content')
                    @yield('content')   
                @endif
            </main>

            @component('components.componente_footer')
            @endcomponent
        </div>
            <!-- Scripts -->
			<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('js/jquery.min.js') }}"></script>
            <script src="{{ asset('js/jquery.scrollex.min.js') }}"></script>
            <script src="{{ asset('js/skel.min.js') }}"></script>
            <script src="{{ asset('js/util.js') }}"></script>
            <script src="{{ asset('js/main.js') }}"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    //OPÇÕES DE LOGIN
                    $('#principal').children('div').hide();
                    $('#tipoLogin').on('change', function(){
                        
                        var selectValor = '#'+$(this).val();
                        $('#principal').children('div').hide();
                        $('#principal').children(selectValor).show();
            
                    });
                });

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
	
				function formataNumeroTelefone() {
					var numero = document.getElementById('telefone').value;
					var length = numero.length;
					var telefoneFormatado;
					
					if (length == 10) {
					telefoneFormatado = '(' + numero.substring(0, 2) + ') ' + numero.substring(2, 6) + '-' + numero.substring(6, 10);
					} else if (length == 11) {
					telefoneFormatado = '(' + numero.substring(0, 2) + ') ' + numero.substring(2, 7) + '-' + numero.substring(7, 11);
					} else {
						telefoneFormatado = 'Número Inválido, digite número com DDD';
					}
					id('telefone').value = telefoneFormatado;
				}
	
				function id(campo){
					return document.getElementById(campo);
				}
	
				function mostrarSenhaUser(){
					var tipo = document.getElementById("senha-user");
					if(tipo.type=="password"){
						tipo.type = "text";
						id('icone-senha-user').innerHTML = "visibility_off";
						id('botao-senha-user').className = "btn btn-warning btn-sm";
						id('botao-senha-user').title = "Ocultar Senha";
					} else {
						tipo.type = "password";
						id('icone-senha-user').innerHTML = "visibility";
						id('botao-senha-user').className = "btn btn-success btn-sm";
						id('botao-senha-user').title = "Mostrar Senha";
					}
				}

				function mostrarSenhaOutro(){
					var tipo = document.getElementById("senha-outro");
					if(tipo.type=="password"){
						tipo.type = "text";
						id('icone-senha-outro').innerHTML = "visibility_off";
						id('botao-senha-outro').className = "btn btn-warning btn-sm";
						id('botao-senha-outro').title = "Ocultar Senha";
					} else {
						tipo.type = "password";
						id('icone-senha-outro').innerHTML = "visibility";
						id('botao-senha-outro').className = "btn btn-success btn-sm";
						id('botao-senha-outro').title = "Mostrar Senha";
					}
				}

				function mostrarSenhaAdmin(){
					var tipo = document.getElementById("senha-admin");
					if(tipo.type=="password"){
						tipo.type = "text";
						id('icone-senha-admin').innerHTML = "visibility_off";
						id('botao-senha-admin').className = "btn btn-warning btn-sm";
						id('botao-senha-admin').title = "Ocultar Senha";
					} else {
						tipo.type = "password";
						id('icone-senha-admin').innerHTML = "visibility";
						id('botao-senha-admin').className = "btn btn-success btn-sm";
						id('botao-senha-admin').title = "Mostrar Senha";
					}
				}

				function principal(){
					window.location.href = "/";
				}
            </script>
	</body>
</html>