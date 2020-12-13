<nav>
	<div class='logo'><a href='<?php echo App\Core\Router::getBaseUrl(); ?>home'>receitasOn</a></div>
	<ul class='nav-desk'>
		<li><a href='<?php echo App\Core\Router::getBaseUrl(); ?>home'>Home</a></li>
		<li><a href='<?php echo App\Core\Router::getBaseUrl(); ?>receitas'>Receitas</a></li>
		<li><a href='<?php echo App\Core\Router::getBaseUrl(); ?>sobre'>Sobre</a></li>
		<?php
			if(isset($_SESSION['usuario']['id_usuario']))
			{
				echo "<li><a href='".App\Core\Router::getBaseUrl()."conta'>Conta</a></li>";
			}
			else
			{
				echo "<li><a href='".App\Core\Router::getBaseUrl()."login'>Entrar</a></li>";
			}
		?>
	</ul>
	<button id='btn-mobile' class='btn-mobile' type='button'><i class="fas fa-bars"></i></button>
	<div id='nav-cortina' class='nav-cortina'>
		<ul class='nav-mobile'>
			<li><button id='mobile-close'><i class="fas fa-times"></i></button></li>
			<li><a href='<?php echo App\Core\Router::getBaseUrl(); ?>home'>Home</a></li>
			<li><a href='<?php echo App\Core\Router::getBaseUrl(); ?>receitas'>Receitas</a></li>
			<li><a href='<?php echo App\Core\Router::getBaseUrl(); ?>sobre'>Sobre</a></li>
			<?php
				if(isset($_SESSION['usuario']['id_usuario']))
				{
					echo "<li><a href='".App\Core\Router::getBaseUrl()."conta'>Conta</a></li>";
				}
				else
				{
					echo "<li><a href='".App\Core\Router::getBaseUrl()."login'>Entrar</a></li>";
				}
			?>
		</ul>
	</div>
</nav>