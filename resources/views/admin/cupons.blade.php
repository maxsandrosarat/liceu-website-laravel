@extends('layouts.app_logado', ["current"=>"cadastros"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Lista de Cupons de Desconto</h5>
            <a type="button" class="float-button" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="bottom" title="Adicionar Novo Cupom">
                <i class="material-icons blue md-60">add_circle</i>
            </a>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cupons</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="/admin/cuponsDesconto" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nome">Nome do Cupom</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Exemplo: Cupom desconto primeira compra" required>
                                <label for="localizador">Localizador</label>
                                <input type="text" class="form-control" name="localizador" id="localizador" placeholder="Exemplo: PRIMEIRACOMPRA" required>
                                <br/>
                                <label for="modo_desconto">Modo de desconto
                                <select class="custom-select" name="modo_desconto" required="required">
                                    <option value="">-- Selecione</option>
                                    <option value="porc">Porcentagem no valor do produto</option>
                                    <option value="valor">Valor fixo</option>
                                </select></label>
                                <label for="desconto">Desconto
                                <input type="text" class="form-control" name="desconto" id="desconto" placeholder="Exemplo: 20" required></label>
                                <br/>
                                <!--<label for="modo_limite">Modo de limite
                                <select class="custom-select" name="modo_limite" required="required">
                                    <option value="">-- Selecione</option>
                                    <option value="qtd">Quantidade de desconto</option>
                                    <option value="valor">Valor de desconto</option>
                                </select></label>
                                
                                <label for="limite">Limite desconto
                                <input type="text" class="form-control" name="limite" id="limite" required="required"></label>-->
                                <br/>
                                <label for="validade">Data Validade
                                <input type="date" class="form-control" name="dataValidade" id="validade"  required="required"></label>
	                            <input type="time" name="horaExpiracao" id="horaValidade" required>

                                <h5>Cupom Ativo?</h5>
                                <input type="radio" id="sim" name="ativo" value="1" required>
                                <label for="sim">Sim</label>
                                <input type="radio" id="nao" name="ativo" value="0" required>
                                <label for="nao">Não</label>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            @if(count($cupons)==0)
                <div class="alert alert-danger" role="alert">
                    Sem cupons cadastrados!
                </div>
            @else
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Localizador</th>
                        <th>Desconto</th>
                        <!--<th>Limite</th>-->
                        <th>Validade</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cupons as $cupom)
                    <tr>
                        <td>{{$cupom->id}}</td>
                        <td>{{$cupom->nome}}</td>
                        <td>{{$cupom->localizador}}</td>
                        <td>@if($cupom->modo_desconto == 'valor')R$ {{$cupom->desconto}} @else {{$cupom->desconto}}% @endif</td>
                        <!--<td>@if($cupom->modo_limite == 'valor')R$ {{$cupom->limite}}@else {{$cupom->desconto}} qtd @endif</td>-->
                        <td>{{date("d/m/Y H:i", strtotime($cupom->validade))}}</td>
                        <td>@if($cupom->ativo=="1") SIM @else NÃO @endif</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal{{$cupom->id}}" data-toggle="tooltip" data-placement="left" title="Editar">
                                <i class="material-icons md-48">edit</i>
                            </button>
                            
                            <div class="modal fade" id="exampleModal{{$cupom->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Cupom</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/admin/cuponsDesconto/editar/{{$cupom->id}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nome">Nome do Cupom</label>
                                                <input type="text" class="form-control" name="nome" id="nome" value="{{$cupom->nome}}" required>

                                                <label for="localizador">Localizador</label>
                                                <input type="text" class="form-control" name="localizador" id="localizador" value="{{$cupom->localizador}}" required>

                                                <label for="modo_desconto">Modo de desconto
                                                <select class="custom-select" name="modo_desconto" required="required">
                                                    <option value="{{$cupom->modo_desconto}}">@if($cupom->modo_desconto=="porc") Porcentagem no valor do produto @else Valor fixo @endif</option>
                                                    @if($cupom->modo_desconto=="valor")
                                                    <option value="porc">Porcentagem no valor do produto</option>
                                                    @endif
                                                    @if($cupom->modo_desconto=="porc")
                                                    <option value="valor">Valor fixo</option>
                                                    @endif
                                                </select></label>
                                                
                                                
                                                <label for="desconto">Desconto
                                                <input type="text" class="form-control" name="desconto" id="desconto" value="{{$cupom->desconto}}" required></label>

                                                <!--<label for="modo_limite">Modo de limite
                                                <select class="custom-select" name="modo_limite" required="required">
                                                    <option value="{{$cupom->modo_limite}}">-- Selecione</option>
                                                    <option value="qtd">Quantidade de desconto</option>
                                                    <option value="valor">Valor de desconto</option>
                                                </select></label>
                                                
                                                
                                                <label for="limite">Limite desconto
                                                <input type="text" class="form-control" name="limite" id="limite" value="{{$cupom->limite}}" required="required"></label>-->
                                                
                                                <br/>
                                                <label for="validade">Data Validade
                                                <input type="date" class="form-control" name="dataValidade" id="dataValidade"  value="{{date("Y-m-d", strtotime($cupom->validade))}}" required></label>
                                                <input type="time" name="horaValidade" id="horaValidade" value="{{date("H:i", strtotime($cupom->validade))}}" required>
                                                

                                                <h5>Cupom Ativo?</h5>
                                                <input type="radio" id="sim" name="ativo" value="1" @if($cupom->ativo=="1") checked @endif required>
                                                <label for="sim">Sim</label>
                                                <input type="radio" id="nao" name="ativo" value="0" @if($cupom->ativo=="0") checked @endif required>
                                                <label for="nao">Não</label>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                                    </div>
                                </form>
                                </div>
                                </div>
                            </div>
                            <a href="/admin/cuponsDesconto/apagar/{{$cupom->id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Inativar"><i class="material-icons md-48">delete</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>
    </div>
    <br>
    <a href="/admin/cadastros" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection