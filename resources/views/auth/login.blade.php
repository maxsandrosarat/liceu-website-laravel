@extends('layouts.app', ["current"=>"home"])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('mensagem'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <h5>{{session('mensagem')}}</h5>
                </div>
            @endif
            <div class="card-header">
            <label for="">LOGIN COMO</label>
            <select class="custom-select" name="tipoLogin" id="tipoLogin">
                <option value="">Selecione o Tipo de Login</option>
                <option value="user">USUÁRIO</option>
                <option value="outro">COLABORADOR</option>
                <option value="admin">ADMINISTRADOR</option>
            </select>
            </div>
            <div id="principal">

                <div class="card" id="user">

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Usuário</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
    
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                          <input id="senha-user" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-describedby="botao-senha">
                                          <div class="input-group-append">
                                              <button id="botao-senha-user" class="btn btn-success btn-sm" type="button" data-toggle="tooltip" data-placement="bottom" title="Exibir Senha" onclick="mostrarSenhaUser()"><i id="icone-senha-user"class="material-icons white">visibility</i></button>
                                          </div>
                                      </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Lembrar Usuário
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Esqueceu a senha?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card" id="outro">
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('outro.login.submit') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Usuário</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
    
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                          <input id="senha-outro" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-describedby="botao-senha">
                                          <div class="input-group-append">
                                              <button id="botao-senha-outro" class="btn btn-success btn-sm" type="button" data-toggle="tooltip" data-placement="bottom" title="Exibir Senha" onclick="mostrarSenhaOutro()"><i id="icone-senha-outro"class="material-icons white">visibility</i></button>
                                          </div>
                                      </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card" id="admin">
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Usuário</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
    
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                          <input id="senha-admin" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-describedby="botao-senha">
                                          <div class="input-group-append">
                                              <button id="botao-senha-admin" class="btn btn-success btn-sm" type="button" data-toggle="tooltip" data-placement="bottom" title="Exibir Senha" onclick="mostrarSenhaAdmin()"><i id="icone-senha-admin"class="material-icons white">visibility</i></button>
                                          </div>
                                      </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            
            </div>

        </div>
    </div>
</div>
@endsection