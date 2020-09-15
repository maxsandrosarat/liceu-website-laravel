@extends('layouts.app_principal', ["current"=>"telefones"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Lista de Telefones</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Cadastrar Novo Telefone
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Telefone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/telefones">
                            @csrf
                                <label for="numero">Número do Telefone</label>
                                <input name="numero" class="form-control" id="numero" size="60" onblur="formataNumeroTelefone()" placeholder="Número com DDD, exemplo: 67991234567">
                                <br/>
                                <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo" required>
                                    <option value="PESSOAL">Pessoal</option>
                                    <option value="RESIDENCIAL">Residencial</option>
                                    <option value="COMERCIAL">Comercial</option>
                                    <option value="RECADO">Recado</option>
                                </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sn">Salvar</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            @if(count($clienteTelefones)==0)
                <br/><br/>
                <div class="alert alert-danger" role="alert">
                    Sem telefones cadastrados!
                </div>
            @else
            <br/><br/>
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Telefone</th>
                        <th>Tipo</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clienteTelefones as $tel)
                    @if($tel->telefone->ativo==true)
                    <tr>
                        <td>{{$tel->telefone->numero}}</td>
                        <td>{{$tel->telefone->tipo}}</td>
                        <td>
                            <a href="/telefones/apagar/{{$tel->telefone->id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Excluir"><i class="material-icons md-48">delete</i></a>
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
    <a href="/carrinho" class="btn btn-success" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection