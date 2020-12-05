<html>
	<head>
		<?php include_once('../app/views/include_head.php');?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/main.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/home.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/error404.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/nav.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/footer.css'>
		<title>Receitas</title>
	</head>
	<body>
		<?php include_once('../app/views/nav.php');?>
		<div class='wrapper'>
			<div class='error'>
				<div class='header'>
					<h1>Erro - Algo inesperado aconteceu!</h1>
				</div>
				<div class='body'>
					<h2>O servidor não conseguiu processar sua requisição.</h2>
					<p>Deseja voltar a página inicial?</p>
					<a href='<?php echo App\Core\Router::getBaseUrl(); ?>home'>Volar</a>
				</div>
			</div>
		</div>
		<?php include_once('../app/views/footer.php');?>
	</body>
</html>