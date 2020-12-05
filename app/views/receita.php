<html>
	<head>
		<?php include_once('../app/views/include_head.php');?>
		<link rel="stylesheet" type="text/css" href="<?php echo App\Core\Router::getBaseUrl(); ?>vendor/slick/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo App\Core\Router::getBaseUrl(); ?>vendor/slick/slick/slick-theme.css"/>
		<script type="text/javascript" src="<?php echo App\Core\Router::getBaseUrl(); ?>vendor/slick/slick/slick.min.js"></script>
		<script src='<?php echo App\Core\Router::getBaseUrl(); ?>js/main.js'></script>
		<script src='<?php echo App\Core\Router::getBaseUrl(); ?>js/receita.js'></script>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/tooltip.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/receita.css'>
		<title>Receita - <?php echo $ret->titulo; ?></title>
	</head>
	<body>
		<?php include_once('../app/views/nav.php');?>
		<div class='wrapper'>
			<main class='receita'>
				<div class='main-header'>
					<h1><?php echo $ret->titulo; ?></h1>
					<span class='stars'>
						<div id='stars' class='stars-container'>
							<span class='ativos' style='width:<?php echo $ret->estrelas;?>%'>
								<i class='fa fa-star' aria-hidden='true'></i>
								<i class='fa fa-star' aria-hidden='true'></i>
								<i class='fa fa-star' aria-hidden='true'></i>
								<i class='fa fa-star' aria-hidden='true'></i>
								<i class='fa fa-star' aria-hidden='true'></i>
							</span>
							<span class='inativos'>
								<i class='fa fa-star-o' aria-hidden='true'></i>
								<i class='fa fa-star-o' aria-hidden='true'></i>
								<i class='fa fa-star-o' aria-hidden='true'></i>
								<i class='fa fa-star-o' aria-hidden='true'></i>
								<i class='fa fa-star-o' aria-hidden='true'></i>
							</span>
						</div>
					</span>
					<div id='tooltip' class="tooltip">
						<p class="texto">Clique aqui para avaliar</p>
					</div>
				</div>
				<div class='container'>
					<div class='carousel'>
						<?php
							foreach($fotos as $dados)
							{
								echo "<div class='item'><img src='{$dados->caminho}'></div>";
							}
						?>
					</div>
					<div class='principal'>
						<div  class='item'>
							<div>
								<img src='<?php echo App\Core\Router::getBaseUrl(); ?>img/main/user.png' alt='Icone do usuário'>
							</div>
							<div>
								<p>Enviado por:</p>
								<?php
									if($ret->nome_user != null)
									{
										echo "<span><mark class='blue'>{$ret->nome_user}</mark></span>";
									}
									else
									{
										echo "<span><mark>{$ret->nome_adm}</mark></span>";
									}
								?>
							</div>
						</div>
						<div  class='item'>
							<div>
								<i class="fab fa-algolia"></i>
							</div>
							<div>
								<p>Tempo de preparo</p>
								<mark><?php echo $ret->temp_preparo;?></mark>
							</div>
						</div>
						<div  class='item'>
							<div>
								<i class="fas fa-drumstick-bite"></i>
							</div>
							<div>
								<p>Rendimento</p>
								<mark><?php echo $ret->rendimento;?></mark>
							</div>
						</div>
						<div  class='item'>
							<div>
								<i class="fas fa-calendar-alt"></i>
							</div>
							<div>
								<p>Data de envio</p>
								<mark><?php echo $ret->data_criacao;?></mark>
							</div>
						</div>
					</div>
					<div class='re-campo ingredientes'>
						<div class='re-header header'>
							<h3>Ingredientes</h3>
						</div>
						<ul class='re-list'>
							<?php
								foreach($ingre as $dados)
								{
									echo "<li>{$dados->ingrediente}</li>";
								}
							?>
						</ul>
					</div>
					<div class='re-campo preparo'>
						<div class='re-header header'>
							<h3>Modo de preparo</h3>
						</div>
						<ul class='re-list'>
							<?php
								foreach($preparo as $dados)
								{
									echo "<li>{$dados->preparo}</li>";
								}
							?>
						</ul>
					</div>
					<?php if(!empty($ret->adicionais)){ ?>
					<div class='re-campo adicional'>
						<div class='re-header header'>
							<h3>Informações adicionais</h3>
						</div>
						<div class='corpo'>
							<?php echo $ret->adicionais; ?>
						</div>
					</div>
					<?php }?>
				</div>
			</main>
			<div class='comentarios'>
				<div class='re-header header'>
					<h3>Comentários</h3>
				</div>
				<div id='comentar' class='comentar'>
					<form method='POST' id='form' action='<?php echo App\Core\Router::getBaseUrl().'receita/comentar/'.$ret->id_receita;?>'>
						<!-- <div class='texto'> -->
							<?php
								if(isset($_SESSION['usuario']['id_usuario']))
								{
									echo "<textarea name='comentario' placeholder='Escreva seu comentário'></textarea>";
									echo "<button type='submit'>Enviar</button>";
								}
								else
								{
									echo "<textarea disabled name='comentario' placeholder='Para comentar faça login!'></textarea>";
									echo "<button disabled class='disabled' titulo='Para comentar faça login!' type='button'>Enviar</button>";
								}
							?>
						<!-- </div> -->
					</form>
					<div class='comentarios-container'>
						<div id='loader' class='loader'>
							<img src='<?php echo App\Core\Router::getBaseUrl();?>img/main/loader.gif'>
						</div>
						<?php
							if(!empty($coments))
							{
								echo "<ul>";
									foreach($coments as $dados)
									{
										echo "<li>";
											echo "<div class='img'>";
												echo "<img src='".App\Core\Router::getBaseUrl()."img/main/user.png' alt='Icone de usuário'>";
												echo "<div class='header'>";
													echo "<mark>{$dados->nome}</mark>";
													echo "<p>{$dados->data}</p>";
												echo "</div>";
											echo "</div>";
											echo "<div class='text'>";
												echo "<p>".htmlspecialchars($dados->comentario)."</p>";
											echo "</div>";
										echo "</li>";
									}
								echo "</ul>";
							}
							else
							{
								echo "<ul>";
									echo "<div id='disabled' class='disabled'>Nenhum comentario, seja o primeiro a comentar!</div>";
								echo "</ul>";
							}
						?>
					</div>
				</div>
			</div>
			<div class='mais'>
				<div class='re-header header'>
					<h3>Últimos</h3>
				</div>
				<div class='receitas'>
					<?php
						foreach($ultimos as $dados)
						{
							echo "<a href='".App\Core\Router::getBaseUrl()."receita/index/{$dados->id_receita}' class='receita'>";
								echo "<div class='imagem'>";
									echo "<img src='{$dados->caminho}'>";
								echo "</div>";
								echo "<div class='text'>";
									echo "<h5>{$dados->titulo}</h5>";
									echo "<span class='stars'>";
										echo "<div class='stars-container'>";
											echo "<span class='ativos' style='width:".$dados->estrelas."%'>";
												echo "<i class='fa fa-star' aria-hidden='true'></i>";
												echo "<i class='fa fa-star' aria-hidden='true'></i>";
												echo "<i class='fa fa-star' aria-hidden='true'></i>";
												echo "<i class='fa fa-star' aria-hidden='true'></i>";
												echo "<i class='fa fa-star' aria-hidden='true'></i>";
											echo "</span>";
											echo "<span class='inativos'>";
												echo "<i class='fa fa-star-o' aria-hidden='true'></i>";
												echo "<i class='fa fa-star-o' aria-hidden='true'></i>";
												echo "<i class='fa fa-star-o' aria-hidden='true'></i>";
												echo "<i class='fa fa-star-o' aria-hidden='true'></i>";
												echo "<i class='fa fa-star-o' aria-hidden='true'></i>";
											echo "</span>";
										echo "</div>";
									echo "</span>";
									echo "<div class='footer'>";
										if($dados->nome_user != null)
										{
											echo "<span><mark>{$dados->nome_user}</mark></span>";
										}
										else
										{
											echo "<span><mark>{$dados->nome_adm}</mark></span>";
										}
										echo "<span>{$dados->data_criacao}</span>";
									echo "</div>";
								echo "</div>";
							echo "</a>";
						}
					?>
				</div>
			</div>
		</div><!-- Wrapper -->
		<div id='stars-modal' class='stars-modal-container'>
			<div class='stars-modal'>
				<div class='header'>
					<h3>Avalie essa receita</h3>
					<i id='hide' class="fas fa-times"></i>
				</div>
				<div class='body'>
					<span class='stars'>
						<div id='form-stars' class='stars-container'>
							<span id='star-ativo' style='width: <?php if(isset($rating) && $rating != false){echo ($rating->star*20);}else{echo '0';} ?>%' class='ativos'>
								<i class='fa fa-star' aria-hidden='true'></i>
								<i class='fa fa-star' aria-hidden='true'></i>
								<i class='fa fa-star' aria-hidden='true'></i>
								<i class='fa fa-star' aria-hidden='true'></i>
								<i class='fa fa-star' aria-hidden='true'></i>
							</span>
							<span class='inativos'>
								<i class='fa fa-star-o' aria-hidden='true'></i>
								<i class='fa fa-star-o' aria-hidden='true'></i>
								<i class='fa fa-star-o' aria-hidden='true'></i>
								<i class='fa fa-star-o' aria-hidden='true'></i>
								<i class='fa fa-star-o' aria-hidden='true'></i>
							</span>
						</div>
					</span>
					<form id='form-star' action='<?php echo App\Core\Router::getBaseUrl().'receita/avaliar/'.$ret->id_receita;?>' method='POST'>
						<input type='range' value='<?php if(isset($rating) && $rating != false){echo ($rating->star*20);}else{ echo '0';}?>' min='0' max='100' name='star'>
						<div class='buttons'>
							<!-- <input type='reset' value="Redefinir"> -->
							<input name='submit' type='submit' value="Enviar">
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php include_once('../app/views/footer.php');?>
	</body>
</html>