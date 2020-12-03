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
        
        .material-icons.black { 
			color: black;
		}

		.material-icons.md-18 { font-size: 18px; }
		.material-icons.md-24 { font-size: 24px; }
		.material-icons.md-36 { font-size: 36px; }
		.material-icons.md-48 { font-size: 24px; }
        .material-icons.md-60 { font-size: 60px; }
        .material-icons.md-200 { font-size: 200px; }
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
      <div class="subpage">
        <div class="card border">
            <div class="card-body">
                <h5 class="card-title">Álbum - {{$album->titulo}}</h5>
                <input type="hidden" name="album_id" value="{!! $album->id !!}">
                <div class="jumbotron bg-light border border-secondary">
                    <div class="row justify-content-center">
                        <div class="col align-self-center">
                            <div class="card-deck" id="fotos">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <a href="/" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
    {!! csrf_field() !!}
    @component('components.componente_footer_logado')
    @endcomponent
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function gostei(id)
				{
					$.post("/foto/gostei",{id: id,_token:$('input[name="_token"]').attr("value")},function (response) {});
					carregarAlbuns();
				}

				function naoGostei(id)
				{
					$.post("/foto/naoGostei",{id: id,_token:$('input[name="_token"]').attr("value")},function (response) {});
					carregarAlbuns();
				}

				function montarDiv(foto){
                    //console.log(foto.created_at);
                    s = "";
                    var date = new Date(foto.created_at);
                    var txtBonito = date.toLocaleString('pt-BR');
                    if(foto.descricao==='' || foto.descricao==null){
                        s = 
                        '<div class="d-flex justify-content-center centralizado">' +
                            '<div class="card border-primary text-center" style="width: 300px;">' +
                                '<a data-toggle="modal" data-target="#exampleModalFoto'+ foto.id + '"><img src="/storage/'+ foto.foto + '" class="card-img-top" alt="..."></a>' +
                                '<div class="card-body">' +
                                '<a href="javascript:void(0);" onclick="gostei('+ foto.id + ');" data-toggle="tooltip" data-placement="bottom" title="Curtir"><i class="material-icons">thumb_up</i><span class="badge badge-light">' + foto.total_gostei + '</span></a>' +
							    '<a href="javascript:void(0);" onclick="naoGostei('+ foto.id + ');" data-toggle="tooltip" data-placement="bottom" title="Não Curtir"><i class="material-icons">thumb_down</i><span class="badge badge-light">' + foto.total_naogostei + '</span></a>' +
                                '<p class="card-text"><small class="text-muted">Postagem: '+ txtBonito + '</small></p>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="modal fade bd-example-modal-lg" id="exampleModalFoto'+ foto.id + '" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog modal-lg" role="document">' +
                            '<div class="modal-content">' +
                            '<div class="modal-header">' +
                                '<h5 class="modal-title" id="exampleModalLabel"></h5>' +
                                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                            '</div>' +
                            '<div class="modal-body">' +
                                '@if('+ foto.foto + '!="")<img src="/storage/'+ foto.foto + '" alt="foto_produto" width="100%">@else <i class="material-icons md-60">no_photography</i> @endif' +
                            '</div>' +
                            '</div>' +
                        '</div>' +
                        '</div>'
                    } else {
                        s= 
                        '<div class="d-flex justify-content-center centralizado">' +
                            '<div class="card border-primary text-center" style="width: 300px;">' +
                                '<a data-toggle="modal" data-target="#exampleModalFoto'+ foto.id + '"><img src="/storage/'+ foto.foto + '" class="card-img-top" alt="..."></a>' +
                                '<div class="card-body">' +
                                '<p class="card-text">'+ foto.descricao + '</p>' +
                                '<a href="javascript:void(0);" onclick="gostei('+ foto.id + ');" data-toggle="tooltip" data-placement="bottom" title="Curtir"><i class="material-icons">thumb_up</i><span class="badge badge-light">' + foto.total_gostei + '</span></a>' +
							    '<a href="javascript:void(0);" onclick="naoGostei('+ foto.id + ');" data-toggle="tooltip" data-placement="bottom" title="Não Curtir"><i class="material-icons">thumb_down</i><span class="badge badge-light">' + foto.total_naogostei + '</span></a>' +
                                '<p class="card-text"><small class="text-muted">Postagem: '+ txtBonito + '</small></p>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="modal fade bd-example-modal-lg" id="exampleModalFoto'+ foto.id + '" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog modal-lg" role="document">' +
                            '<div class="modal-content">' +
                            '<div class="modal-header">' +
                                '<h5 class="modal-title" id="exampleModalLabel"></h5>' +
                                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                            '</div>' +
                            '<div class="modal-body">' +
                                '@if('+ foto.foto + '!="")<img src="/storage/'+ foto.foto + '" alt="foto_produto" width="100%">@else <i class="material-icons md-60">no_photography</i> @endif' +
                            '</div>' +
                            '</div>' +
                        '</div>' +
                        '</div>'
                    }
                    return s;
				}

				function montarFotos(dados){
					$('#fotos>div').remove();
					for(i=0; i<dados.length; i++){
						s = montarDiv(dados[i]);
						$('#fotos').append(s);
					}
				}


				function carregarAlbuns(){
					$.get('/album', {id:$('input[name="album_id"]').attr("value")}, 
					function(resp){
						//console.log(resp);
						montarFotos(resp);
					})
				}

				$(function(){
					carregarAlbuns();
				});
    </script>
</body>
</html>

