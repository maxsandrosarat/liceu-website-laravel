<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">
        <img src="/storage/images/liceu.png" alt="logo_pet67" width="100" class="d-inline-block align-top" alt="" loading="lazy">
    </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav mr-auto">
            <!--ADMIN-->
            @auth("admin")
            <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/admin">Home</a>
            </li>
            <li @if($current=="users") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/admin/users">Usuários</a>
            </li>
            <li @if($current=="principal") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/admin/principal">Layout Inicial</a>
            </li>
            <li @if($current=="cadastros") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/admin/cadastros">Cadastros</a>
            </li>
            <li @if($current=="pedidos") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/admin/pedidos">Pedidos</a>
            </li>
            <li @if($current=="estoque") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/admin/estoque">Estoque</a>
            </li>
            <li @if($current=="relatorios") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/admin/relatorios">Relatórios</a>
            </li>
            @endauth

            <!--OUTRO-->
            @auth("outro")
            <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/outro">Home</a>
            </li>
            <li @if($current=="principal") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/outro/principal">Página Principal</a>
            </li>
            @endauth

            <!--WEB-->
            @auth("web")
            <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/home">Home</a>
            </li>
            <li @if($current=="la") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/listaAtividade">Lista Atividades</a>
            </li>
            @endauth

            <!--DESLOGADO-->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login(Usuário)') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login(Admin)') }}</a>
            </li>
            
            @if (Route::has('register'))
            <li class="nav-item">
               <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastre-se') }}</a>
           </li>
            @endif

            <!--LOGADO-->
            @else
            <!--LOGOUT-->
            <li class="nav-item dropdown" class="nav-item">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        SAIR
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            <li class="nav-item dropdown" class="nav-item">
                @if(Auth::user()->foto!="")
                <img style="border-radius: 20px;" src="/storage/{{Auth::user()->foto}}" alt="foto_perfil" width="10%">
                @endif
            </li>
            @endguest
        </ul>
    </div>
  </nav>