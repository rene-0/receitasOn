<html>
	<head>
		<?php include_once('../app/views/sysadm/include_head.php'); ?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>vendor/simditor/styles/simditor.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/main.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/sysadm/incluir_receita.css'>
		<!--<link href="<?php echo App\Core\Router::getBaseUrl(); ?>vendor/quill/quill.snow.css" rel="stylesheet">
		<script src="<?php echo App\Core\Router::getBaseUrl(); ?>vendor/quill/quill.js"></script>-->
		<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
		<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
		<script src="<?php echo App\Core\Router::getBaseUrl(); ?>js/main.js"></script>
		<script src="<?php echo App\Core\Router::getBaseUrl(); ?>js/sysadm/alterar_receita.js"></script>
		<title>Sysadm - Incluir Receita</title>
		<?php if(isset($erro)){ echo "<script>$(document).ready(function(){showToast('{$erro}')})</script>";}//Se tiver erro pego pelo catch?>
	</head>
	<body>
		<?php include_once('../app/views/sysadm/nav.php'); ?>
		<main class='wrapper'>
			<form id='form' action='' method='POST' enctype="multipart/form-data">
				<div class='header'>
					<div class='campo'>
						<span>Titulo:</span>
						<input id='titulo' value='<?php if(isset($receita)){ echo $receita->getTitulo();}?>' type='text' name='titulo' placeholder='Titulo da receita'>
						<small></small>
					</div>
					<div class='campo'>
						<span>Tempo de preparo:</span>
						<input value='<?php if(isset($receita)){ echo $receita->getTempo_preparo();}?>' id='preparo' type='text' name='tempo_preparo' placeholder='Tempo de preparo'>
						<small></small>
					</div>
					<div class='campo'>
						<span>Rendimento:</span>
						<input value='<?php if(isset($receita)){ echo $receita->getRendimento();}?>' id='rendimento' type='text' name='rendimento' placeholder='Rendimento'>
						<small></small>
					</div>
				</div>
				<div class='body'>
					<div class='campo fotos'>
						<span>Fotos:</span>
						<div id='fotos'>
							<?php
								foreach($receita->getFotos() as $key => $dados)
								{
									echo "<div id='ft".$dados->getId_foto()."' class='foto'>";
										echo "<div class='imagem'><img src='{$dados->getCaminho()}'></div>";
										echo "<div class='input'>";
											echo $dados->getNome();
										echo "</div>";
										echo "<i class='fas fa-times' onclick=\"openModal('Confirmar a remoção da foto: ".$dados->getNome()."',".$dados->getId_receita().",".$dados->getId_foto().")\" aria-hidden='true'></i>";
									echo "</div>";
								}
							?>
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
							<?php
								foreach($receita->getIngredientes() as $key => $dados)
								{
									echo "<div class='ingrediente'>";
										echo "<input type='text' value='{$dados->getIngrediente()}' name='ingrediente[]'>";
										if($key != 0)
										{
											echo "<button onclick='deletarItem(this)' type='button'><i class='fas 	fa-times'></i></button>";
										}
									echo "</div>";
								}
							?>
						</div>
						<small></small>
						<button id='add-ingredientes' class='add' type='button'><i class="fas fa-plus"></i></button>
					</div>
					<div class='campo md-preparo'>
						<span>Modo de preparo:</span>
						<div id='preparo-container'>
							<?php
								foreach($receita->getPreparos() as $key => $dados)
								{
									echo "<div class='preparo'>";
										echo "<div class='item'>".($key+1)."</div>";
										echo "<input type='text' value='{$dados->getPreparo()}' name='preparo[]'>";
										if($key != 0)
										{
											echo "<button onclick='deletarItem(this)' type='button'><i class='fas 	fa-times'></i></button>";
										}
									echo "</div>";
								}
							?>
						</div>
						<small></small>
						<button id='add-preparo' class='add' type='button'><i class="fas fa-plus"></i></button>
					</div>
					<div class='campo adicional'>
						<span>Informações adicionais:</span>
						<div id="editor"><?php if(isset($receita)){ echo $receita->getAdicionais();}?></div>
						<textarea name='adicionais' style='display: none;' id='desc'></textarea>
					</div>
					<div class='botoes'>
						<button type='reset' class='bt deletar'>Deletar</button>
						<button type='submit' name='input' class='bt confirmar'>Confirmar</button>
					</div>
				</div>
			</form>
		</main>
		<div id='toast' class='toast'></div>
		<div id='modal' class="modal-container">
			<div class='modal'>
				<div class='head'>
					<i class="fas fa-trash"></i>
					<h3 id='modal-title'></h3>
				</div>
				<small>Ao confirmar a foto será removida independentemente se o formulário for enviado ou não.<br>Essa alteração não pode ser desfeita</small>
				<div class='buttons'>
					<button id='nao' type='button'>Cancelar</button>
					<button id='sim' type='button'>Confirmar</button>
				</div>
			</div>
		</div>
		<?php //include_once('../app/views/sysadm/footer.php'); ?>
	</body>
</html>