@extends('layouts.app_logado', ["current"=>"principal"])

@section('body')
<div class="subpage">
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Banners</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Criar Novo Banner">
                <i class="material-icons blue md-60">add_circle</i>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border">
                            <div class="card-body">
                                <form action="/admin/banner" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,.jpeg">
                                        <br/>
                                        <b style="font-size: 80%;">Resolução Ideal da Imagem 1440 x 960</b><br/>
                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                        <br/><br/>
                                        @php
                                            $qtd = count($banners);
                                        @endphp
                                        <label for="ordem">Ordem
                                        <select class="custom-select" id="ordem" name="ordem">
                                            <option value="">Selecione o tempo</option>
                                            @for($i=1; $i<=$qtd+1; $i++)
                                            <option value="{{$i}}">{{$i}}º</option>
                                            @endfor
                                        </select></label>
                                        <br/>
                                        <label for="titulo">Titulo</label>
                                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Exemplo: Educação" required>
                                        <br/>
                                        <h5>Descrição</h5>
                                        <textarea class="form-control" name="descricao" id="descricao" rows="5" cols="20" maxlength="240" placeholder="Escreva aqui a descrição"></textarea>
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
            @if(count($banners)==0)
                <div class="alert alert-danger" role="alert">
                    Sem banners cadastrados!
                </div>
            @else
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Ordem</th>
                        <th>Criação</th>
                        <th>Última Atualização</th>
                        <th>Foto</th>
                        <th>Título</th>
                        <th>Descricao</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                    <tr>
                        <td>{{$banner->id}}</td>
                        <td>{{$banner->ordem}}º</td>
                        <td>{{date("d/m/Y H:i", strtotime($banner->created_at))}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($banner->updated_at))}}</td>
                        <td width="120"><button type="button" data-toggle="modal" data-target="#exampleModalFoto{{$banner->id}}">@if($banner->foto!="")<img style="margin:0px; padding:0px;" src="/storage/{{$banner->foto}}" alt="foto_banner" width="50%">@endif</button></td>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalFoto{{$banner->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="/storage/{{$banner->foto}}" alt="foto_banner" style="width: 100%">
                            </div>
                            </div>
                        </div>
                        </div>
                        <td>{{$banner->titulo}}</td>
                        <td><button type="button" class="badge badge-primary" data-toggle="modal" data-target="#exampleModalDesc{{$banner->id}}">Descrição</button></td>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalDesc{{$banner->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{$banner->descricao}}
                            </div>
                            </div>
                        </div>
                        </div>
                        <td>@if($banner->ativo=='1') Sim @else Não @endif</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal{{$banner->id}}" data-toggle="tooltip" data-placement="left" title="Editar">
                                <i class="material-icons md-48">edit</i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$banner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Banner</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card border">
                                            <div class="card-body">
                                                <form action="/admin/banner/editar/{{$banner->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,.jpeg">
                                                        <br/>
                                                        <b style="font-size: 80%;">Resolução Ideal da Imagem 1440 x 960</b><br/>
                                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                                        <br>
                                                        @php
                                                            $qtd = count($banners);
                                                        @endphp
                                                        <label for="ordem">Ordem
                                                        <select class="custom-select" id="ordem" name="ordem">
                                                            <option value="{{$banner->ordem}}">{{$banner->ordem}}º</option>
                                                            @for($i=1; $i<=$qtd; $i++)
                                                            @if($banner->ordem===$i)
                                                            @else
                                                            <option value="{{$i}}">{{$i}}º</option>
                                                            @endif
                                                            @endfor
                                                        </select></label>
                                                        <br/>
                                                        <label for="titulo">Título
                                                        <input type="text" class="form-control" name="titulo" id="titulo" value="{{$banner->titulo}}" required></label></label>
                                                        <br/>
                                                        <h5>Descrição</h5>
                                                        <textarea class="form-control" name="descricao" id="descricao" rows="5" cols="20" maxlength="240">{{$banner->descricao}}</textarea>
                                                        <br/>
                                                        <h5>Ativo?</h5>
                                                        <input type="radio" id="sim" name="ativo" value="1" @if($banner->ativo=="1") checked @endif required>
                                                        <label for="sim">Sim</label>
                                                        <input type="radio" id="nao" name="ativo" value="0" @if($banner->ativo=="0") checked @endif required>
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
                            <a href="/admin/banner/apagar/{{$banner->id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Excluir"><i class="material-icons md-48">delete</i></a>
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
