@extends('layouts.app_principal', ["current"=>"compras"])

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
            @forelse ($cancelados as $pedido)
            <hr/>
            <div class="card border">
                <div class="card-body">
                <h5 scope="col"> Pedido: {{ $pedido->id }} </h5>
                <h5 scope="col"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
                <h5 scope="col" style="color: red;"> Cancelado em: {{ $pedido->updated_at->format('d/m/Y H:i') }} </h5>
                <div class="table-responsive-xl">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Desconto</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_pedido = 0;
                        @endphp
                        @foreach ($pedido->pedido_produtos_itens as $pedido_produto)
                            @php
                                $total_produto = $pedido_produto->valor - $pedido_produto->desconto;
                                $total_pedido += $total_produto;
                            @endphp
                        <tr>
                            <td>
                                @if($pedido_produto->produto->foto!="")
                                <img width="100" height="100" src="/storage/{{ $pedido_produto->produto->foto }}">
                                @else
                                <i class="material-icons md-60">no_photography</i>
                                @endif
                            </td>
                            <td>{{ $pedido_produto->produto->nome }} @if($pedido_produto->produto->turma!=0) {{$pedido_produto->produto->turma}}º ANO @else Todas Turmas @endif @if($pedido_produto->produto->ensino=='EFI') (Fund. 1) @else @if($pedido_produto->produto->ensino=='EFII') (Fund. 2) @else @if($pedido_produto->produto->ensino=='EM') (Médio) @else - Todos Ensinos @endif @endif @endif {{$pedido_produto->produto->marca}} {{$pedido_produto->produto->embalagem}}</td>
                            <td>R$ {{ number_format($pedido_produto->valor, 2, ',', '.') }}</td>
                            @if($pedido_produto->produto->granel=="1")
                            <td>{{number_format($pedido_produto->qtdGranel, 1, ',', '.')}} KG</td>
                             @else
                            <td>1</td>
                            @endif
                            <td>R$ {{ number_format($pedido_produto->desconto, 2, ',', '.') }}</td>
                            
                            <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td><strong>Total do pedido</strong></td>
                            <td>R$ {{ number_format($total_pedido, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Entrega:</td>
                            <td colspan="5"><b>{{$pedido->endereco->rua}}, {{$pedido->endereco->numero}}@if($pedido->endereco->complemento!="") ({{$pedido->endereco->complemento}}) @else @endif- {{$pedido->endereco->bairro}} - {{$pedido->endereco->cidade}} - {{$pedido->endereco->uf}} ({{$pedido->entrega->descricao}} - Valor: R$ {{ number_format($pedido->entrega->valor, 2, ',', '.')}})</b>
                                @if($pedido->observacao!="")
                                <br/>
                                Observação: {{$pedido->observacao}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Pagamento:</td>
                            <td colspan="5"><b>{{$pedido->forma_pagamento->descricao}} - @if($pedido->tipoPagamento=="presencial") Presencial @else Online @endif
                                @if($pedido->troco!="")
                                - Troco: R$ {{ number_format($pedido->troco, 2, ',', '.') }}
                                @endif </b>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
            </div>
            @empty
                <h5 class="center">Você não cancelou nenhuma compra.</h5>
            @endforelse
        </div>
        <hr/>
    </div>

</div>

@endsection