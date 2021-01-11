<?php
	namespace App\Controllers\Sysadm;
	class Incluir_Receita extends Controller
	{
		function __call($name, $args)
		{
			$this->before();//Codigo antes do method ser achamado
			call_user_func_array([$this, $name], $args);
			$this->after();//Codigo depois do method ser achamado
		}
		
		protected function before()
		{
			parent::before();//Teste de login
		}
		
		protected function after()
		{ }
		
		protected function index()
		{
			if(isset($_POST['input']))
			{
				try
				{
					$receita = new \App\Models\Receita(null);
					$receita->setTitulo($_POST['titulo']);
					$receita->setTempo_preparo($_POST['tempo_preparo']);
					$receita->setRendimento($_POST['rendimento']);
					$receita->setAdicionais($_POST['adicionais']);
					$usuario = new \App\Models\Usuario($_SESSION['adm']['id_adm']);
					foreach($_POST['ingrediente'] as $key => $dados)
					{
						$ingrediente = new \App\Models\Ingrediente();
						$ingrediente->setIngrediente($dados);
						$ingrediente->setOrdem($key+1);
						$receita->setIngredientes(null, $ingrediente->getIngrediente(),$ingrediente->getOrdem(),null);
					}
					foreach($_POST['preparo'] as $key => $dados)
					{
						$preparo = new \App\Models\Preparo();
						$preparo->setPreparo($dados);
						$preparo->setOrdem($key+1);
						$receita->setPreparo(null,$preparo->getPreparo(),$preparo->getOrdem(),null);
					}
					foreach($_FILES['fotos']['name'] as $key => $dados)
					{
						if(!empty($_FILES['fotos']['name'][$key]))
						{
							if(!@getimagesize($_FILES['fotos']['tmp_name'][$key]))
							{
								throw new \Exception("Imagem '{$dados}' inválida");
							}
							elseif($_FILES['fotos']['size'][$key] > 15000000)//Maior que 15mb
							{
								throw new \Exception('Imagem não pode ser maior que 15mb');
							}
							else
							{
								$receita->setFoto(null, time().'_'.$_FILES['fotos']['name'][$key], $_FILES['fotos']['tmp_name'][$key], null);
							}
						}
						
					}
					$receitaDAO = new \App\Models\ReceitaDAO();
					$receitaDAO->sysadmIncluir($receita,$usuario);
					header("Location: ".\App\Core\Router::getBaseUrl()."sysadm/listar_receitas");
				}
				catch(\Exception $e)
				{
					$erro = $e->getMessage();
					require_once('../app/views/sysadm/incluir_receita.php');
				}
			}
			else
			{
				require_once('../app/views/sysadm/incluir_receita.php');
			}
		}
	}
?>