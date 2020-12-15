<html>
	<head>
		<?php include_once('../app/views/include_head.php');?>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/main.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/home.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/receitas.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/nav.css'>
		<link rel='stylesheet' href='<?php echo App\Core\Router::getBaseUrl(); ?>css/footer.css'>
		<title>Receitas</title>
	</head>
	<body>
		<?php include_once('../app/views/nav.php');?>
		<div class='hero-image'>
			<div class='container'>
				<h1>Pesquise uma receita!</h1>
				<div class='search'>
					<form method='GET' action='#'>
						<input type='text' name='titulo' class='pesquisa'>
						<button type='submit'><i class="fas fa-search"></i></button>
					</form>
				</div>
			</div>
		</div>
		<div class='wrapper'>
			<aside>
				<h3>Filtros</h3>
				<div class='filtros'>
					<form method='GET' action='<?php echo App\Core\Router::getBaseUrl(); ?>receitas'>
						<span>Nome:</span>
						<input name='titulo' <?php if(isset($_GET['titulo'])){echo "value='{$_GET['titulo']}'";}?> type='text' placeholder='Nome da receita'>
						<input type='submit'>
					</form>
					<form method='GET' action='<?php echo App\Core\Router::getBaseUrl(); ?>receitas'>
						<span>Data:</span>
						<input name='data' <?php if(isset($_GET['data'])){echo "value='{$_GET['data']}'";}?> type='date' placeholder='data de envio'>
						<input type='submit'>
					</form>
					<form method='GET' action='<?php echo App\Core\Router::getBaseUrl(); ?>receitas'>
						<span>Classificação:</span>
						<span class="stars">
							<div class="stars-container">
								<span class="ativos" style="width:0%">
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								</span>
								<span class="inativos">
									<i class="fa fa-star-o" aria-hidden="true"></i>
									<i class="fa fa-star-o" aria-hidden="true"></i>
									<i class="fa fa-star-o" aria-hidden="true"></i>
									<i class="fa fa-star-o" aria-hidden="true"></i>
									<i class="fa fa-star-o" aria-hidden="true"></i>
								</span>
							</div>
						</span>
						<input type="range" name="estrelas" min="0" max="100">
						<input type='submit'>
					</form>
				</div>
			</aside>
			<main class='ultimos'>
				<?php
				if(isset($_GET['titulo']) && !empty($_GET['titulo']))
				{
					echo "<h1>Resultado da pesquisa por: '{$_GET['titulo']}'</h1>";
				}
				else
				{
					echo "<h1>Resultado da pesquisa</h1>";
				}
				echo "<div class='container'>";
						foreach($ret as $dados)
						{
							echo "<a href='".App\Core\Router::getBaseUrl()."receita/index/{$dados->id_receita}' class='receita'>";
								echo "<div class='imagem'>";
									echo "<img alt='{$dados->nome_foto}' src='{$dados->caminho}'>";
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
		<div class='pages'>
			<?php
				for($i = 1;$i <= ceil($paginas->paginas/$per_page); $i++)
				{
					if($i == ($page+1))
					{
						echo "<a id='ativo' href='".\App\Core\Router::getBaseUrl()."receitas/index/{$i}{$get_url}'>{$i}</a>";
					}
					else
					{
						echo "<a href='".\App\Core\Router::getBaseUrl()."receitas/index/{$i}{$get_url}''>{$i}</a>";
					}
				}
			?>
		</div>
		<?php include_once('../app/views/footer.php');?>
	</body>
</html>