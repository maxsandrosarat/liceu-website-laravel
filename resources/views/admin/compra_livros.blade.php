@extends('layouts.app_logado', ["current"=>"recibos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Recibos</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Adicionar Novo Recibo">
                <i class="material-icons blue md-60">add_circle</i>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Recibo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="card border">
                            <div class="card-body">
                                <form action="/admin/compraLivro" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nomeAluno">Nome do Aluno</label>
                                        <input type="text" class="form-control" name="nomeAluno" id="nomeAluno" placeholder="Nome Completo" required>
                                        <label for="serie">Série</label>
                                        <select class="custom-select" id="serie" name="serie" required>
                                            <option value="">Selecione uma série</option>
                                            <option value="1">1º ANO</option>
                                            <option value="2">2º ANO</option>
                                            <option value="3">3º ANO</option>
                                            <option value="4">4º ANO</option>
                                            <option value="5">5º ANO</option>
                                            <option value="6">6º ANO</option>
                                            <option value="7">7º ANO</option>
                                            <option value="8">8º ANO</option>
                                            <option value="9">9º ANO</option>
                                        </select>
                                        <br/>
                                        <label for="turma">Turma</label>
                                        <input type="text" class="form-control" name="turma" id="turma" placeholder="Exemplo: A" required>
                                        <label for="ensino">Ensino</label>
                                        <select class="custom-select" id="ensino" name="ensino" required>
                                            <option value="">Selecione o ensino</option>
                                            <option value="EFI">Ensino Fundamental I</option>
                                            <option value="EFII">Ensino Fundamental II</option>
                                            <option value="EM">Ensino Médio</option>
                                            <option value="TODOS">Todos Ensinos</option>
                                        </select>
                                        <br/><br/>
                                        <input type="text" class="form-control" name="nomeResp" id="nomeResp" placeholder="Nome do Responsável" required>
                                        <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF do Responsável" required>
                                        <label for="valor">Valor: R$
                                        <input type="text" class="form-control" name="valor" id="valor" onblur="getValor('valor');" required></label>
                                        
                                        <select class="custom-select" name="tipoPagamento" id="tipoPagamento" required>
                                            <option value="">Selecione a Forma de Pagamento</option>
                                            <option value="definido">PRÉ-DEFINIDO</option>
                                            <option value="manual">MANUAL</option>
                                        </select>
                            
                                        <div id="principal">
                            
                                                <div class="card" id="definido">
                                                    <div class="card-header">FORMA DE PAGAMENTO PRÉ-DEFINIDO</div>
                                                    <div class="card-body">
                                                        <select class="custom-select" id="formaPagamentoDef" name="formaPagamentoDef" required>
                                                            <option value="">Selecione a forma de pagamento</option>
                                                            <option value="Dinheiro">Dinheiro</option>
                                                            <option value="Cartão Débito">Cartão Débito</option>
                                                            <option value="Cartão Crédito (à Vista)">Cartão Crédito (à Vista)</option>
                                                            <option value="Cartão Crédito (2x)">Cartão Crédito (2x)</option>
                                                            <option value="Cartão Crédito (3x)">Cartão Crédito (3x)</option>
                                                            <option value="Cartão Crédito (4x)">Cartão Crédito (4x)</option>
                                                            <option value="Cartão Crédito (5x)">Cartão Crédito (5x)</option>
                                                            <option value="Cartão Crédito (6x)">Cartão Crédito (6x)</option>
                                                        </select>
                                                    </div>
                                                </div>
                            
                                                <div class="card" id="manual">
                                                    <div class="card-header">FORMA DE PAGAMENTO MANUAL (DIGITADO)</div>
                                                    <div class="card-body">
                                                        <input type="text" class="form-control" name="formaPagamentoMan" id="formaPagamentoMan" placeholder="Digite a forma de Pagamento" required>
                                                    </div>
                                                </div>
                                        </div>
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
            @if(count($recibos)==0)
                <div class="alert alert-dark" role="alert">
                    @if($view=="inicial")
                    Sem recibos cadastrados!! Faça novo cadastro no botão    <a type="button" href="#"><i class="material-icons blue">add_circle</i></a>   no canto inferior direito.
                    @endif
                    @if($view=="filtro")
                    Sem resultados da busca!
                    <a href="/admin/compraLivro" class="btn btn-success">Voltar</a>
                    @endif
                </div>
            @else
            <div class="card border">
                <h5>Filtros: </h5>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/admin/compraLivro/filtro">
                    @csrf
                    <input class="form-control mr-sm-2" type="text" placeholder="Nome do Aluno" name="nome">
                    <select class="custom-select" id="serie" name="serie">
                        <option value="">Selecione uma série</option>
                        @foreach ($series as $serie)
                            <option value="{{$serie->serie}}">{{$serie->serie}}º ANO</option>
                        @endforeach
                    </select>
                    <select class="custom-select" id="turma" name="turma">
                        <option value="">Selecione uma turma</option>
                        @foreach ($turmas as $turma)
                            <option value="{{$turma->turma}}">{{$turma->turma}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
                </form>
            </div>
            <hr/>
            <div class="card border">
                <h5>Relatório por Turma: </h5>
                <form class="form-inline my-2 my-lg-0" method="POST" action="/admin/compraLivro/relatorio">
                    @csrf
                    <select class="custom-select" id="serie" name="serie">
                        <option value="">Selecione uma série</option>
                        @foreach ($series as $serie)
                            <option value="{{$serie->serie}}">{{$serie->serie}}º ANO</option>
                        @endforeach
                    </select>
                    <select class="custom-select" id="turma" name="turma">
                        <option value="">Selecione uma turma</option>
                        @foreach ($turmas as $turma)
                            <option value="{{$turma->turma}}">{{$turma->turma}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" target="_blank">Gerar</button>
                </form>
            </div>
            <br/>
            <h5>Exibindo {{$recibos->count()}} de {{$recibos->total()}} de Recibos ({{$recibos->firstItem()}} a {{$recibos->lastItem()}})</h5>
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Aluno/Série/Turma/Ensino</th>
                        <th>Responsável/CPF</th>
                        <th>Valor</th>
                        <th>Forma Pagamento</th>
                        <th>Usuário</th>
                        <th>Criação</th>
                        <th>Última Atualização</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recibos as $recibo)
                    <tr>
                        <td>{{$recibo->id}}</td>
                        <td>{{$recibo->nomeAluno}} @if($recibo->serie!=0) {{$recibo->serie}}º ANO {{$recibo->turma}} @else Todas Turmas @endif @if($recibo->ensino=='EFI') (Fund. 1) @else @if($recibo->ensino=='EFII') (Fund. 2) @else @if($recibo->ensino=='EM') (Médio) @else (Todos Ensinos) @endif @endif @endif</td>
                        <td>{{$recibo->nomeResp}} ({{$recibo->cpf}})</td>
                        <td>{{ 'R$ '.number_format($recibo->valor, 2, ',', '.')}}</td>
                        <td>{{$recibo->formaPagamento}}</td>
                        <td>{{$recibo->user}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($recibo->created_at))}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($recibo->updated_at))}}</td>
                        <td>
                            <button type="button" class="badge badge-warning" data-toggle="modal" data-target="#exampleModal{{$recibo->id}}" data-toggle="tooltip" data-placement="left" title="Editar">
                                <i class="material-icons md-18">edit</i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$recibo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Recibo - Nº {{$recibo->id}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card border">
                                            <div class="card-body">
                                                <form action="/admin/compraLivro/editar/{{$recibo->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="nomeAluno">Nome do Aluno</label>
                                                        <input type="text" class="form-control" name="nomeAluno" id="nomeAluno" value="{{$recibo->nomeAluno}}" required>
                                                        <label for="serie">Série</label>
                                                        <select class="custom-select" id="serie" name="serie" required>
                                                            <option value="{{$recibo->serie}}">{{$recibo->serie}}º ANO</option>
                                                            <option value="1">1º ANO</option>
                                                            <option value="2">2º ANO</option>
                                                            <option value="3">3º ANO</option>
                                                            <option value="4">4º ANO</option>
                                                            <option value="5">5º ANO</option>
                                                            <option value="6">6º ANO</option>
                                                            <option value="7">7º ANO</option>
                                                            <option value="8">8º ANO</option>
                                                            <option value="9">9º ANO</option>
                                                        </select>
                                                        <br/>
                                                        <label for="turma">Turma</label>
                                                        <input type="text" class="form-control" name="turma" id="turma" value="{{$recibo->turma}}" required>
                                                        <label for="ensino">Ensino</label>
                                                        <select class="custom-select" id="ensino" name="ensino" required>
                                                            <option value="{{$recibo->ensino}}">{{$recibo->ensino}}</option>
                                                            <option value="EFI">Ensino Fundamental I</option>
                                                            <option value="EFII">Ensino Fundamental II</option>
                                                            <option value="EM">Ensino Médio</option>
                                                            <option value="TODOS">Todos Ensinos</option>
                                                        </select>
                                                        <br/>
                                                        <label for="nomeResp">Nome do Responsável</label>
                                                        <input type="text" class="form-control" name="nomeResp" id="nomeResp" value="{{$recibo->nomeResp}}" required>
                                                        <br/>
                                                        <label for="cpf">CPF do Responsável</label>
                                                        <input type="text" class="form-control" name="cpf" id="cpf" value="{{$recibo->cpf}}" required>
                                                        <label for="valor">Valor</label>
                                                        <input type="text" class="form-control" name="valor" id="valorE" value="{{$recibo->valor}}" onblur="getValor('valorE');" required>
                                                        <label for="formaPagamento">Forma de Pagamento</label>
                                                        <select class="custom-select" id="formaPagamento" name="formaPagamento" required>
                                                            <option value="{{$recibo->formaPagamento}}">{{$recibo->formaPagamento}}</option>
                                                            <option value="Dinheiro">Dinheiro</option>
                                                            <option value="Cartão Débito">Cartão Débito</option>
                                                            <option value="Cartão Crédito (à Vista)">Cartão Crédito (à Vista)</option>
                                                            <option value="Cartão Crédito (2x)">Cartão Crédito (2x)</option>
                                                            <option value="Cartão Crédito (2x)">Cartão Crédito (3x)</option>
                                                            <option value="Cartão Crédito (2x)">Cartão Crédito (4x)</option>
                                                            <option value="Cartão Crédito (2x)">Cartão Crédito (5x)</option>
                                                            <option value="Cartão Crédito (2x)">Cartão Crédito (6x)</option>
                                                        </select>
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
                            <a href="/admin/compraLivro/apagar/{{$recibo->id}}" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Inativar"><i class="material-icons md-18">delete</i></a>
                            <a target="_blank" href="/admin/compraLivro/pdf/{{$recibo->id}}" class="badge badge-success">Gerar Recibo</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>
        <div class="card-footer">
            {{ $recibos->links() }}
        </div>
    </div>
    <br>
    <a href="/admin/recibos" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection
