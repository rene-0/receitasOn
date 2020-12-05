<html>
	<head>
		<script src="https://kit.fontawesome.com/3c12901e9f.js" crossorigin="anonymous"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
		<link rel='stylesheet' href='main.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/main.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/home.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/nav.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/footer.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/login.css'>
	</head>
	<body>
		<?php include_once('../app/views/nav.php');?>
		<div class='wrapper'>
			<form method='POST' action=''>
				<h1>Login</h1>
				<div class='campo'>
					<span>E-mail:</span>
					<input type='mail' name='email' placeholder='E-mail'>
				</div>
				<div class='campo'>
					<span>Senha:</span>
					<input type='password' name='senha' placeholder='Senha'>
					<small><?php if(isset($msg)){echo $msg;}?></small>
				</div>
				<div class='campo'>
					<a href='<?php echo App\Core\Router::getBaseUrl(); ?>cadastro'>Não tem conta? Cadastre-se.</a>
					<input name='submit' type='submit'>
				</div>
			</form>
		</div><!-- Wrapper -->
		<?php include_once('../app/views/footer.php');?>
	</body>
</html>