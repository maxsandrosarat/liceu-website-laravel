@extends('layouts.app_logado', ["current"=>"cadastros"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Lista de Anúncios</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Adicionar Novo Anúncio">
                <i class="material-icons blue md-60">add_circle</i>
            </a>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Anúncio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="/admin/anuncios" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg" required>
                                <br/>
                                <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                <br/><br/>
                                <label for="nome">Nome do Anuncio</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Exemplo: Pet67" required>
                                <label for="link">Link</label>
                                <input type="text" class="form-control" name="link" id="link" placeholder="Exemplo: https://pet67.com.br" required>
                                <br>
                                <h5>Anúncio Ativo?</h5>
                                <input type="radio" id="sim" name="ativo" value="1" required>
                                <label for="sim">Sim</label>
                                <input type="radio" id="nao" name="ativo" value="0" required>
                                <label for="nao">Não</label>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            @if(count($anuncios)==0)
                <div class="alert alert-danger" role="alert">
                    Sem anuncios cadastrados!
                </div>
            @else
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Link</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anuncios as $anuncio)
                    <tr>
                        <td>{{$anuncio->id}}</td>
                        <td width="120"><button type="button" data-toggle="modal" data-target="#exampleModalFoto{{$anuncio->id}}">@if($anuncio->foto!="")<img style="margin:0px; padding:0px;" src="/storage/{{$anuncio->foto}}" alt="foto_anuncio" width="50%">@endif</button></td>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalFoto{{$anuncio->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="/storage/{{$anuncio->foto}}" alt="foto_anuncio" style="width: 100%">
                            </div>
                            </div>
                        </div>
                        </div>
                        <td>{{$anuncio->nome}}</td>
                        <td>{{$anuncio->link}}</td>
                        <td>@if($anuncio->ativo=="1") SIM @else NÃO @endif</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal{{$anuncio->id}}" data-toggle="tooltip" data-placement="left" title="Editar">
                                <i class="material-icons md-48">edit</i>
                            </button>
                            
                            <div class="modal fade" id="exampleModal{{$anuncio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Anúncio</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/admin/anuncios/editar/{{$anuncio->id}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="foto">Foto</label>
                                                <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg">
                                                <br/>
                                                <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                                <br/><br/>
                                                <label for="nome">Nome do Anuncio</label>
                                                <input type="text" class="form-control" name="nome" id="nome" value="{{$anuncio->nome}}" required>
                                                <label for="link">Link</label>
                                                <input type="text" class="form-control" name="link" id="link" value="{{$anuncio->link}}" required>
                                                <br>
                                                <h5>Anúncio Ativo?</h5>
                                                <input type="radio" id="sim" name="ativo" value="1" @if($anuncio->ativo=="1") checked @endif required>
                                                <label for="sim">Sim</label>
                                                <input type="radio" id="nao" name="ativo" value="0" @if($anuncio->ativo=="0") checked @endif required>
                                                <label for="nao">Não</label>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                                    </div>
                                </form>
                                </div>
                                </div>
                            </div>
                            <a href="/admin/anuncios/apagar/{{$anuncio->id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Excluir"><i class="material-icons md-48">delete</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>

    </div>
    <br>
    <a href="/admin/cadastros" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection