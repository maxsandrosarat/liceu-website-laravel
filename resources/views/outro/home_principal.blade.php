@extends('layouts.app_logado', ["current"=>"principal"])

@section('body')
<div class="jumbotron bg-light border border-secondary">
    <div class="row justify-content-center">
        <div class="col align-self-center">
        <div class="card-deck">
            <div class="d-flex justify-content-center centralizado">
                <div class="card border-primary text-center" style="width: 300px;">
                    <div class="card-body">
                        <h5>Banners</h5>
                        <p class="card-text">
                            Gerenciar Banners
                        </p>
                        <a href="/outro/banner" class="btn btn-primary">Gerenciar</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center centralizado">
                <div class="card border-primary text-center" style="width: 300px;">
                    <div class="card-body">
                        <h5>Postagens</h5>
                        <p class="card-text">
                            Gerenciar Postagens
                        </p>
                        <a href="/outro/post" class="btn btn-primary">Gerenciar</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center centralizado">
                <div class="card border-primary text-center" style="width: 300px;">
                    <div class="card-body">
                        <h5>Fotos</h5>
                        <p class="card-text">
                            Gerenciar Fotos
                        </p>
                        <a href="/outro/foto" class="btn btn-primary">Gerenciar</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center centralizado">
                <div class="card border-primary text-center" style="width: 300px;">
                    <div class="card-body">
                        <h5>Álbuns</h5>
                        <p class="card-text">
                            Gerenciar Álbuns
                        </p>
                        <a href="/outro/album" class="btn btn-primary">Gerenciar</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection