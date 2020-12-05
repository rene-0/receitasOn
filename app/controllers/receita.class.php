<?php
	namespace App\Controllers;
	class Receita extends Controller
	{
		/*
			*Ao usar uma classe de name space diferente do que está sendo usado agora 'App\Controllers' coloca-se um \ antes para saber que se trata de um namespace exterior '\App\Models\Model'
		*/
		protected function before()
		{
			//echo "Antes";
		}
		
		protected function after()
		{
			//echo "Depois";
		}
		
		function __call($name, $args)
		{
			$this->before();//Codigo antes do method ser achamado
			call_user_func_array([$this, $name], $args);
			$this->after();//Codigo depois do method ser achamado
		}
		
		protected function index($id_receita = null)
		{
			if($id_receita != null && ctype_digit((string)$id_receita))
			{
				$receita = new \App\Models\Receita();
				$receita->setId_receita($id_receita);
				$receitaDAO = new \App\Models\ReceitaDAO();
				$ret = $receitaDAO->buscarUm($receita);
				if(!empty($ret))
				{
					//var_dump($ret);
					$ingredienteDAO = new \App\Models\IngredienteDAO();
					$ingre = $ingredienteDAO->buscarPorReceita($receita);
					//var_dump($ingre);
					$preparoDAO = new \App\Models\PreparoDAO();
					$preparo = $preparoDAO->buscarPorReceita($receita);
					//var_dump($preparo);
					$comentarioDAO = new \App\Models\ComentarioDAO();
					$coments = $comentarioDAO->buscarPorReceita($receita);
					//var_dump($coments);
					$ultimos = $receitaDAO->buscarUltimos();
					$fotos = $receitaDAO->buscarFotos($receita);
					//var_dump($fotos);
					if(isset($_SESSION['usuario']['id_usuario']))
					{
						$starDAO = new \App\Models\StarDAO();
						$star = new \App\Models\Star();
						$star->setId_usuario($_SESSION['usuario']['id_usuario']);
						$star->setId_receita($receita->getId_receita());
						$rating = $starDAO->avaliacaoUsuario($star);
					}
					require_once "../app/views/receita.php";
				}
				else
				{
					throw new \Exception("Erro 404, não encontrado",404);
				}
			}
			else
			{
				throw new \Exception('Receita não encontrada',404);
			}
		}
		
		//REMOVER O TRY/CATCH E USSAR ERROS GENÉRICOS
		protected function comentar($id_receita = null)
		{
			if(isset($id_receita) && isset($_SESSION['usuario']['id_usuario']))
			{
				//Talvez remover o try catch e retornar erros genericos 
				try
				{
					$comentario = new \App\Models\Comentario();
					$comentario->setComentario($_POST['comentario']);
					$comentario->setId_usuario($_SESSION['usuario']['id_usuario']);
					$comentario->setId_receita($id_receita);
					$comentarioDAO = new \App\Models\ComentarioDAO();
					$ret = $comentarioDAO->inserir($comentario);
					$ret->comentario = htmlspecialchars($ret->comentario);
					$ret->nome = htmlspecialchars($ret->nome);
					header('Content-type: application/json');
					echo json_encode($ret);
				}
				catch(\Exception $e)
				{
					echo $e->getMessage();
				}
			}
			else
			{
				header("Location: ".\App\Core\Router::getBaseUrl());
			}
		}
		
		//REMOVER O TRY/CATCH E USSAR ERROS GENÉRICOS
		protected function avaliar($id_receita = null)
		{
			if(isset($_POST['star']) && !empty($_POST['star']) && isset($_SESSION['usuario']['id_usuario']) && isset($id_receita))
			{
				try
				{
					$star = new \App\Models\Star();
					$star->setRating(($_POST['star']/20));
					$star->setId_usuario($_SESSION['usuario']['id_usuario']);
					$star->setId_receita($id_receita);
					$starDAO = new \App\Models\StarDAO();
					
					$ret = $starDAO->vareficarAvaliacao($star);
					if($ret->qtd > 0)
					{
						$starDAO->alterar($star);
						$ret = $starDAO->buscarMediaUm($star);
						echo json_encode($ret);
					}
					else
					{
						$starDAO->inserir($star);
						$ret = $starDA->buscarMediaUm($star);
						echo json_encode($ret);
					}
				}
				catch(\Exception $e)
				{
					echo $e->getMessage();
				}
			}
			elseif(!isset($_SESSION['usuario']['id_usuario']))
			{
				echo "Você precisa entrar para avaliar";
			}
			else
			{
				header("Location: ".\App\Core\Router::getBaseUrl());
			}
		}
	}
?>