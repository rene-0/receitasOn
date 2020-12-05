<html>
	<head>
		<?php include_once('../app/views/include_head.php');?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/cadastro.css'>
		<script src='<?php echo App\Core\Router::getBaseUrl(); ?>js/cadastro.js'></script>
		<title>Cadastro</title>
	</head>
	<body>
		<?php include_once('../app/views/nav.php');?>
		<div class='wrapper'>
			<form id='form' method='POST' action='#'>
				<h1>Cadastro</h1>
				<div class='campo'>
					<span>Nome:</span>
					<input type='text' name='nome' placeholder='Nome completo'>
					<small></small>
				</div>
				<div class='campo'>
					<span>Email:</span>
					<input type='email' name='mail' placeholder='E-mail'>
					<small></small>
				</div>
				<div class='campo'>
					<span>Confirmar Email:</span>
					<input type='email' name='conf-mail' placeholder='Confirmar E-mail'>
					<small></small>
				</div>
				<div class='campo'>
					<span>Senha:</span>
					<input type='password' name='password' placeholder='Senha'>
					<small></small>
				</div>
				<div class='campo'>
					<span>Confirmar Senha:</span>
					<input type='password' name='conf-password' placeholder='Confirmar Senha'>
					<small></small>
				</div>
				<div class='campo'>
					<span>Data de nascimento:</span>
					<input type='date' name='data'>
					<small></small>
				</div>
				<div class='campo'>
					<input name='sub' type='submit'>
					<small></small>
				</div>
			</form>
		</div><!-- Wrapper -->
		<?php include_once('../app/views/footer.php');?>
	</body>
</html>