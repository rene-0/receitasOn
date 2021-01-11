<!DOCTYPE html>
<html>
	<head>
		<?php include_once('../app/views/sysadm/include_head.php'); ?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>vendor/simditor/styles/simditor.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/main.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/sysadm/incluir_receita.min.css'>
		<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
		<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
		<script src="<?php echo App\Core\Router::getBaseUrl(); ?>js/main.js"></script>
		<script src="<?php echo App\Core\Router::getBaseUrl(); ?>js/sysadm/incluir_receita.min.js"></script>
		<title>Sysadm - Incluir Receita</title>
		<?php if(isset($erro)){ echo "<script>$(document).ready(function(){showToast(\"{$erro}\")})</script>";}//Se tiver erro pego pelo catch?>
	</head>
	<body>
		<?php include_once('../app/views/sysadm/nav.php'); ?>
		<main class='wrapper'>
			<form id='form' action='' method='POST' enctype="multipart/form-data">
				<div class='header'>
					<div class='campo'>
						<span>Titulo:</span>
						<input id='titulo' type='text' name='titulo' placeholder='Titulo da receita'>
						<small></small>
					</div>
					<div class='campo'>
						<span>Tempo de preparo:</span>
						<input id='preparo' type='text' name='tempo_preparo' placeholder='Tempo de preparo'>
						<small></small>
					</div>
					<div class='campo'>
						<span>Rendimento:</span>
						<input id='rendimento' type='text' name='rendimento' placeholder='Rendimento'>
						<small></small>
					</div>
				</div>
				<div class='body'>
					<div class='campo fotos'>
						<span>Fotos:</span>
						<div id='fotos'>
							<div class='foto'>
								<div class='imagem'>
									
								</div>
								<div class='input'>
									<input onchange='imageDemo(this)' type='file' name='fotos[]'>
								</div>
							</div>
						</div>
						<small></small>
					</div>
					<div class='campo ingredientes'>
						<span>Ingredientes:</span>
						<div id='ingredientes-container'>
							<div class='ingrediente'>
								<input type='text' name='ingrediente[]'>
							</div>
							<div class='ingrediente'>
								<input type='text' name='ingrediente[]'>
								<button onclick='deletarItem(this)' type='button'><i class="fas fa-times"></i></button>
							</div>
						</div>
						<small></small>
						<button id='add-ingredientes' class='add' type='button'><i class="fas fa-plus"></i></button>
					</div>
					<div class='campo md-preparo'>
						<span>Modo de preparo:</span>
						<div id='preparo-container'>
							<div class='preparo'>
								<div class='item'>1</div>
								<input type='text' name='preparo[]'>
							</div>
							<div class='preparo'>
								<div class='item'>2</div>
								<input type='text' name='preparo[]'>
								<button onclick='deletarItem(this)' type='button'><i class="fas fa-times"></i></button>
							</div>
						</div>
						<small></small>
						<button id='add-preparo' class='add' type='button'><i class="fas fa-plus"></i></button>
					</div>
					<div class='campo adicional'>
						<span>Informações adicionais:</span>
						<div id="editor"></div>
						<textarea name='adicionais' style='display: none;' id='desc'></textarea>
					</div>
					<div class='botoes'>
						<button type='reset' class='bt deletar'>Deletar</button>
						<button type='submit' name='input' class='bt confirmar'>Confirmar</button>
					</div>
				</div>
			</form>
		</main>
		<div id='toast'></div>
	</body>
</html>