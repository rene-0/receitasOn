<html>
	<head>
		<?php include_once('../app/views/include_head.php');?>
		<link rel="stylesheet" type="text/css" href="<?php echo App\Core\Router::getBaseUrl(); ?>vendor/slick/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo App\Core\Router::getBaseUrl(); ?>vendor/slick/slick/slick-theme.css"/>
		<script type="text/javascript" src="<?php echo App\Core\Router::getBaseUrl(); ?>vendor/slick/slick/slick.min.js"></script>
		<script src='<?php echo App\Core\Router::getBaseUrl(); ?>js/main.js'></script>
		<script src='<?php echo App\Core\Router::getBaseUrl(); ?>js/visualizar.js'></script>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/receita.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/visualizar.css'>
		<title>Receita - <?php echo $ret->titulo; ?></title>
	</head>
	<body>
		<?php include_once('../app/views/nav.php');?>
		<div class='wrapper'>
			<main class='receita'>
				<div class='main-header'>
					<h1>Pré-visualizar: <?php echo $ret->titulo; ?></h1>
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
									echo "<span><mark class='blue'>{$ret->nome}</mark></span>";
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
					<?php
						if(!empty($ret->adicionais))
						{
					?>
						<div class='re-campo adicional'>
							<div class='re-header header'>
								<h3>Informações adicionais</h3>
							</div>
							<div class='corpo'>
								<?php echo $ret->adicionais; ?>
							</div>
						</div>
					<?php
						}
					?>
				</div>
			</main>
		</div><!-- Wrapper -->
		<?php include_once('../app/views/footer.php');?>
	</body>
</html>