@extends('layouts.app_principal', ["current"=>"carrinho"])

@section('body')

<div class="container">

    <h3>Produtos no carrinho</h3>
    <div scope="row">
        @if (Session::has('mensagem-sucesso'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ Session::get('mensagem-sucesso') }}</strong>
            </div>
        @endif
        @if (Session::has('mensagem-falha'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ Session::get('mensagem-falha') }}</strong>
            </div>
        @endif
        @forelse ($pedidos as $pedido)
            <div>
                <h5 scope="col"> Pedido: {{ $pedido->id }} </h5>
                <h5 scope="col"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
            </div>
            <div class="table-responsive-xl">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Qtd</th>
                        <th>Produto</th>
                        <th>Valor Unit.</th>
                        <th>Desconto(s)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido->pedido_produtos as $pedido_produto)

                    <tr>
                        <td>
                            @if($pedido_produto->produto->foto!="")
                            <img width="100" height="100" src="/storage/{{ $pedido_produto->produto->foto }}">
                            @else
                            <i class="material-icons md-60">no_photography</i>
                            @endif
                        </td>
                        <td class="center-align" width="160">
                            <div class="center-align">
                                <a class="col l4 m4 s4" href="#" onclick="carrinhoRemoverProduto({{ $pedido->id }}, {{ $pedido_produto->produto_id }}, 1 )">
                                    <i class="material-icons small">remove_circle_outline</i>
                                </a>
                                <span class="col l4 m4 s4"> {{ $pedido_produto->qtd }} </span>
                                <a class="col l4 m4 s4" href="#" onclick="carrinhoAdicionarProduto({{ $pedido_produto->produto_id }})">
                                    <i class="material-icons small">add_circle_outline</i>
                                </a>
                            </div>
                            <a href="#" style="text-decoration:none;"onclick="carrinhoRemoverProduto({{ $pedido->id }}, {{ $pedido_produto->produto_id }}, 0)" data-toggle="tooltip" data-placement="top" title="Remover produto do carrinho?">Remover Produto</a>
                        </td>
                        <td> {{ $pedido_produto->produto->nome }} @if($pedido_produto->produto->turma!=0) {{$pedido_produto->produto->turma}}º ANO @else Todas Turmas @endif @if($pedido_produto->produto->ensino=='EFI') (Fund. 1) @else @if($pedido_produto->produto->ensino=='EFII') (Fund. 2) @else @if($pedido_produto->produto->ensino=='EM') (Médio) @else - Todos Ensinos @endif @endif @endif {{$pedido_produto->produto->marca}} {{$pedido_produto->produto->embalagem}}</td>
                        <td>R$ {{ number_format($pedido_produto->produto->preco, 2, ',', '.') }} <input type="hidden" name="preco" id="preco" value="{{$pedido_produto->produto->preco}}"></td>
                        <td>R$ {{ number_format($pedido_produto->descontos, 2, ',', '.') }}</td>
                        @php
                            $total_produto = $pedido_produto->valores - $pedido_produto->descontos;
                        @endphp
                        <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <div scope="row">
                <strong >Total do pedido: </strong>
                <span scope="col">R$ {{ number_format($pedido->total, 2, ',', '.') }}</span>
            </div>
            <br/>
            <div scope="row">
                <form method="POST" action="{{ route('carrinho.desconto') }}">
                    @csrf
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    <label>Cupom de Desconto: 
                    <input class="form-control" name="cupom" type="text" id="cupom" size="20" required/></label>
                    <br/>
                    <button type="submit" class="btn btn-primary">Validar Cupom</button>
                </form>
            </div>
            <br/>
            <div>
                <a type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Voltar a página inicial para continuar comprando?" href="{{ route('produtos') }}">Continuar comprando</a>
                <br/><br/>
                @if(count($clienteEnderecos)==0)
                <h5>Nenhum Endereço Cadastrado</h5>
                <a class="btn btn-primary" href="/enderecos">Cadastrar Endereço</a>
                @else
                <form method="POST" action="{{ route('carrinho.concluir') }}">
                    @csrf
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    <h5>Selecione um endereço para entrega:</h5>
                    @foreach ($clienteEnderecos as $end)
                    @if($end->endereco->ativo==true)
                    <div class="form-check">
                    <input type="radio" class="form-check-input" id="endereco{{$end->endereco->id}}" name="endereco" value="{{$end->endereco->id}}" required>
                    <label for="endereco{{$end->endereco->id}}">{{$end->endereco->rua}}, {{$end->endereco->numero}} ({{$end->endereco->complemento}}) - {{$end->endereco->bairro}} - {{$end->endereco->cidade}} - {{$end->endereco->uf}}</label>
                    </div>
                    @endif
                    @endforeach
                    <h5>Selecione a forma da entrega:</h5>
                    @foreach ($entregas as $ent)
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="entrega{{$ent->id}}" name="entrega" value="{{$ent->id}}" required>
                        <labelfor="entrega{{$ent->id}}">{{$ent->descricao}} - Valor: R$ {{ number_format($ent->valor, 2, ',', '.')}}</label>
                    </div>
                    @endforeach
                    <h5>Selecione a forma de pagamento:</h5>
                    <div class="form-check">
                    <select class="custom-select" id="selectPagamento" name="pagamento" required>
                    <option value="">Selecione uma forma de pagamento</option>
                    @foreach ($pagamentos as $pagamento)
                        <option value="{{$pagamento->id}}">{{$pagamento->descricao}}</option>
                    @endforeach
                    </select>
                    <select class="custom-select" id="selectTipoPagamento" name="tipoPagamento" required>
                        <option value="">Selecione o tipo de pagamento</option>
                        <option value="presencial">Presencial</option>
                        <option value="online">Online</option>
                    </select>
                    <div id="troco">
                        <div id="online">
                        </div>
                        <div id="presencial">
                            <input class="form-control" type="number" name="troco" id="troco" placeholder="Troco para quanto? Caso não precise, ignore este campo.">
                        </div>
                    </div>
                    <br/>
                    <textarea class="form-control" name="observacao" id="observacao" placeholder="Observação"></textarea>
                    <br/>
                    <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Adquirir os produtos concluindo a compra?">
                        Concluir compra
                    </button>
                </form>
                @endif
            </div>
        @empty
            <h5>Não há nenhum produto no carrinho</h5>
            <a type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Voltar a página inicial para continuar comprando?" href="{{ route('produtos') }}">Adicionar Produto</a>
        @endforelse
    </div>
</div>
<h5>Ajude-nos a manter contato, cadastre seus telefones 
    <a type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Cadastrar Novo Telefone" href="/telefones">Cadastrar Telefone</a>
</h5>
@if(isset($qtdProd))
{{var_dump($qtdProd)}}
@endif

<form id="form-remover-produto" method="POST" action="{{ route('carrinho.remover') }}">
    @csrf
    {{ method_field('DELETE') }}
    <input type="hidden" name="pedido_id">
    <input type="hidden" name="produto_id">
    <input type="hidden" name="item">
</form>
<form id="form-adicionar-produto" method="POST" action="{{ route('carrinho.adicionar') }}">
    @csrf
    <input type="hidden" name="id">
</form>

@endsection