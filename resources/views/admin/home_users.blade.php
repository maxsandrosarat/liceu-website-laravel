@extends('layouts.app_logado', ["current"=>"users"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row justify-content-center">
        <div class="col align-self-center">
        <div class="card-deck">
            <div class="d-flex justify-content-center centralizado">
                <div class="card border-primary text-center" style="width: 300px;">
                    <div class="card-body">
                        <h5>Colaboradores</h5>
                        <p class="card-text">
                            Gerenciar Colaboradores
                        </p>
                        <a href="/admin/colaborador" class="btn btn-primary">Gerenciar</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center centralizado">
                <div class="card border-primary text-center" style="width: 300px;">
                    <div class="card-body">
                        <h5>Usuários</h5>
                        <p class="card-text">
                            Gerenciar Usuários
                        </p>
                        <a href="/admin/clientes" class="btn btn-primary">Gerenciar</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection