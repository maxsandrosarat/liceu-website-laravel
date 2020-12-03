@extends('layouts.app_logado', ["current"=>"principal"])

@section('body')
<div class="subpage">
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Álbum - {{$album->titulo}}</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Cadastrar Uma Nova Foto">
                <i class="material-icons blue md-60">add_a_photo</i>
            </a>
            <a type="button" class="float-button-multiple" data-toggle="modal" data-target="#exampleModalMultiple" data-toggle="tooltip" data-placement="bottom" title="Cadastrar Várias Novas Fotos">
                <i class="material-icons violet md-60">add_to_photos</i>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border">
                            <div class="card-body">
                                <form action="/outro/album/foto" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="album" value="{{$album->id}}">
                                        <label for="foto">Foto</label>
                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg">
                                        <br/>
                                        <b style="font-size: 80%;">Você pode selecionar apenas uma foto por vez.</b><br/>
                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png").</b><br/>
                                        <b style="font-size: 80%;">Coloque a descrição desta foto.</b>
                                        <br/><br/>
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
            <!-- Modal -->
            <div class="modal fade" id="exampleModalMultiple" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Fotos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border">
                            <div class="card-body">
                                <form action="/outro/album/foto/multiple" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="album" value="{{$album->id}}">
                                        <label for="foto">Foto</label>
                                        <input type="file" id="foto" name="fotos[]" accept=".jpg,.png,jpeg" multiple>
                                        <br/>
                                        <b style="font-size: 80%;">Você pode selecionar várias fotos ao mesmo tempo.</b><br/>
                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png").</b><br/>
                                        <b style="font-size: 80%;">Coloque a descrição das fotos após o carregamento, através do editar.</b>
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
            @if(count($fotos)==0)
                <div class="alert alert-danger" role="alert">
                    Sem fotos cadastradas!
                </div>
            @else
            <div class="jumbotron bg-light border border-secondary">
                <div class="row justify-content-center">
                    <div class="col align-self-center">
                    <div class="card-deck">
                        @foreach ($fotos as $foto)
                        <div class="d-flex justify-content-center centralizado">
                            <div class="card border-primary text-center" style="width: 300px;">
                                <a data-toggle="modal" data-target="#exampleModalFoto{{$foto->id}}"><img src="/storage/{{$foto->foto}}" class="card-img-top" alt="..."></a>
                                <div class="card-body">
                                  @if($foto->descricao!="")<p class="card-text">{{$foto->descricao}}</p>@endif
                                  <button type="button" class="btn btn-sm btn-success" disabled><i class="material-icons md-48">thumb_up</i><span class="badge badge-light">{{$foto->total_gostei}}</span></button><button type="button" class="btn btn-sm btn-danger" disabled><i class="material-icons md-48">thumb_down</i><span class="badge badge-light">{{$foto->total_naogostei}}</span></button>
                                  <p class="card-text"><small class="text-muted">Postagem: {{date("d/m/Y H:i", strtotime($foto->created_at))}}</small></p>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalFoto{{$foto->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    <form action="/outro/album/foto/editar" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$foto->id}}">
                                        <input type="text" name="descricao" id="descricao" @if($foto->descricao!="") value="{{$foto->descricao}}" @else placeHolder="Digite uma descrição" @endif>
                                        <button class="btn btn-outline-success btn-sm" type="submit">Salvar</button>
                                    </form>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <a href="/outro/album/foto/apagar/{{$foto->id}}" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Excluir"><i class="material-icons md-18">delete</i></a>
                                @if($foto->foto!="")<img src="/storage/{{$foto->foto}}" alt="foto_produto" width="100%">@else <i class="material-icons md-60">no_photography</i> @endif
                            </div>
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
<a href="/outro/album" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection