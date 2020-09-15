@extends('layouts.app_logado', ["current"=>"relatorios"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Relatório de Entradas/Saídas</h5>
            @if(count($rels)==0)
                    <div class="alert alert-dark" role="alert">
                        @if($view=="inicial")
                        Sem movimentos cadastrados!
                        @else @if($view=="filtro")
                        Sem resultados da busca!
                        <a href="/admin/relatorios/estoque" class="btn btn-success">Voltar</a>
                        @endif
                        @endif
                    </div>
            @else
            <div class="card border">
            <h5>Filtros: </h5>
            <form class="form-inline my-2 my-lg-0" method="GET" action="/admin/relatorios/estoque/filtro">
                @csrf
                <select class="custom-select" id="tipo" name="tipo">
                    <option value="">Selecione o tipo</option>
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
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
                        <th>Movimento</th>
                        <th>Nome Produto</th>
                        <th>Qtd</th>
                        <th>Usuário</th>
                        <th>Motivo</th>
                        <th>Data & Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rels as $rel)
                    @if($rel->tipo=='entrada') <tr style="color:blue;"> @else <tr style="color:green; font-weight: bold;"> @endif
                        <td>{{$rel->id}}</td>
                        <td>@if($rel->tipo=='entrada') Entrada @else Saída @endif</td>
                        <td>{{$rel->produto->nome}} @if($rel->produto->turma!=0) {{$rel->produto->turma}}º ANO @else Todas Turmas @endif @if($rel->produto->ensino=='EFI') (Fund. 1) @else @if($rel->produto->ensino=='EFII') (Fund. 2) @else @if($rel->produto->ensino=='EM') (Médio) @else - Todos Ensinos @endif @endif @endif {{$rel->produto->marca}} {{$rel->produto->embalagem}}</td>
                        <td>{{$rel->quantidade}}</td>
                        <td>{{$rel->usuario}}</td>
                        <td>{{$rel->motivo}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($rel->created_at))}}</td>
                    </tr>
                    @endforeach
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
    <a href="/admin/relatorios" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection