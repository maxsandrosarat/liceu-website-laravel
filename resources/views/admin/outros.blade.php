@extends('layouts.app_logado', ["current"=>"users"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Lista de Outros</h5>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    Erros de Importação<br/><br/>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            <a type="button" class="float-button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalNew" data-toggle="tooltip" data-placement="bottom" title="Adicionar Novo Outro ou Outros">
                <i class="material-icons blue md-60">add_circle</i>
            </a>
            @if(count($outros)==0)
                    <div class="alert alert-dark" role="alert">
                        @if($view=="inicial")
                        Sem colaboradores cadastrados! Faça novo cadastro no botão    <a type="button" href="#"><i class="material-icons blue">add_circle</i></a>   no canto inferior direito.
                        @endif
                        @if($view=="filtro")
                        Sem resultados da busca!
                        <a href="/admin/colaborador" class="btn btn-success">Voltar</a>
                        @endif
                    </div>
            @else
            <div class="card border">
                <h5>Filtros: </h5>
            <form class="form-inline my-2 my-lg-0" method="GET" action="/admin/colaborador/filtro">
                @csrf
                <input class="form-control" type="text" placeholder="Nome do Usuário" name="nome">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
            </form>
            </div>
            <h5>Exibindo {{$outros->count()}} de {{$outros->total()}} de Usuários ({{$outros->firstItem()}} a {{$outros->lastItem()}})</h5>
            <div class="table-responsive-xl">
            <table class="table table-striped table-ordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($outros as $outro)
                    <tr>
                        <td>{{$outro->id}}</td>
                        <td>{{$outro->name}}</td>
                        <td>{{$outro->email}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal{{$outro->id}}">
                                Editar
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$outro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edição de Usuário</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <form method="POST" action="/admin/colaborador/editar/{{$outro->id}}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="name">{{ __('Nome') }}</label>
                        
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$outro->name}}" required autocomplete="name" autofocus>
                        
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                        
                                                <div class="form-group row">
                                                    <label for="email">{{ __('Login') }}</label>
                        
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$outro->email}}" required autocomplete="email">
                        
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password">Senha</label>
                        
                                                        <input id="senhaForca" onkeyup="validarSenhaForca()" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                        <p style="font-size: 70%">(Mínimo de 8 caracteres)</p>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="erroSenhaForca">Força Senha</label>
                                                    <div class="col-md-6">
                                                        <div name="erroSenhaForca" id="erroSenhaForca"></div>
                                                    </div>
                                                </div>
                        
                                                <div class="form-group row">
                                                    <label for="password-confirm">{{ __('Confirmação de Senha') }}</label>
                        
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                                </div>

                                                <div class="modal-footer">
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ __('Salvar') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <a href="/admin/colaborador/apagar/{{$outro->id}}" class="btn btn-sm btn-danger">Excluir</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer">
                {{$outros->links() }}
            </div>
            </div>
            @endif
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="/admin/colaborador">
                        @csrf
                        <div class="form-group row">
                            <label for="name">{{ __('Nome') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email">{{ __('Login') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password">Senha</label>

                                <input id="senhaForca" onkeyup="validarSenhaForca()" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <p style="font-size: 70%">(Mínimo de 8 caracteres)</p>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group row">
                            <label for="erroSenhaForca">Força Senha</label>
                            <div class="col-md-6">
                                <div name="erroSenhaForca" id="erroSenhaForca"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm">{{ __('Confirmação Senha') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="modal-footer">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Cadastrar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    <br/>
    <a href="/admin/users" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="material-icons white">reply</i></a>
@endsection
