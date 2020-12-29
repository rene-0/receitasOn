<html>
	<head>
		<?php include_once('../app/views/sysadm/include_head.php'); ?>
        <script type="text/javascript" src="<?php echo App\Core\Router::getBaseUrl(); ?>js/sysadm/configuracoes.js"></script>
        <link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/sysadm/configuracoes.css'>
		<title>Sysadm - Configurações</title>
	</head>
	<body>
		<?php include_once('../app/views/sysadm/nav.php'); ?>
		<main class='wrapper'>
            <div class='campo'>
                <h1>Configurações</h1>
            </div>
            <div class='campo'>
                <h3>Backup</h3>
                <div class='back'>
                    <div class='item'>
                        <div class='icon'>
                            <i class="far fa-file"></i>
                        </div>
                        <div class='nome'>
                            <p>receitason-backup-31-13/1998.sql</p>
                        </div>
                    </div>
                    <div class='item'>
                        <div class='icon'>
                            <i class="far fa-file"></i>
                        </div>
                        <div class='nome'>
                            <p>receitason-backup-31-13/1998.sql</p>
                        </div>
                    </div>
                </div>
                <div class='buttons'>
                    <i class="fas fa-file-archive"></i>
                    <i class="fas fa-plus"></i>
                </div>
            </div>
		</main>
		<div id='toast'></div>
	</body>
</html>