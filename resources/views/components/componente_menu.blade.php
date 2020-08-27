<!-- Nav -->
<nav id="menu">
	<ul class="links">
		@auth("web")
		<li><a href="/home">Usuário: {{explode(" ", Auth::user()->name)[0]}}</a></li>
		<li><a href="/">HOME</a></li>

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
			<li><a href="/admin/users">USUÁRIOS</a></li>
			<li><a href="/admin/principal">PÁGINA PRINCIPAL</a></li>

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
				<li><a href="/outro/principal">PÁGINA PRINCIPAL</a></li>

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
				@component('components.componente_menu_lista')
		    	@endcomponent
				<li><a href="/login">LOGIN</a></li>
				<li><a href="/register">CADASTRE-SE</a></li>
				@endauth
			@endauth
		@endauth
	</ul>
</nav>