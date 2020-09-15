@extends('layouts.app_logado', ["current"=>"cadastros"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Lista de Produtos</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Adicionar Novo Produto">
                <i class="material-icons blue md-60">add_circle</i>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border">
                            <div class="card-body">
                                <form action="/admin/produtos" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg">
                                        <br/>
                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                        <br/><br/>
                                        <label for="nome">Nome do Produto</label>
                                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Exemplo: Livros" required>
                                        <br/>
                                        <label for="turma">Turma</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="turma" id="turma" placeholder="Exemplo: 1 (para todas turmas use 0)" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                              <span class="input-group-text" id="basic-addon2">º ANO</span>
                                            </div>
                                          </div>
                                        <br/>
                                        <label for="ensino">Ensino</label>
                                        <select class="custom-select" id="ensino" name="ensino" required>
                                            <option value="">Selecione o tipo de ensino</option>
                                            <option value="EFI">Ensino Fundamental I</option>
                                            <option value="EFII">Ensino Fundamental II</option>
                                            <option value="EM">Ensino Médio</option>
                                            <option value="TODOS">Todos Ensinos</option>
                                        </select>
                                        <br/><br/>
                                        <label for="marca">Marca</label>
                                        <input type="text" class="form-control" name="marca" id="marca" placeholder="Exemplo: Conexia">
                                        <br/>
                                        <label for="embalagem">Embalagem do Produto</label>
                                        <input type="text" class="form-control" name="embalagem" id="embalagem" placeholder="Exemplo: 5 Unidades">
                                        <br/>
                                        <label for="preco">Preço do Produto</label>
                                        <input type="text" class="form-control" name="preco" id="preco" placeholder="Exemplo: 199.99" required>
                                        <br/>
                                        <label for="estoque">Estoque do Produto</label>
                                        <input type="number" class="form-control" name="estoque" id="estoque" placeholder="Exemplo: 100" required>
                                        <br/>
                                        <label for="categoria">Categoria</label>
                                        <select class="custom-select" id="categoria" name="categoria" required>
                                            <option value="">Selecione</option>
                                            @foreach ($cats as $cat)
                                                <option value="{{$cat->id}}">{{$cat->nome}}</option>
                                            @endforeach
                                        </select>
                                        <br/>
                                        <h5>Descrição</h5>
                                        <textarea class="form-control" name="descricao" id="descricao" rows="10" cols="40" maxlength="500" placeholder="Escreva aqui a descrição completa do produto"></textarea>
                                        <br/><br/>
                                        <h5>Ativo?</h5>
                                        <input type="radio" id="sim" name="ativo" value="1" required>
                                        <label for="sim">Sim</label>
                                        <input type="radio" id="nao" name="ativo" value="0" required>
                                        <label for="nao">Não</label>
                                        <h5>Promoção?</h5>
                                        <input type="radio" id="sim" name="promocao" value="1" required>
                                        <label for="sim">Sim</label>
                                        <input type="radio" id="nao" name="promocao" value="0" required>
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
            @if(count($prods)==0)
                <div class="alert alert-danger" role="alert">
                    Sem produtos cadastrados!
                </div>
            @else
            <div class="card border">
                <h5>Filtros: </h5>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/admin/produtos/filtro">
                    @csrf
                    <input class="form-control mr-sm-2" type="text" placeholder="Nome do Produto" name="nome">
                    <select class="custom-select" id="categoria" name="categoria">
                        <option value="">Categoria</option>
                        @foreach ($cats as $cat)
                            <option value="{{$cat->id}}">{{$cat->nome}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
                </form>
                </div>
                <br/>
            <h5>Exibindo {{$prods->count()}} de {{$prods->total()}} de Produtos ({{$prods->firstItem()}} a {{$prods->lastItem()}})</h5>
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Foto</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Categoria</th>
                        <th>Ativo</th>
                        <th>Promoção</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prods as $prod)
                    <tr>
                        <td>{{$prod->id}}</td>
                        <td width="100"><button type="button" data-toggle="modal" data-target="#exampleModalFoto{{$prod->id}}">@if($prod->foto!="")<img style="margin:0px; padding:0px;" src="/storage/{{$prod->foto}}" alt="foto_produto" width="50%">@else <i class="material-icons md-48">no_photography</i> @endif</button></td>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalFoto{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if($prod->foto!="")<img src="/storage/{{$prod->foto}}" alt="foto_produto" width="100%">@else <i class="material-icons md-60">no_photography</i> @endif
                            </div>
                            </div>
                        </div>
                        </div>
                        <td>{{$prod->nome}} @if($prod->turma!=0) {{$prod->turma}}º ANO @else Todas Turmas @endif @if($prod->ensino=='EFI') (Fund. 1) @else @if($prod->ensino=='EFII') (Fund. 2) @else @if($prod->ensino=='EM') (Médio) @else (Todos Ensinos) @endif @endif @endif{{$prod->marca}} {{$prod->embalagem}}</td>
                        <td width="78-">{{ 'R$ '.number_format($prod->preco, 2, ',', '.')}}</td>
                        <td>{{$prod->estoque}}</td>
                        <td>{{$prod->categoria->nome}}</td>
                        <td>@if($prod->ativo=='1') Sim @else Não @endif</td>
                        <td>@if($prod->promocao=='1') Sim @else Não @endif</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal{{$prod->id}}" data-toggle="tooltip" data-placement="left" title="Editar">
                                <i class="material-icons md-48">edit</i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card border">
                                            <div class="card-body">
                                                <form action="/admin/produtos/editar/{{$prod->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <input type="file" id="foto" name="foto" accept=".jpg,.png,jpeg">
                                                        <br/>
                                                        <b style="font-size: 80%;">Aceito apenas Imagens JPG e PNG (".jpg" e ".png")</b>
                                                        <label for="nome">Nome do Produto</label>
                                                        <input type="text" class="form-control" name="nome" id="nome" value="{{$prod->nome}}" required>
                                                        <br/>
                                                        <label for="turma">Turma</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" name="turma" id="turma" value="{{$prod->turma}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                                <div class="input-group-append">
                                                                  <span class="input-group-text" id="basic-addon2">º ANO</span>
                                                                </div>
                                                            </div>
                                                        <br/><br/>
                                                        <label for="ensino">Ensino</label>
                                                        <select class="custom-select" id="ensino" name="ensino" required>
                                                            <option value="{{$prod->ensino}}">@if($prod->ensino=='EFI') Ensino Fundamental I @else @if($prod->ensino=='EFII') Ensino Fundamental II @else @if($prod->ensino=='EM') Ensino Médio @else Todos Ensinos @endif @endif @endif</option>
                                                            @if($prod->ensino=='EFI')
                                                                <option value="EFII">Ensino Fundamental II</option>
                                                                <option value="EM">Ensino Médio</option>
                                                                <option value="TODOS">Todos Ensinos</option>
                                                            @else
                                                                @if($prod->ensino=='EFII')
                                                                <option value="EFI">Ensino Fundamental I</option>
                                                                <option value="EM">Ensino Médio</option>
                                                                <option value="TODOS">Todos Ensinos</option>
                                                                @else
                                                                    @if($prod->ensino=='EM')
                                                                    <option value="EFI">Ensino Fundamental I</option>
                                                                    <option value="EFII">Ensino Fundamental II</option>
                                                                    <option value="TODOS">Todos Ensinos</option>
                                                                    @else
                                                                        <option value="EFI">Ensino Fundamental I</option>
                                                                        <option value="EFII">Ensino Fundamental II</option>
                                                                        <option value="EM">Ensino Médio</option>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </select>
                                                        <br/><br/>
                                                        <label for="marca">Marca</label>
                                                        <input type="text" class="form-control" name="marca" id="marca" value="{{$prod->marca}}">
                                                        <br/><br/>
                                                        <label for="embalagem">Embalagem do Produto</label>
                                                        <input type="text" class="form-control" name="embalagem" id="embalagem" value="{{$prod->embalagem}}">
                                                        <br/>
                                                        <label for="preco">Preço do Produto</label>
                                                        <input type="text" class="form-control" name="preco" id="preco" value="{{$prod->preco}}" required>
                                                        <br/>
                                                        <!--<label for="estoque">Estoque do Produto</label>
                                                        <input type="number" class="form-control" name="estoque" id="estoque" value="{{$prod->estoque}}" required>
                                                        <br><br/>-->
                                                        <label for="categoria">Categoria</label>
                                                        <select  class="custom-select" id="categoria" name="categoria" required>
                                                            <option value="{{$prod->categoria->id}}">{{$prod->categoria->nome}}</option>
                                                            @foreach ($cats as $cat)
                                                                @if($cat->id==$prod->categoria->id)
                                                                @else
                                                                <option value="{{$cat->id}}">{{$cat->nome}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <br/>
                                                        <h5>Descrição</h5>
                                                        <textarea class="form-control" name="descricao" id="descricao" rows="20" cols="100" maxlength="1000">{{$prod->descricao}}</textarea>
                                                        <br/>
                                                        <h5>Ativo?</h5>
                                                        <input type="radio" id="sim" name="ativo" value="1" @if($prod->ativo=="1") checked @endif required>
                                                        <label for="sim">Sim</label>
                                                        <input type="radio" id="nao" name="ativo" value="0" @if($prod->ativo=="0") checked @endif required>
                                                        <label for="nao">Não</label>
                                                        <h5>Promoção?</h5>
                                                        <input type="radio" id="sim" name="promocao" value="1" @if($prod->promocao=="1") checked @endif required>
                                                        <label for="sim">Sim</label>
                                                        <input type="radio" id="nao" name="promocao" value="0" @if($prod->promocao=="0") checked @endif required>
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
                            <a href="/admin/produtos/apagar/{{$prod->id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Inativar"><i class="material-icons md-48">delete</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>
        <div class="card-footer">
            {{ $prods->links() }}
        </div>
    </div>
    <br>
    <a href="/admin/cadastros" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection
