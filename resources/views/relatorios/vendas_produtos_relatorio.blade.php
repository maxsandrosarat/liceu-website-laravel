@extends('layouts.app_logado', ["current"=>"relatorios"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Relatório de Vendas por Produtos</h5>
            @if(count($rels)==0)
                    <div class="alert alert-dark" role="alert">
                        @if($view=="inicial")
                        Sem movimentos cadastrados!
                        @else @if($view=="filtro")
                        Sem resultados da busca!
                        <a href="/admin/relatorios/vendas/produtos" class="btn btn-success">Voltar</a>
                        @endif
                        @endif
                    </div>
            @else
            <div class="card border">
            <h5>Filtros: </h5>
            <form class="form-inline my-2 my-lg-0" method="GET" action="/admin/relatorios/vendas/produtos/filtro">
                @csrf
                <select class="custom-select" id="status" name="status">
                    <option value="">Selecione o status</option>
                    <option value="RESERV" style="color:orange; font-weight: bold;">Reservado</option>
                    <option value="FEITO" style="color:blue; font-weight: bold;">Feito</option>
                    <option value="PAGO"style="color:green; font-weight: bold;">Pago</option>
                    <option value="CANCEL" style="color:red; font-weight: bold;">Cancelado</option>
                </select>
                <select class="custom-select" id="produtos" name="produto">
                    <option value="">Selecione um produto</option>
                    @foreach ($prods as $prod)
                    <option value="{{$prod->id}}">{{$prod->nome}} @if($prod->turma!=0) {{$prod->turma}}º ANO @else Todas Turmas @endif @if($prod->ensino=='EFI') (Fund. 1) @else @if($prod->ensino=='EFII') (Fund. 2) @else @if($prod->ensino=='EM') (Médio) @else - Todos Ensinos @endif @endif @endif {{$prod->marca}} {{$prod->embalagem}}</option>
                    @endforeach
                </select>
                <label for="dataInicio">Data Início
                <input class="form-control mr-sm-2" type="date" name="dataInicio"></label>
                <label for="dataFim">Data Fim
                <input class="form-control mr-sm-2" type="date" name="dataFim"></label>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
            </form>
            </div>
            <br/>
            <div class="table-responsive-xl">
            <table id="yesprint" class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Pedido</th>
                        <th>Nome Produto</th>
                        <th>Status</th>
                        <th>Granel</th>
                        <th>Valor Produto</th>
                        <th>Desconto</th>
                        <th>Cupom</th>
                        <th>Data & Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rels as $rel)
                    <tr>
                        <td>{{$rel->id}}</td>
                        <td>{{$rel->pedido_id}}</td>
                        <td>{{$rel->produto->nome}} @if($rel->produto->turma!=0) {{$rel->produto->turma}}º ANO @else Todas Turmas @endif @if($rel->produto->ensino=='EFI') (Fund. 1) @else @if($rel->produto->ensino=='EFII') (Fund. 2) @else @if($rel->produto->ensino=='EM') (Médio) @else - Todos Ensinos @endif @endif @endif {{$rel->produto->marca}} {{$rel->produto->embalagem}}</td>
                        <td @if($rel->status=='RESERV') style="color:orange; font-weight: bold;" @else @if($rel->status=='FEITO') style="color:blue; font-weight: bold;" @else @if($rel->status=='PAGO') style="color:green; font-weight: bold;" @else style="color:red; font-weight: bold;" @endif @endif @endif>@if($rel->status=='RESERV') Reservado @else @if($rel->status=='FEITO') Feito @else @if($rel->status=='PAGO') Pago @else Cancelado @endif @endif @endif</td>
                        <td>{{$rel->qtdGranel}}</td>
                        <td>{{ 'R$ '.number_format($rel->valor, 2, ',', '.')}}</td>
                        <td>{{ 'R$ '.number_format($rel->desconto, 2, ',', '.')}}</td>
                        <td>@if($rel->cupom_desconto_id!="") {{$rel->cupom_desconto->localizador}} @endif</td>
                        <td>{{date("d/m/Y H:i", strtotime($rel->created_at))}}</td>
                    </tr>
                    @endforeach
                    @if($view=="filtro")
                    <tr>
                        <td colspan="5">TOTAIS</td>
                        <td>{{ 'R$ '.number_format($total_valor, 2, ',', '.')}}</td>
                        <td>{{ 'R$ '.number_format($total_desconto, 2, ',', '.')}}</td>
                        <td colspan="2">TOTAL GERAL: {{ 'R$ '.number_format($total_geral, 2, ',', '.')}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </div>
            @endif
        </div>
        <div class="card-footer">
            {{ $rels->links() }}
        </div>
    </div>
    <br/>
    <a href="/admin/relatorios/vendas" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection