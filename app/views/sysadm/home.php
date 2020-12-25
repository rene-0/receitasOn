<html>
	<head>
		<?php include_once('../app/views/sysadm/include_head.php'); ?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/sysadm/home.css'>
		<script type="text/javascript" src="<?php echo App\Core\Router::getBaseUrl(); ?>js/sysadm/home.js"></script>
		<title>Sysadm - Home</title>
	</head>
	<body>
		<?php include_once('../app/views/sysadm/nav.php'); ?>
		<main class='wrapper'>
			<div class='bem-vindo'>
				<h1>Bem vindo de volta <?php echo $_SESSION['adm']['nome'];?></h1>
			</div>
			<div class='ultima-receita'>
				<h2>Esta é a última receita enviada <div id='full-toggle'><i class='fas fa-expand'></i><i class='fas fa-compress'></i></div></h2>
				<!--<iframe src='<?php echo App\Core\Router::getBaseUrl()."visualizar/index/{$ret->id_receita}"; ?>'></iframe>-->
				<div class='receita-container'>
					<main class='receita'>
						<div class='main-header'>
							<h1><?php echo $ret->titulo; ?></h1>
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
				</div>
			</div>
			<div class='ultimos-usuarios'>
				<h2>Últimos usuários</h2>
				<?php //var_dump($usuario)?>
				<div class='usuarios'>
					<div class='header'>
						<div class='item nome'>Nome</div>
						<div class='item email'>E-mail</div>
						<div class='item criado'>Data criação</div>
						<div class='item tentativas'>Tentativas</div>
					</div>
					<div class='body'>
						<?php
							foreach($usuario as $dados)
							{
								echo "<div class='usuario'>";
									echo "<div class='item nome'>{$dados->nome}</div>";
									echo "<div class='item email'>{$dados->email}</div>";
									echo "<div class='item criado'>{$dados->nascimento}</div>";
									echo "<div class='item tentativas'>{$dados->tentativas}</div>";
								echo "</div>";
							}
						?>
					</div>
				</div>
			</div>
		</main>
	</body>
</html>