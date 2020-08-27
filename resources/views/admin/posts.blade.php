@extends('layouts.app_logado', ["current"=>"principal"])

@section('body')
<div class="subpage">
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Postagens</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Criar Nova Postagem">
                <i class="material-icons blue md-60">add_circle</i>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Postagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border">
                            <div class="card-body">
                                <form action="/admin/post" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg">
                                        <br/>
                                        <b style="font-size: 80%;">Resolução Ideal da Imagem 600 x 300</b><br/>
                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                        <br/><br/>
                                        <label for="data">Data</label>
                                        <input type="date" class="form-control" name="data" id="data" required>
                                        <br/>
                                        <label for="titulo">Titulo</label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Exemplo: Dias das Mâes" required>
                                        <br/>
                                        <h5>Descrição</h5>
                                        <textarea class="form-control" name="descricao" id="descricao" rows="10" cols="40" maxlength="500" placeholder="Escreva aqui a descrição completa da postagem"></textarea>
                                        <br/>
                                        <h5>Ativo?</h5>
                                        <input type="radio" id="sim" name="ativo" value="1" required>
                                        <label for="sim">Sim</label>
                                        <input type="radio" id="nao" name="ativo" value="0" required>
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
            @if(count($posts)==0)
                <div class="alert alert-danger" role="alert">
                    Sem postagens cadastradas!
                </div>
            @else
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Criação</th>
                        <th>Última Atualização</th>
                        <th>Foto</th>
                        <th>Data</th>
                        <th>Título</th>
                        <th>Descricao</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($post->created_at))}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($post->updated_at))}}</td>
                        <td width="120"><button type="button" data-toggle="modal" data-target="#exampleModalFoto{{$post->id}}">@if($post->foto!="")<img style="margin:0px; padding:0px;" src="/storage/{{$post->foto}}" alt="foto_post" width="50%">@endif</button></td>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalFoto{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="/storage/{{$post->foto}}" alt="foto_post" style="width: 100%">
                            </div>
                            </div>
                        </div>
                        </div>
                        <td>{{date("d/m/Y", strtotime($post->data))}}</td>
                        <td>{{$post->titulo}}</td>
                        <td><button type="button" class="badge badge-primary" data-toggle="modal" data-target="#exampleModalDesc{{$post->id}}">Descrição</button></td>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalDesc{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{$post->descricao}}
                            </div>
                            </div>
                        </div>
                        </div>
                        <td>@if($post->ativo=='1') Sim @else Não @endif</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal{{$post->id}}" data-toggle="tooltip" data-placement="left" title="Editar">
                                <i class="material-icons md-48">edit</i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card border">
                                            <div class="card-body">
                                                <form action="/admin/post/editar/{{$post->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg">
                                                        <br/>
                                                        <b style="font-size: 80%;">Resolução Ideal da Imagem 600 x 300</b><br/>
                                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                                        <br>
                                                        <label for="data">Data</label><br/>
                                                        <input type="date" class="form-control" name="data" id="data" value="{{date("Y-m-d", strtotime($post->data))}}">
                                                        <label for="titulo">Título
                                                        <input type="text" class="form-control" name="titulo" id="titulo" value="{{$post->titulo}}" required></label></label>
                                                        <br/>
                                                        <h5>Descrição</h5>
                                                        <textarea class="form-control" name="descricao" id="descricao" rows="10" cols="40" maxlength="500">{{$post->descricao}}</textarea>
                                                        <br/>
                                                        <h5>Ativo?</h5>
                                                        <input type="radio" id="sim" name="ativo" value="1" @if($post->ativo=="1") checked @endif required>
                                                        <label for="sim">Sim</label>
                                                        <input type="radio" id="nao" name="ativo" value="0" @if($post->ativo=="0") checked @endif required>
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
                            <a href="/admin/post/apagar/{{$post->id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Excluir"><i class="material-icons md-48">delete</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>
    </div>
</div>
<br>
<a href="/admin/principal" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection
