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
                    <?php
                        foreach($folders as $dados)
                        {
                            if(substr($dados,-4) === '.sql')
				            {
                                echo "<div class='item sql'>";
                                    echo "<div class='icon'>";
                                        echo "<i class='far fa-file'></i>";
                                    echo "</div>";
                                    echo "<div class='nome'>";
                                        echo "<p>{$dados}</p>";
                                    echo "</div>";
                                echo "</div>";
                            }
                            else
                            {
                                echo "<div class='item zip'>";
                                    echo "<div class='icon'>";
                                    echo "<i class='far fa-file-archive'></i>";
                                    echo "</div>";
                                    echo "<div class='nome'>";
                                        echo "<p>{$dados}</p>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                    ?>
                </div>
                <div class='loader'>
                    <div class='loading'>
                        <img src='<?php echo App\Core\Router::getBaseUrl();?>img/main/loader.gif'> Carregando!
                    </div>
                    <div class='loaded'>
                        <p>Backup concluido!</p>
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