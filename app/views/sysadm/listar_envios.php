<html>
	<head>
		<?php include_once('../app/views/sysadm/include_head.php'); ?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/sysadm/listar_envios.css'>
		<script src='<?php echo App\Core\Router::getBaseUrl(); ?>js/sysadm/main.js'></script>
		<script src='<?php echo App\Core\Router::getBaseUrl(); ?>js/sysadm/listar_envios.js'></script>
		<title>Sysadm - Listar Envios</title>
	</head>
	<body>
		<?php include_once('../app/views/sysadm/nav.php'); //var_dump($ret); ?>
		<main class='wrapper'>
			<form class='search' action='' method="GET">
				<div>
					<span>Titulo</span>
					<input  <?php if(isset($_GET['titulo']) && !empty($_GET['titulo'])){ echo "value='{$_GET['titulo']}'";}?> type='text' name='titulo'>
				</div>
				<div>
					<span>Data</span>
					<input <?php if(isset($_GET['data']) && !empty($_GET['data'])){ echo "value='{$_GET['titulo']}'";}?> type='date' name='data'>
				</div>
				<div>
					<span>Criador</span>
					<input <?php if(isset($_GET['criador']) && !empty($_GET['criador'])){ echo "value='{$_GET['criador']}'";}?> type='text' name='criador'>
				</div>
				<div>
					<input type='submit'>
				</div>
			</form>
			<div class='receitas'>
				<div class='header'>
					<div class='item numero'>
						<span>N°</span>
					</div>
					<div class='item criador'>
						<span>Criador</span>
					</div>
					<div class='item titulo'>
						<span>Titulo</span>
					</div>
					<div class='item status'>
						<span>Status</span>
					</div>
					<div class='item data'>
						<span>Data</span>
					</div>
					<div class='item acoes'>
						<span>Ação</span>
					</div>
				</div>
				<div class='campo body'>
					<?php
						foreach($ret as $dados)
						{
							echo "<div id='{$dados->id_ureceita}' class='receita'>";
								echo "<div class='item numero'>{$dados->id_ureceita}</div>";
								echo "<div class='item criador'>";
									echo "<a class='usuario' href='".App\Core\Router::getBaseUrl()."sysadm/listar_envios?criador={$dados->nome}'>{$dados->nome}</a>";
								echo"</div>";
								echo "<div id='titulo-{$dados->id_ureceita}' class='item titulo'>{$dados->titulo}</div>";
								echo "<div class='item status'>";
									if($dados->status === "ANÁLIZE")
									{
										echo "<div class='analize'>{$dados->status}</div>";
									}
									elseif($dados->status === "ACEITO")
									{
										echo "<div class='aceito'>{$dados->status}</div>";
									}
									elseif($dados->status === "RECUSADO")
									{
										echo "<div class='recusado'>{$dados->status}</div>";
									}
									elseif($dados->status === "REMOVIDO")
									{
										echo "<div class='removido'>{$dados->status}</div>";
									}
								echo "</div>";
								echo "<div class='item data'>{$dados->data_criacao}</div>";
								echo "<div class='item acoes'>";
									echo "<div class='botoes'>";
									if($dados->status === "ANÁLIZE")
									{
										echo "<a class='check' href='#' onclick=\"openModal('fas fa-check','Aceitar a receita: {$dados->titulo} ?','aceitar',{$dados->id_ureceita})\" ><i class='fas fa-check'></i></a>";
										echo "<a class='eye' target='_blanck' href='".App\Core\Router::getBaseUrl()."visualizar/index/{$dados->id_ureceita}'><i class='fas fa-eye'></i></a>";
										echo "<a class='times' href='#' onclick=\"openModal('fas fa-times','Recusar a receita: {$dados->titulo} ?','recusar',{$dados->id_ureceita})\" ><i class='fas fa-times'></i></a>";
									}
									elseif($dados->status === "RECUSADO")
									{
										echo "<a href='#' class='trash'><i onclick='openModal(\"fas fa-trash\",\"Remover a receita: {$dados->titulo}?\",\"remover\",{$dados->id_ureceita})' class='fas fa-trash'></i></a>";
										echo "<a class='eye' target='_blanck' href='".App\Core\Router::getBaseUrl()."visualizar/index/{$dados->id_ureceita}'><i class='fas fa-eye'></i></a>";
									}
									elseif($dados->status === "ACEITO")
									{
										echo "<a class='trash' href='#'><i onclick='openModal(\"fas fa-trash\",\"Remover a receita: {$dados->titulo}?\",\"remover\",{$dados->id_ureceita})' class='fas fa-trash'></i></a>";
										echo "<a class='eye' target='_blanck' href='".App\Core\Router::getBaseUrl()."receita/index/{$dados->id_receita}'><i class='fas fa-eye'></i></a>";
									}
									echo "</div>";
								echo "</div>";
							echo "</div>";
						}
					?>
				</div>
			</div>
			<div class='pages'>
				<?php
					for($i = 1;$i <= ceil($paginas->paginas/$per_page); $i++)
					{
						if($i == ($page+1))
						{
							echo "<a id='ativo' href='{$base}sysadm/listar_envios/index/{$i}{$get_url}'>{$i}</a>";
						}
						else
						{
							echo "<a href='{$base}sysadm/listar_envios/index/{$i}{$get_url}''>{$i}</a>";
						}
					}
				?>
			</div>
		</main>
		<div id='toast' class='toast'></div>
		<div id='modal' class="modal-container">
			<div class='modal'>
				<div class='head'>
					<i id='icon'></i>
					<h3 id='modal-title'></h3>
				</div>
				<small id='sub'></small>
				<div class='buttons'>
					<button id='nao' type='button'>Cancelar</button>
					<button id='sim' type='button'>Confirmar</button>
				</div>
			</div>
		</div>
	</body>
</html>