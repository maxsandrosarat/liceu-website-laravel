@extends('layouts.app_logado', ["current"=>"principal"])

@section('body')
<div class="subpage">
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Álbuns</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Cadastrar Novo Álbum">
                <i class="material-icons blue md-60">add_photo_alternate</i>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Album</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border">
                            <div class="card-body">
                                <form action="/outro/album" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="titulo">Titulo</label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Exemplo: Dias das Mâes" required>
                                        <br/>
                                        <h5>Descrição</h5>
                                        <textarea class="form-control" name="descricao" id="descricao" rows="5" cols="20" maxlength="240" placeholder="Escreva aqui a descrição"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            @if(count($albuns)==0)
                <div class="alert alert-danger" role="alert">
                    Sem álbuns cadastrados!
                </div>
            @else
            <div class="jumbotron bg-light border border-secondary">
                <div class="row justify-content-center">
                    <div class="col align-self-center">
                    <div class="card-deck">
                        @foreach ($albuns as $album)
                        <div class="d-flex justify-content-center centralizado">
                            <div class="card border-primary text-center" style="width: 300px;">
                                @if($album->foto_capa!="")<img src="/storage/{{$album->foto_capa}}" class="card-img-top" alt="...">@else
                                <i class="material-icons md-200">no_photography</i>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{$album->titulo}}</h5>
                                    @if($album->descricao!="")<p class="card-text">{{$album->descricao}}</p>@endif
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><button type="button" class="btn btn-sm btn-primary" disabled><i class="material-icons md-48">photo_camera</i><span class="badge badge-light">{{$album->qtd_fotos}}</span></button> <button type="button" class="btn btn-sm btn-success" disabled><i class="material-icons md-48">thumb_up</i><span class="badge badge-light">{{$album->total_gostei}}</span></button> <button type="button" class="btn btn-sm btn-danger" disabled><i class="material-icons md-48">thumb_down</i><span class="badge badge-light">{{$album->total_naogostei}}</span></button></li>
                                    <li class="list-group-item">Criação: {{date("d/m/Y H:i", strtotime($album->created_at))}}</li>
                                    <li class="list-group-item">Atualização: {{date("d/m/Y H:i", strtotime($album->updated_at))}}</li>
                                </ul>
                                <div class="card-body">
                                    <a href="/outro/album/adicionar/{{$album->id}}" class="badge badge-info" data-toggle="tooltip" data-placement="right" title="Adicionar Fotos"><i class="material-icons md-18 black">add_a_photo</i></a>
                                    <button type="button" class="badge badge-warning" data-toggle="modal" data-target="#exampleModal{{$album->id}}" data-toggle="tooltip" data-placement="left" title="Editar">
                                        <i class="material-icons md-18">edit</i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$album->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Álbum - {{$album->titulo}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card border">
                                                    <div class="card-body">
                                                        <form action="/outro/album/editar/{{$album->id}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="titulo">Título
                                                                <input type="text" class="form-control" name="titulo" id="titulo" value="{{$album->titulo}}" required></label></label>
                                                                <br/>
                                                                <h5>Descrição</h5>
                                                                <textarea class="form-control" name="descricao" id="descricao" rows="5" cols="20" maxlength="240">{{$album->descricao}}</textarea>
                                                                <br/>
                                                                <h5>Ativo?</h5>
                                                                <input type="radio" id="sim" name="ativo" value="1" @if($album->ativo=="1") checked @endif required>
                                                                <label for="sim">Sim</label>
                                                                <input type="radio" id="nao" name="ativo" value="0" @if($album->ativo=="0") checked @endif required>
                                                                <label for="nao">Não</label>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <a href="/outro/album/apagar/{{$album->id}}" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Excluir"><i class="material-icons md-18">delete</i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<br>
<a href="/outro/principal" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection
