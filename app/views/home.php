<html>
	<head>
		<?php include_once('../app/views/include_head.php');?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/home.css'>
		<title>Home - ReceitasOn</title>
	</head>
	<body>
		<?php include_once('../app/views/nav.php');?>
		<div class='hero-image'>
			<div class='container'>
				<h1>Pesquise uma receita!</h1>
				<div class='search'>
					<form method='GET' action='<?php echo App\Core\Router::getBaseUrl(); ?>receitas'>
						<input type='text' name='titulo' class='pesquisa'>
						<button type='submit'><i class="fas fa-search"></i></button>
					</form>
				</div>
			</div>
		</div>
		<div class='wrapper'>
			<main class='ultimos'>
				<h1>Últimas receitas</h1>
				<div class='container'>
					<?php
						foreach($ret as $dados)
						{
							echo "<a href='".App\Core\Router::getBaseUrl()."receita/index/{$dados->id_receita}' class='receita'>";
								echo "<div class='imagem'>";
									echo "<img src='{$dados->capa}'>";
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
			</main>
		</div><!-- Wrapper -->
		<?php include_once('../app/views/footer.php');?>
	</body>
</html>