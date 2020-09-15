@extends('layouts.app_principal', ["current"=>"enderecos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Lista de Endereços</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Cadastrar Novo Endereço
            </button>
            <br/><br/>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <h5><b>Caso saiba seu CEP, digite (apenas números) e em seguida os campos serão autocompletados</b></h5>
                        <form method="post" action="/enderecos">
                            @csrf
                                <label>Cep:
                                <input class="form-control" name="cep" type="number" id="cep" value="" size="10" maxlength="9"
                                       onblur="pesquisacep(this.value);" /></label><br />
                                <label>Rua:
                                <input class="form-control" name="rua" type="text" id="rua" size="60" required/></label><br />
                                <label>Bairro:
                                <input class="form-control" name="bairro" type="text" id="bairro" size="40" required/></label><br />
                                <label>Cidade:
                                <input class="form-control" name="cidade" type="text" id="cidade" size="40" required /></label><br />
                                <label>Estado:
                                <input class="form-control" name="uf" type="text" id="uf" size="2" required/></label><br />
                                <input class="form-control" name="ibge" type="hidden" id="ibge" size="8" />
                                <label for="numero">Número</label>
                                <input class="form-control" type="number" name="numero" id="numero" size="5"><br>
                                <label for="complemento">Complemento</label>
                                <input class="form-control" type="text" name="complemento" id="complemento" size="60">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo" required>
                                    <option value="RESIDENCIAL">Residencial</option>
                                    <option value="COMERCIAL">Comercial</option>
                                </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            @if(count($clienteEnderecos)==0)
                <div class="alert alert-danger" role="alert">
                    Sem endereços cadastrados!
                </div>
            @else
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>CEP</th>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Complemento</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>UF</th>
                        <th>Tipo</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clienteEnderecos as $end)
                    @if($end->endereco->ativo==true)
                    <tr>
                        <td>{{$end->endereco->cep}}</td>
                        <td>{{$end->endereco->rua}}</td>
                        <td>{{$end->endereco->numero}}</td>
                        <td>{{$end->endereco->complemento}}</td>
                        <td>{{$end->endereco->bairro}}</td>
                        <td>{{$end->endereco->cidade}}</td>
                        <td>{{$end->endereco->uf}}</td>
                        <td>{{$end->endereco->tipo}}</td>
                        <td>
                            <a href="/enderecos/apagar/{{$end->endereco->id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Excluir"><i class="material-icons md-48">delete</i></a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
        </div>

    </div>
    <br>
    <a href="/carrinho" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection