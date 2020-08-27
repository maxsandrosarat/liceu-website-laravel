@extends('layouts.app_logado', ["current"=>"principal"])

@section('body')
<div class="subpage">
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Fotos</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Cadastrar Nova Foto">
                <i class="material-icons blue md-60">add_circle</i>
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
                                <form action="/outro/foto" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg">
                                        <br/>
                                        <b style="font-size: 80%;">Resolução Ideal da Imagem 600 x 300</b><br/>
                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                        <br/><br/>
                                        <label for="titulo">Titulo</label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Exemplo: Dias das Mâes" required>
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
            @if(count($fotos)==0)
                <div class="alert alert-danger" role="alert">
                    Sem fotos cadastradas!
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
                        <th>Título</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fotos as $foto)
                    <tr>
                        <td>{{$foto->id}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($foto->created_at))}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($foto->updated_at))}}</td>
                        <td width="120"><button type="button" data-toggle="modal" data-target="#exampleModalFoto{{$foto->id}}">@if($foto->foto!="")<img style="margin:0px; padding:0px;" src="/storage/{{$foto->foto}}" alt="foto_foto" width="50%">@endif</button></td>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalFoto{{$foto->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="/storage/{{$foto->foto}}" alt="foto_foto" style="width: 100%">
                            </div>
                            </div>
                        </div>
                        </div>
                        <td>{{$foto->titulo}}</td>
                        <td>@if($foto->ativo=='1') Sim @else Não @endif</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal{{$foto->id}}" data-toggle="tooltip" data-placement="left" title="Editar">
                                <i class="material-icons md-48">edit</i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$foto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Foto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card border">
                                            <div class="card-body">
                                                <form action="/outro/foto/editar/{{$foto->id}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg">
                                                        <br/>
                                                        <b style="font-size: 80%;">Resolução Ideal da Imagem 600 x 300</b><br/>
                                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                                        <br>
                                                        <label for="titulo">Título
                                                        <input type="text" class="form-control" name="titulo" id="titulo" value="{{$foto->titulo}}" required></label></label>
                                                        <br/>
                                                        <h5>Ativo?</h5>
                                                        <input type="radio" id="sim" name="ativo" value="1" @if($foto->ativo=="1") checked @endif required>
                                                        <label for="sim">Sim</label>
                                                        <input type="radio" id="nao" name="ativo" value="0" @if($foto->ativo=="0") checked @endif required>
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
                            <a href="/outro/foto/apagar/{{$foto->id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Excluir"><i class="material-icons md-48">delete</i></a>
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
<a href="/outro/principal" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection
