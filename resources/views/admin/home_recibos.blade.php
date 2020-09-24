@extends('layouts.app_logado', ["current"=>"recibos"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row justify-content-center">
        <div class="col align-self-center">
        <div class="card-deck">
            <div class="d-flex justify-content-center centralizado">
                <div class="card border-primary text-center" style="width: 300px;">
                    <div class="card-body">
                        <h5>Compra Livros</h5>
                        <p class="card-text">
                            Gerenciar Recibos
                        </p>
                        <a href="/admin/compraLivro" class="btn btn-primary">Gerenciar</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection