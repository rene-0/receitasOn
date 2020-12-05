<nav>
	<div class='logo'><a href='<?php echo App\Core\Router::getBaseUrl(); ?>home'>receitasOn</a></div>
	<ul>
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
</nav>