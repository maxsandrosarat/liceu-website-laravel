<!-- Nav -->
<nav id="menu">
	<ul class="links">
		@auth("web")
		<li><a href="/home">Usuário: {{explode(" ", Auth::user()->name)[0]}}</a></li>
		<li><a href="/">HOME</a></li>
		<li><a href="/promocoes">PRODUTOS</a></li>
		<br/>
		<li>
			<form id="logout-form" action="{{ route('logout') }}" method="POST">
				@csrf
				<button class="btn btn-outline-dark btn-sm btn-block" type="submit">
					<b>SAIR</b>
				</button>
			</form>
		</li>
        @else
			@auth("admin")
			<li><a href="/admin">Usuário Admin: {{explode(" ", Auth::guard('admin')->user()->name)[0]}}</a></li>
			<li><a href="/">HOME</a></li>
			<li><a href="/admin/users">USUÁRIOS</a></li>
			<li><a href="/admin/recibos">RECIBOS</a></li>
			<li><a href="/admin/principal">POSTAGENS</a></li>
			<li><a href="/admin/cadastros">CADASTROS</a></li>
			<li><a href="/admin/pedidos">PEDIDOS</a></li>
			<li><a href="/admin/estoque">ESTOQUE</a></li>
			@component('components.componente_menu_lista')
		    @endcomponent
			<br/>
			<li>
				<form id="logout-form" action="{{ route('logout') }}" method="POST">
					@csrf
					<button class="btn btn-outline-dark btn-sm btn-block" type="submit">
						<b>SAIR</b>
					</button>
				</form>
			</li>
			@else
				@auth("outro")
				<li><a href="/outro">Usuário: {{explode(" ", Auth::guard('outro')->user()->name)[0]}}</a></li>
				<li><a href="/">HOME</a></li>
				<li><a href="/outro/recibos">RECIBOS</a></li>
				<li><a href="/outro/principal">POSTAGENS</a></li>
				@component('components.componente_menu_lista')
		    	@endcomponent
				<br/>
				<li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST">
						@csrf
						<button class="btn btn-outline-dark btn-sm btn-block" type="submit">
							<b>SAIR</b>
						</button>
					</form>
				</li>
				@else
				<li><a href="/">HOME</a></li>
				<li><a href="/promocoes">PRODUTOS</a></li>
				@component('components.componente_menu_lista')
		    	@endcomponent
				<li><a href="/login">LOGIN</a></li>
				<li><a href="/register">CADASTRE-SE</a></li>
				@endauth
			@endauth
		@endauth
	</ul>
</nav>