<html>
	<head>
		<?php include_once('../app/views/sysadm/include_head.php'); ?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/sysadm/login.css'>
	</head>
	<body>
		<form action='' method='POST'>
			<h2>Login</h2>
			<div class='campo'>
				<span>Usuário</span>
				<input type='text' name='usuario'>
			</div>
			<div class='campo'>
				<span>Senha</span>
				<input type='password' name='senha'>
			</div>
			<?php
				if(isset($msg) && !empty($msg))
				{
					echo "<small>{$msg}</small>";
				}
			?>
			<input name='submit' type='submit'>
		</form>
	</body>
</html>