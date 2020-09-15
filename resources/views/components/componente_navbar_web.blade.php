<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/">
  <img src="/storage/images/liceu.png" alt="logo_liceu" width="100" class="d-inline-block align-top" loading="lazy">
  </a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav mr-auto">
          <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
              <a class="nav-link" href="/">Principal</a>
          </li>
          <li @if($current=="produtos") class="nav-item active" @else class="nav-item" @endif>
              <a class="nav-link" href="/produtos">Produtos</a>
          </li>
          <!--WEB-->
          @auth("web")
          <li @if($current=="carrinho") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="{{ route('carrinho.index') }}">@if($current=="carrinho")<i class="material-icons white">shopping_cart</i><span class="badge badge-success">{{ Auth::user()->carrinho }}@else <i class="material-icons grey">shopping_cart</i><span class="badge badge-secondary">{{ Auth::user()->carrinho }}@endif</span></a>
          </li>
          <li @if($current=="compras") class="nav-item active" @else class="nav-item" @endif>
              <a class="nav-link" href="/compras">Minhas Compras</a>
          </li>
          <li @if($current=="enderecos") class="nav-item active" @else class="nav-item" @endif>
              <a class="nav-link" href="/enderecos">Meus Endereços</a>
          </li>
          <li @if($current=="telefones") class="nav-item active" @else class="nav-item" @endif>
              <a class="nav-link" href="/telefones">Meus Telefones</a>
          </li>
          @endauth

            <!--DESLOGADO-->
            @guest

            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
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
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
      </ul>
  </div>
</nav>