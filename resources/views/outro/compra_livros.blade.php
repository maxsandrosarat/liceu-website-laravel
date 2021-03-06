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
                                <form action="/outro/compraLivro" method="POST">
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
                                        <select class="custom-select" id="formaPagamento" name="formaPagamento" required>
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
                    <a href="/outro/compraLivro" class="btn btn-success">Voltar</a>
                    @endif
                </div>
            @else
            <div class="card border">
                <h5>Filtros: </h5>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/outro/compraLivro/filtro">
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
            <br/>
            <h5>Exibindo {{$recibos->count()}} de {{$recibos->total()}} de Recibos ({{$recibos->firstItem()}} a {{$recibos->lastItem()}})</h5>
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Aluno/Turma/Ensino</th>
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
                            <a target="_blank" href="/outro/compraLivro/pdf/{{$recibo->id}}" class="badge badge-success">Gerar Recibo</a>
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
    <a href="/outro/recibos" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection
