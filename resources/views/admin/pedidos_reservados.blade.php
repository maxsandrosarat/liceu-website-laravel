@extends('layouts.app_logado', ["current"=>"pedidos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Produtos Reservados</h5>
            @if(count($rels)==0)
                <div class="alert alert-dark" role="alert">
                    Sem produtos em status Reservado!
                </div>
            @else
            <br/>
            <div class="table-responsive-xl">
            <table id="yesprint" class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Pedido</th>
                        <th>Nome Produto</th>
                        <th>Status</th>
                        <th>Cliente</th>
                        <th>Data & Hora</th>
                        <th>Liberar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rels as $rel)
                    <tr>
                        <td>{{$rel->id}}</td>
                        <td>{{$rel->pedido_id}}</td>
                        <td>{{$rel->produto->nome}} @if($rel->produto->turma!=0) {{$rel->produto->turma}}º ANO @else Todas Turmas @endif @if($rel->produto->ensino=='EFI') (Fund. 1) @else @if($rel->produto->ensino=='EFII') (Fund. 2) @else @if($rel->produto->ensino=='EM') (Médio) @else - Todos Ensinos @endif @endif @endif {{$rel->produto->marca}} {{$rel->produto->embalagem}}</td>
                        <td @if($rel->status=='RESERV') style="color:orange; font-weight: bold;" @else @if($rel->status=='FEITO') style="color:blue; font-weight: bold;" @else @if($rel->status=='PAGO') style="color:green; font-weight: bold;" @else style="color:red; font-weight: bold;" @endif @endif @endif>@if($rel->status=='RESERV') Reservado @else @if($rel->status=='FEITO') Feito @else @if($rel->status=='PAGO') Pago @else Cancelado @endif @endif @endif</td>
                        <td>{{$rel->pedido->user->name}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($rel->created_at))}}</td>
                        <td><a href="/admin/pedidos/reservados/liberar/{{$rel->id}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="right" title="Liberar">Liberar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>
    </div>
    <br/>
    <a href="/admin/pedidos" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection