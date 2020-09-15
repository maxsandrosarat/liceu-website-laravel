@extends('layouts.app_logado', ["current"=>"pedidos"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row justify-content-center">
        <div class="col align-self-center">
            <div class="card-deck">
                <div class="d-flex justify-content-center centralizado">
                    <div class="card border-primary text-center" style="width: 255px;">
                        <div class="card-body text-primary">
                        <h5 class="card-title">Feitos</h5>
                        <p class="card-text">Pedidos feitos!
                            <br/><br/>
                                <a href="/admin/pedidos/feitos" class="btn btn-primary">Feitos</a>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center centralizado">
                    <div class="card border-success text-center" style="width: 255px;">
                        <div class="card-body text-success">
                        <h5 class="card-title">Pagos</h5>
                        <p class="card-text">Pedidos pagos!
                            <br/><br/>
                            <a href="/admin/pedidos/pagos" class="btn btn-success">Pagos</a>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center centralizado">
                    <div class="card border-danger text-center" style="width: 255px;">
                        <div class="card-body text-danger">
                        <h5 class="card-title">Cancelados</h5>
                        <p class="card-text">Pedidos cancelados! 
                            <br/><br/>
                            <a href="/admin/pedidos/cancelados" class="btn btn-danger">Cancelados</a>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center centralizado">
                    <div class="card border-warning text-center" style="width: 255px;">
                        <div class="card-body text-warning">
                        <h5 class="card-title">Reservados</h5>
                        <p class="card-text">Pedidos reservados! 
                            <br/><br/>
                            <a href="/admin/pedidos/reservados" class="btn btn-warning">Reservados</a>
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection