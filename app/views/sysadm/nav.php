<nav>
	<div class='nav-container'>
		<!--<h1>receitasOn</h1>-->
		<ul>
			<li>
				<a target='_blanck' href='<?php echo App\Core\Router::getBaseUrl(); ?>' title='Receitas On'>R</a>
			</li>
			<li>
				<a title='Home' href='<?php echo App\Core\Router::getBaseUrl(); ?>sysadm/home'>
					<i class="fas fa-home"></i>
					<small>Home</small>
				</a>
			</li>
			<li>
				<a title='Incluir receita' href='<?php echo App\Core\Router::getBaseUrl(); ?>sysadm/incluir_receita'>
					<i class="fas fa-plus-circle"></i>
					<small>Incluir receita</small>
				</a>
			</li>
			<li>
				<a title='Listar Receitas' href='<?php echo App\Core\Router::getBaseUrl(); ?>sysadm/listar_receitas'>
					<i class="fas fa-stream"></i>
					<small>Listar receitas</small>
				</a>
			</li>
			<li>
				<a title='Listar Envios' href='<?php echo App\Core\Router::getBaseUrl(); ?>sysadm/listar_envios'>
					<i class="fas fa-th-list"></i>
					<small>Listar envios</small>
				</a>
			</li>
			<li>
				<a title='Logout' href='<?php echo App\Core\Router::getBaseUrl(); ?>sysadm/logout'>
					<i class="fas fa-sign-out-alt"></i>
					<small>Logout</small>
				</a>
			</li>
		</ul>
	</div>
	<button class='open-mobile-nav-button'><i class="fas fa-bars"></i></button>
	<div class='mobile-cortina'>
		<button class='close-mobile-nav-button'><i class="fas fa-times"></i></button>
		<div class='mobile nav-container'>
			<!--<h1>receitasOn</h1>-->
			<ul>
				<li>
					<a target='_blanck' href='<?php echo App\Core\Router::getBaseUrl(); ?>' title='Receitas On'>R</a>
				</li>
				<li>
					<a title='Home' href='<?php echo App\Core\Router::getBaseUrl(); ?>sysadm/home'>
						<i class="fas fa-home"></i>
						<small>Home</small>
					</a>
				</li>
				<li>
					<a title='Incluir receita' href='<?php echo App\Core\Router::getBaseUrl(); ?>sysadm/incluir_receita'>
						<i class="fas fa-plus-circle"></i>
						<small>Incluir receita</small>
					</a>
				</li>
				<li>
					<a title='Listar Receitas' href='<?php echo App\Core\Router::getBaseUrl(); ?>sysadm/listar_receitas'>
						<i class="fas fa-stream"></i>
						<small>Listar receitas</small>
					</a>
				</li>
				<li>
					<a title='Listar Envios' href='<?php echo App\Core\Router::getBaseUrl(); ?>sysadm/listar_envios'>
						<i class="fas fa-th-list"></i>
						<small>Listar envios</small>
					</a>
				</li>
				<li>
					<a title='Logout' href='<?php echo App\Core\Router::getBaseUrl(); ?>sysadm/logout'>
						<i class="fas fa-sign-out-alt"></i>
						<small>Logout</small>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>