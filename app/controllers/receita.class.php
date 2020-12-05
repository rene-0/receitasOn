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
			header('Content-type: application/json');//Necessário para o js entender o echo como um json
			if(isset($id_receita) && isset($_SESSION['usuario']['id_usuario']) && isset($_POST['comentario']))
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
					echo json_encode('{"result" : true, "comentario" : "'.$ret->comentario.'", "nome": "'.$ret->nome.'", "data" : "'.$ret->data.'"}');
				}
				catch(\Exception $e)
				{
					echo json_encode('{"result" : false, "msg" : "Erro ao iserir comentario!"}');
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
			header('Content-type: application/json');//Necessário para o js entender o echo como um json
			if((isset($_POST['star']) && $_POST['star'] > 0 && $_POST['star'] <= 100) && !empty($_POST['star']) && isset($_SESSION['usuario']['id_usuario']) && isset($id_receita))
			{
				try
				{
					$star = new \App\Models\Star();
					$star->setRating(($_POST['star']/20));
					$star->setId_usuario($_SESSION['usuario']['id_usuario']);
					$star->setId_receita($id_receita);
					$starDAO = new \App\Models\StarDAO();
					
					$ret = $starDAO->vareficarAvaliacao($star);//Verifica se o usuário já valiou
					if($ret->qtd > 0)//Se já avaliou
					{
						$ret = $starDAO->alterar($star);
						if($ret)//Se o retorno for true, a alteração aconteceu
						{
							$ret = $starDAO->buscarMediaUm($star);
							echo json_encode('{"result" : true, "msg" : "Avaliação registrada!"}');
						}
						else
						{
							echo json_encode('{"result" : false, "msg" : "Erro ao registrar avaliação!"}');
						}
					}
					else//Se for a primeira avaliação
					{
						$starDAO->inserir($star);
						$ret = $starDA->buscarMediaUm($star);
						echo json_encode('{"result" : true, "msg" : "Avaliação registrada!"}');
					}
				}
				catch(\Exception $e)
				{
					echo json_encode('{"result" : false, "msg" : "Erro ao registrar avaliação!"}');
				}
			}
			elseif(!isset($_SESSION['usuario']['id_usuario']))
			{
				echo json_encode('{"result" : false, "msg" : "Você precisa entrar para enviar uma avaliação!"}');
			}
			else
			{
				header("Location: ".\App\Core\Router::getBaseUrl());
			}
		}
	}
?>