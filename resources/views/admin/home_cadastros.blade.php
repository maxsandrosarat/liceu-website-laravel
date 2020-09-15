@extends('layouts.app_logado', ["current"=>"cadastros"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row justify-content-center">
        <div class="col align-self-center">
            <div class="card-deck">
                <div class="d-flex justify-content-center centralizado">
                    <div class="card border-primary text-center" style="width: 255px;">
                        <div class="card-body">
                            <h5>Produtos</h5>
                            <p class="card-text">
                                Gerencie seus Produtos!
                            </p>
                            <a href="/admin/produtos" class="btn btn-primary">Gerenciar</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center centralizado">
                    <div class="card border-primary text-center" style="width: 255px;">
                        <div class="card-body">
                            <h5>Categorias</h5>
                            <p class="card-text">
                                Gerencie suas Categorias!
                            </p>
                            <a href="/admin/categorias" class="btn btn-primary">Gerenciar</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center centralizado">
                    <div class="card border-primary text-center" style="width: 255px;">
                        <div class="card-body">
                            <h5>Cupons de Desconto</h5>
                            <p class="card-text">
                                Gerencie seus Cupons de Desconto! 
                            </p>
                            <a href="/admin/cuponsDesconto" class="btn btn-primary">Gerenciar</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center centralizado">
                    <div class="card border-primary text-center" style="width: 255px;">
                        <div class="card-body">
                            <h5>Formas de Pagamento</h5>
                            <p class="card-text">
                                Cadastre suas formas de pagamento! 
                            </p>
                            <a href="/admin/formasPagamento" class="btn btn-primary">Gerenciar</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center centralizado">
                    <div class="card border-primary text-center" style="width: 255px;">
                        <div class="card-body">
                            <h5>Formas de Entrega</h5>
                            <p class="card-text">
                                Cadastre suas formas de entrega! 
                            </p>
                            <a href="/admin/entregas" class="btn btn-primary">Gerenciar</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center centralizado">
                    <div class="card border-primary text-center" style="width: 255px;">
                        <div class="card-body">
                            <h5>Anúncios</h5>
                            <p class="card-text">
                                Cadastre seus Anúncios! 
                            </p>
                            <a href="/admin/anuncios" class="btn btn-primary">Gerenciar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection