@extends('layouts.app_principal', ["current"=>"compras"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border-success mb-3" style="width: 16rem;">
                <div class="card-body text-success">
                  <h5 class="card-title">Concluídas</h5>
                  <p class="card-text">Compras concluídas!</p>
                  <a href="{{ route('carrinho.compras') }}" class="btn btn-success">Concluídas</a>
                </div>
            </div>
            <div class="card border-danger mb-3" style="width: 16rem;">
                <div class="card-body text-danger">
                  <h5 class="card-title">Canceladas</h5>
                  <p class="card-text">Compras canceladas!</p>
                  <a href="{{ route('carrinho.canceladas') }}" class="btn btn-danger">Canceladas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection