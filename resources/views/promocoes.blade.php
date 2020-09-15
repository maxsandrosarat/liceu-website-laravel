@extends('layouts.app_principal', ["current"=>"produtos"])

@section('body')
  <div class="row">
    <div id="filtros" class="col">
      <div class="card-deck ">
          <div class="card border border-primary">
              <div class="card-body bg-light mb-3">
                  <h5>Busca</h5>
                  <form class="form-inline my-2 my-lg-0" method="GET" action="/busca">
                      @csrf
                      <label for="categoria">Categoria:</label>
                      <select class="custom-select" id="categoria" name="categoria">
                          <option value="">__Selecione__</option>
                          @foreach ($cats as $cat)
                          <option value="{{$cat->id}}">{{$cat->nome}}</option>
                          @endforeach
                      </select>
                      <br/><br/>
                      <label for="turma">Turma:</label>
                      <select class="custom-select" id="turma" name="turma">
                          <option value="">__Selecione__</option>
                          @foreach ($turmas as $turma)
                          @if($turma->turma===0)
                          <option value="0">Todas Turmas</option>
                          @else
                          <option value="{{$turma->turma}}">{{$turma->turma}}</option>
                          @endif
                          @endforeach
                      </select>
                      <br/><br/>
                      <input class="form-control mr-sm-2" type="text" size="15" placeholder="Nome do Produto" name="nome" id="nome">
                      <br/><br/>
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                  </form>
              </div>
          </div>
      </div>
    </div>
    <div id="produtos" class="col-8">
      @if(count($prods)==0)
            <br/>
            @if($view=="inicial")
            <h5>Sem produtos em promoção! <a href="/produtos" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Todos os Produtos">Todos os Produtos</a></h5>
            @else @if($view=="filtro")
            <h5>Sem resultados da busca!</h5>
            @endif @endif
      @else
        <h2 class="promocao">Promoções</h2>
        <h5>Exibindo {{$prods->count()}} de {{$prods->total()}} de Produtos ({{$prods->firstItem()}} a {{$prods->lastItem()}})</h5>
        <a href="/produtos" class="btn btn-success"data-toggle="tooltip" data-placement="bottom" title="Todos os Produtos">Todos os Produtos</a>
        <br/><br/>
        <div class="card-columns">
          @foreach ($prods as $prod)
          <div class="card text-white bg-info">
            <button type="button" data-toggle="modal" data-target="#exampleModalFoto{{$prod->id}}">@if($prod->foto!="")<img class="card-img-top" style="margin:0px; padding:0px;" src="/storage/{{$prod->foto}}" alt="foto_produto"> @else <i class="material-icons md-60">no_photography</i> @endif</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalFoto{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: black;">{{$prod->nome}} @if($prod->turma!=0) {{$prod->turma}}º ANO @else Todas Turmas @endif - @if($prod->ensino=='EFI') Fund. 1 @else @if($prod->ensino=='EFII') Fund. 2 @else @if($prod->ensino=='EM') Médio @else Todos Ensinos @endif @endif @endif {{$prod->marca}} {{$prod->embalagem}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black; text-align: center;">
                  @if($prod->foto!="")<img src="/storage/{{$prod->foto}}" alt="foto_produto" width="100%">@else <i class="material-icons md-60">no_photography</i> @endif
                    <br/><br/>
                    <b><text>Descrição Completa:</text></b><br/>
                    <text>{!!nl2br($prod->descricao)!!}</text>
                </div>
                </div>
            </div>
            </div>
            <div class="card-body">
              <p class="card-text">{{$prod->nome}} @if($prod->turma!=0) {{$prod->turma}}º ANO @else Todas Turmas @endif - @if($prod->ensino=='EFI') Fund. 1 @else @if($prod->ensino=='EFII') Fund. 2 @else @if($prod->ensino=='EM') Médio @else Todos Ensinos @endif @endif @endif {{$prod->marca}} {{$prod->embalagem}} <br/> <h6>{{ 'R$ '.number_format($prod->preco, 2, ',', '.')}}</h6>
                <form method="POST" action="{{ route('carrinho.adicionar') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $prod->id }}">
                <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="O produto será adicionado ao seu carrinho">Comprar</button>
                @if($prod->promocao==1)<h6 class="promocao">Promoção</h6>@endif
                </form>
              </p>
            </div>
          </div>
          @endforeach
        </div>
        <div class="card-footer">
          {{ $prods->links() }}
        </div>
      @endif
      </div>
      <div id="anuncios" class="col">
        <br/>
          <p style="font-weight: bold;">Parceiros</p>
          @foreach ($anuncios as $anuncio)
            <a href="{{$anuncio->link}}" target="_blank"><img class="card-img-top" style="margin:0px; padding:0px;" src="/storage/{{$anuncio->foto}}" alt="{{$anuncio->nome}}"></a>
            <br/><br/>
          @endforeach
      </div>
  </div>
@endsection