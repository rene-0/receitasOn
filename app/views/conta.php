<html>
	<head>
		<?php include_once("../app/views/include_head.php");?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/main.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/nav.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/footer.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/conta.css'>
		<script src='<?php echo App\Core\Router::getBaseUrl(); ?>js/conta.js'></script>
		<title>Conta</title>
	</head>
	<body>
		<?php include_once('../app/views/nav.php');?>
		<div class='wrapper'>
			<div class='conta'>
				<h1>Conta</h1>
				<div class='descricao'>
					<div>
						<img src='<?php echo App\Core\Router::getBaseUrl(); ?>img/main/user.png'>
					</div>
					<div>
						<h2><?php echo $ret->nome;?></h2>
						<h5><?php echo $ret->email;?></h5>
						<p><?php echo $ret->nascimento;?></p>
					</div>
					<div class='acoes'>
						<a href='<?php echo App\Core\Router::getBaseUrl(); ?>logout'>Logout</a>
					</div>
				</div>
			</div>
			<div class='envios'>
				<h1>Envios</h1>
				<div class='container'>
					<div class='header'>
						<div class='item imagem'>Imagem</div>
						<div class='item nome'>Nome da receita</div>
						<div class='item status'>Status</div>
						<div class='item data'>Data de criação</div>
						<div class='item acao'>Ações</div>
					</div>
					<div class='corpo'>
						<?php
							if(count($receitas) > 0)
							{
								foreach($receitas as $dados)
								{
									echo "<div id='{$dados->id_receita}' class='receita'>";
										echo "<div class='item imagem'>";
											echo "<img src='{$dados->caminho}'>";
										echo "</div>";
										echo "<div class='item nome'>";
											echo "<h2>{$dados->titulo}</h2>";
										echo "</div>";
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
										echo "<div class='item data'>";
											echo "<p>{$dados->data_criacao}</p>";
										echo "</div>";
										echo "<div class='item acao'>";
											echo "<div class='botoes'>";
												echo "<a class='edit' href='".App\Core\Router::getBaseUrl()."alterar_envio/index/{$dados->id_receita}'><i class='fas fa-edit' aria-hidden='true'></i></a>";
												echo "<a class='eye' href='".App\Core\Router::getBaseUrl()."visualizar/index/{$dados->id_receita}'><i class='fas fa-eye' aria-hidden='true'></i></a>";
												echo "<a class='trash' onclick=\"openModal({$dados->id_receita},'Confirmar a remoção do envio {$dados->titulo}')\"><i class='fas fa-trash' aria-hidden='true'></i></a>";
											echo "</div>";
										echo "</div>";
									echo "</div>";
								}
							}
							else
							{
								echo "<div>Nenhuma receita criada</div>";
							}
						?>
						<div class='botoes'>
							<a class='adicionar' href='<?php echo App\Core\Router::getBaseUrl(); ?>enviar'><i class="fas fa-plus"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div><!-- Wrapper -->
		<div id='toast' class='toast'></div>
		<div id='modal' class="modal-container">
			<div class='modal'>
				<div class='head'>
					<i id='icon'><i class='fas fa-trash'></i></i>
					<h3 id='modal-title'></h3>
				</div>
				<small id='sub'>Essa ação não pode ser desfeita.<br>Caso esse evnio tenha sido aceito, remove-lo não remove a receita aceita.</small>
				<div class='buttons'>
					<button id='nao' type='button'>Cancelar</button>
					<button id='sim' type='button'>Confirmar</button>
				</div>
			</div>
		</div>
		<?php include_once('../app/views/footer.php');?>
	</body>
</html>