@extends('layouts.app_logado', ["current"=>"users"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Lista de Clientes</h5>
            @if(count($clientes)==0)
                <div class="alert alert-danger" role="alert">
                    Sem clientes cadastrados!
                </div>
            @else
            <div class="card border">
                <h5>Filtros: </h5>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/admin/clientes/filtro">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="nome" class="form-control" placeholder="Nome do Cliente" aria-label="Nome do Cliente" aria-describedby="button">
                        <input type="text" name="email" class="form-control" placeholder="E-mail do Cliente" aria-label="E-mail do Cliente" aria-describedby="button">
                        <div class="input-group-append">
                          <button class="btn btn-outline-success" type="submit" id="button">Filtrar</button>
                        </div>
                      </div>
                </form>
                </div>
                <br/>
            <h5>Exibindo {{$clientes->count()}} de {{$clientes->total()}} de Clientes ({{$clientes->firstItem()}} a {{$clientes->lastItem()}})</h5>
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Endereços</th>
                        <th>Telefones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->id}}</td>
                        <td>{{$cliente->name}}</td>
                        <td>{{$cliente->email}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalEnd{{$cliente->id}}">
                            Endereços
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalEnd{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Endereços - Cliente: {{$cliente->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if(count($cliente->enderecos)==0)
                                        <div class="alert alert-danger" role="alert">
                                            Sem endereços cadastrados!
                                        </div>
                                    @else
                                    <table class="table table-striped table-ordered table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Endereço</th>
                                                <th>Tipo</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cliente->enderecos as $endereco)
                                            @if($endereco->ativo==true) <tr style="color:green;"> @else <tr style="color:red;"> @endif
                                                <td>{{$endereco->rua}}, {{$endereco->numero}} ({{$endereco->complemento}}) - {{$endereco->bairro}} -  {{$endereco->cidade}} - {{$endereco->uf}} - {{$endereco->cep}}</td>
                                                <td>{{$endereco->tipo}}</td>
                                                <td>@if($endereco->ativo==true) ATIVO @else INATIVO @endif</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalTel{{$cliente->id}}">
                            Telefones
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalTel{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Telefones - Cliente: {{$cliente->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if(count($cliente->telefones)==0)
                                        <div class="alert alert-danger" role="alert">
                                            Sem telefones cadastrados!
                                        </div>
                                    @else
                                    <table class="table table-striped table-ordered table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Número</th>
                                                <th>Tipo</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cliente->telefones as $telefone)
                                            @if($telefone->ativo==true) <tr style="color:green;"> @else <tr style="color:red;"> @endif
                                                <td>{{$telefone->numero}}</td>
                                                <td>{{$telefone->tipo}}</td>
                                                <td>@if($telefone->ativo==true) ATIVO @else INATIVO @endif</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>
        <div class="card-footer">
            {{ $clientes->links() }}
        </div>
    </div>
    <br>
    <a href="/admin/users" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection
