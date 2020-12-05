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
			//echo "Antes";
			//Teste de login
			parent::before();
		}
		
		protected function after()
		{
			//echo "Depois";
		}
		
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
						$receita->setIngredientes(null,$dados,$key+1,null);
					}
					foreach($_POST['preparo'] as $key => $dados)
					{
						$receita->setPreparo(null,$dados,$key+1,null);
					}
					foreach($_FILES['fotos']['name'] as $key => $dados)
					{
						if(!empty($_FILES['fotos']['name'][$key]))
						{
							if(!@getimagesize($_FILES['fotos']['tmp_name'][$key]))//Se a imagem for inválida, exemplo um aquivo de texto texto.txt renomeado texto.png| O @ na frente da função é para suprimir o erro criado pelo próprio php e deixar o script mesmo cudar do erro
							{
								throw new \Exception('Imagem inválida');
							}
							elseif($_FILES['fotos']['size'][$key] > 15000000)//Maior que 15mb
							{
								//var_dump($_FILES['fotos']['size'][$key]);
								throw new \Exception('Imagem não pode ser maior que 15mb');
							}
							else
							{
								//var_dump(getimagesize($_FILES['fotos']['tmp_name'][$key]));
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
				}
			}
			else
			{
				require_once('../app/views/sysadm/incluir_receita.php');
			}
		}
	}
?>