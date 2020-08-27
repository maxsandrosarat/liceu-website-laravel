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
		<!-- Header -->
		<header id="header" class="alt">
			<img onclick="principal()" class="logo2" src="storage/images/liceu.png"/>
			<a href="" class="icon fa-phone-alt" data-toggle="modal" data-target="#exampleModal"><span class="label">Telefone</span></a>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Telefone e WhatsApp</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" style="color: black;">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="text-align: center">
						<h5 class="icon fa-phone"/> (67) 3361-9120 <a href="tel:6733619120" type="button" class="btn btn-primary">Ligar</a><br/>
						<h5 class="icon fa-whatsapp"/> (67) 99125-0425 <a href="https://api.whatsapp.com/send?phone=5567991250425&text=Digite%20sua%20mensagem" type="button" class="btn btn-success">Mandar Mensagem</a><br/>
						<h5 class="icon fa-envelope"/> colegioliceucg@gmail.com <a href="mailto:sac.pet67@gmail.com" type="button" class="btn btn-danger">Mandar um e-mail</a>
					</div>
					</div>
				</div>
				</div>
			<a href="https://www.facebook.com/ColegioLiceuUnidII/" target="_blank" class="icon fa-facebook-f"><span class="label">Facebook</span></a>
			<a href="https://www.instagram.com/colegio_liceu_unidade_2/" target="_blank" class="icon fa-instagram"><span class="label">Instagram</span></a>
			<a href="#" class="icon fa-map-marker-alt" data-toggle="modal" data-target="#exampleModa3" data-toggle="tooltip" data-placement="bottom" title="Localização"><span class="label">Localização</span></a>
				<!-- Modal -->
				<div class="modal fade" id="exampleModa3" tabindex="-1" role="dialog" aria-labelledby="exampleModa2Label" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModa2Label">Endereço</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" style="color: black;">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<iframe width="100%" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14952.881171440864!2d-54.638274!3d-20.4561433!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x76cb21d0873c6c91!2sCol%C3%A9gio%20Liceu%20-%20Unidade%202!5e0!3m2!1spt-BR!2sbr!4v1596487710643!5m2!1spt-BR!2sbr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe><a class="btn btn-primary" href="https://goo.gl/maps/85sbyJmetesu1vRy5">Ir para o Maps</a>
					  </div>
					</div>
				  </div>
				</div>
			<a href="#menu">Menu</a>
		</header>

		@component('components.componente_menu')
        @endcomponent

        <!-- Banner -->
			<section class="banner full">
				@foreach ($banners as $banner)
				<article>
					<img src="storage/{{$banner->foto}}" alt="foto_banner{{$banner->id}}" />
					<div class="inner">
						<header>
							<p>{!!html_entity_decode($banner->descricao)!!}</p>
							<h2>{{$banner->titulo}}</h2>
						</header>
					</div>
				</article>
				@endforeach
			</section>

		<!-- One -->
			<section id="one" class="wrapper style2">
				<div class="inner">
					<div class="grid-style">
						@foreach ($posts as $post)
						<div>
							<div class="box">
								<div class="image fit">
									<img src="storage/{{$post->foto}}" alt="foto_post{{$post->id}}" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>{{date("d/m/Y", strtotime($post->data))}}</p>
										<h2>{{$post->titulo}}</h2>
									</header>
									<p>{{$post->descricao}}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>AQUI O SUCESSO É GARANTIDO</p>
						<h2>VEM SER LICEU</h2>
					</header>
				</div>
			</section>

		<!-- Three -->
			<section id="three" class="wrapper style2">
				<div class="inner">
					<header class="align-center">
						<p class="special">TEMOS MUITO ORGULHO DOS NOSSOS ALUNOS</p>
						<h2>Outros Eventos</h2>
					</header>
					<div class="gallery">
						@foreach ($fotos as $foto)
						<div>
							<div class="image fit">
								<img src="storage/{{$foto->foto}}" alt="foto{{$foto->id}}" />
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</section>

            @component('components.componente_footer')
            @endcomponent

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

				function principal(){
					window.location.href = "/";
				}
				
			</script>
	</body>
</html>