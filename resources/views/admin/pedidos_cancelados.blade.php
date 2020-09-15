@extends('layouts.app_logado', ["current"=>"pedidos"])

@section('body')

<div class="container">
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
        <hr/>
        <div>
            <h4 style="color: red;">Compras Canceladas</h4>
            <hr/>
            <div class="table-responsive-xl">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Cliente</th>
                            <th>Criação</th>
                            <th>Cancelamento</th>
                            <th>Valor</th>
                            <th>Desconto</th>
                            <th>Total</th>
                         </tr>
                    </thead>
                    <tbody>
                    @forelse ($cancelados as $pedido)
                        <tr>
                            <td>{{ $pedido->id }} <br/>
                            @php
                            $total_produto = 0;
                            $total_valor = 0;
                            $total_desconto = 0;
                            $total_pedido = 0;
                            @endphp
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $pedido->id }}">
                            Detalhes
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $pedido->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Itens do Pedido Nº {{$pedido->id}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Preço</th>
                                                <th scope="col">Quantidade</th>
                                                <th scope="col">Desconto</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pedido->pedido_produtos_itens as $pedido_produto)
                                                @php
                                                $total_produto = 0;
                                                if($pedido_produto->status == 'CANCEL'){
                                                    $total_produto += $pedido_produto->valor - $pedido_produto->desconto;
                                                    $total_valor += $pedido_produto->valor;
                                                    $total_desconto += $pedido_produto->desconto;
                                                    $total_pedido += $total_produto;
                                                }
                                                @endphp
                                                <tr style="color:red;">
                                                    <td>{{ $pedido_produto->produto->nome }} @if($pedido_produto->produto->turma!=0) {{$pedido_produto->produto->turma}}º ANO @else Todas Turmas @endif @if($pedido_produto->produto->ensino=='EFI') (Fund. 1) @else @if($pedido_produto->produto->ensino=='EFII') (Fund. 2) @else @if($pedido_produto->produto->ensino=='EM') (Médio) @else - Todos Ensinos @endif @endif @endif {{$pedido_produto->produto->marca}} {{$pedido_produto->produto->embalagem}}</td>
                                                    <td>R$ {{ number_format($pedido_produto->produto->preco, 2, ',', '.') }}</td>
                                                    @if($pedido_produto->produto->granel=="1")
                                                    <td>{{number_format($pedido_produto->qtdGranel, 1, ',', '.')}} KG</td>
                                                    @else
                                                    <td>1</td>
                                                    @endif
                                                    <td>R$ {{ number_format($pedido_produto->desconto, 2, ',', '.') }}</td>
                                                    <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                                                <tr/>
                                            @endforeach
                                            <tr>
                                                <td colspan="1">Entrega:</td>
                                                <td colspan="4"><b>{{$pedido->endereco->rua}}, {{$pedido->endereco->numero}}@if($pedido->endereco->complemento!="") ({{$pedido->endereco->complemento}}) @else @endif- {{$pedido->endereco->bairro}} - {{$pedido->endereco->cidade}} - {{$pedido->endereco->uf}} ({{$pedido->entrega->descricao}} - Valor: R$ {{ number_format($pedido->entrega->valor, 2, ',', '.')}})</b>
                                                    @if($pedido->observacao!="")
                                                    <br/>
                                                    Observação: {{$pedido->observacao}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">Pagamento:</td>
                                                <td colspan="4"><b>{{$pedido->forma_pagamento->descricao}} - @if($pedido->tipoPagamento=="presencial") Presencial @else Online @endif
                                                    @if($pedido->troco!="")
                                                    - Troco: R$ {{ number_format($pedido->troco, 2, ',', '.') }}
                                                    @endif </b>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                            </div>
                            </td>
                            <td>{{ $pedido->user->name }}</td>
                            <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $pedido->updated_at->format('d/m/Y H:i') }}</td>
                            <td>R$ {{ number_format($total_valor, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($total_desconto, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($total_pedido, 2, ',', '.') }}</td>
                        </tr>
                @empty
                    <tr>
                        <td colspan="7"><h5 class="center">Nenhuma compra foi cancelada.</h5></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        </div>
        <hr/>
    </div>
    <div class="card-footer">
        {{ $cancelados->links() }}
    </div>
</div>
<a href="/admin/pedidos" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection