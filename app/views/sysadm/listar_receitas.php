<html>
	<head>
		<?php include_once('../app/views/sysadm/include_head.php'); ?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/sysadm/listar_receitas.min.css'>
		<script src='<?php echo App\Core\Router::getBaseUrl(); ?>js/sysadm/main.js'></script>
		<script src='<?php echo App\Core\Router::getBaseUrl(); ?>js/sysadm/listar_receita.min.js'></script>
		<title>Sysadm - Listar Receitas</title>
	</head>
	<body>
		<?php include_once('../app/views/sysadm/nav.php'); ?>
		<main class='wrapper'>
			<form class='search' action='' method="GET">
				<div>
					<span>Titulo</span>
					<input  <?php if(isset($_GET['titulo']) && !empty($_GET['titulo'])){ echo "value='{$_GET['titulo']}'";}?> type='text' name='titulo'>
				</div>
				<div>
					<span>Data</span>
					<input <?php if(isset($_GET['data']) && !empty($_GET['data'])){ echo "value='{$_GET['data']}'";}?> type='date' name='data'>
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
							echo "<div id='{$dados->id_receita}' class='receita'>";
								echo "<div class='item numero'>{$dados->id_receita}</div>";
								echo "<div class='item criador'>";
									if($dados->nome_adm != null)
									{
										echo "<a class='adm' href='".App\Core\Router::getBaseUrl()."sysadm/listar_receitas?criador={$dados->nome_adm}'>{$dados->nome_adm}</a> ";
									}
									if($dados->nome_user != null)
									{
										echo "<a class='usuario' href='".App\Core\Router::getBaseUrl()."sysadm/listar_receitas?criador={$dados->nome_user}'>{$dados->nome_user}</a>";
									}
								echo"</div>";
								
								echo "<div id='titulo-{$dados->id_receita}' class='item titulo'>{$dados->titulo}</div>";
								echo "<div class='item data'>{$dados->data_criacao}</div>";
								echo "<div class='item acoes'>";
									echo "<div class='botoes'>";
										echo "<a class='eye' target='_blanck' href='".App\Core\Router::getBaseUrl()."receita/index/{$dados->id_receita}'><i class='fas fa-eye'></i></a>";
										echo "<a class='edit' href='".App\Core\Router::getBaseUrl()."sysadm/alterar_receita/index/{$dados->id_receita}'><i class='fas fa-edit'></i></a>";
										echo "<a class='trash' href='#' onclick='openModal({$dados->id_receita})' href=''><i class='fas fa-trash'></i></a>";
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
							echo "<a id='ativo' href='{$base}sysadm/listar_receitas/index/{$i}{$get_url}'>{$i}</a>";
						}
						else
						{
							echo "<a href='{$base}sysadm/listar_receitas/index/{$i}{$get_url}''>{$i}</a>";
						}
					}
				?>
			</div>
		</main>
		<div id='toast' class='toast'></div>
		<div id='modal' class="modal-container">
			<div class='modal'>
				<div class='head'>
					<i class="fas fa-trash"></i>
					<h3 id='modal-titulo'></h3>
				</div>
				<small>Essa alteração não pode ser desfeita</small>
				<div class='buttons'>
					<button id='nao' type='button'>Cancelar</button>
					<button id='sim' type='button'>Confirmar</button>
				</div>
			</div>
		</div>
		<?php //include_once('../app/views/sysadm/footer.php'); ?>
	</body>
</html>