<?php
	namespace App\Controllers;
	class Alterar_Envio extends Controller
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
			if(!isset($_SESSION['usuario']['id_usuario']))
			{
				header("Location:".\App\Core\Router::getBaseUrl().'login');
				die();
			}
		}
		
		protected function after()
		{
			//echo "Depois";
		}
		
		protected function index(int $id_receita = null)
		{
			if($id_receita == null)
			{
				throw new \Exception("Receita não encontrada",404);
				die();//Só por precaução
			}
			if(isset($_POST['input']))
			{
				$receita = new \App\Models\Receita();
				$receita->setId_receita($id_receita);
				$receita->setTitulo($_POST['titulo']);
				$receita->setTempo_preparo($_POST['tempo_preparo']);
				$receita->setRendimento($_POST['rendimento']);
				$receita->setAdicionais($_POST['adicionais']);

				$receitaDAO = new \App\Models\ReceitaDAO();
				$ret = $receitaDAO->buscarUmEnvio($receita);
				$receita->setStatus($ret->status);

				$usuario = new \App\Models\Usuario($_SESSION['usuario']['id_usuario']);
				foreach($_POST['ingrediente'] as $key => $dados)
				{
					$receita->setIngredientes(null,$dados,$key+1,null);
				}
				foreach($_POST['preparo'] as $key => $dados)
				{
					$receita->setPreparo(null,$dados,$key+1,null);
				}
				if($receita->getStatus() != 'ACEITO')
				{
					foreach($_FILES['fotos']['name'] as $key => $dados)
					{
						if(!empty($_FILES['fotos']['name'][$key]))
						{
							if(!@getimagesize($_FILES['fotos']['tmp_name'][$key]))//Se a imagem for inválida, exemplo um aquivo de texto texto.txt renomeado texto.png| O @ na frente da função é para suprimir o erro criado pelo próprio php e deixar o script mesmo cudar do erro
							{
								throw new \Exception('Imagem inválida');
							}
							elseif($_FILES['fotos']['size'][$key] > 7000000)//Maior que 15mb
							{
								//var_dump($_FILES['fotos']['size'][$key]);
								throw new \Exception('Imagem não pode ser maior que 7mb');
							}
							else
							{
								//var_dump(getimagesize($_FILES['fotos']['tmp_name'][$key]));
								$receita->setFoto(null, time().'_'.$_FILES['fotos']['name'][$key], $_FILES['fotos']['tmp_name'][$key], null);
							}
						}
					}
				}
				//var_dump($receita);
				$receitaDAO->alterarEnvio($receita,$usuario);
				header("Location: ".\App\Core\Router::getBaseUrl()."conta");
			}
			else
			{
				try
				{
					$receita = new \App\Models\Receita();
					$receita->setId_receita($id_receita);
					$receitaDAO = new \App\Models\ReceitaDAO();
					$ret = $receitaDAO->buscarUmEnvio($receita);
					//var_dump($ret);
					if(empty($ret))
					{
						throw new \Exception("Receita não encontrada",404);
					}
					//Criando o obj de receita
						$receita->setTitulo($ret->titulo);
						$receita->setTempo_preparo($ret->temp_preparo);
						$receita->setRendimento($ret->rendimento);
						$receita->setAdicionais($ret->adicionais);
						//$receita->setId_adm($ret->id_adm);
						//Ingredientes
							$ingredienteDAO = new \App\Models\IngredienteDAO();
							$ingredientes = $ingredienteDAO->buscarPorEnvio($receita);
							//var_dump($ingredientes);
							foreach($ingredientes as $dados)
							{
								$receita->setIngredientes($dados->id_ingrediente,$dados->ingrediente,$dados->ordem,$dados->id_receita);
							}
						//Ingredientes
						//Preparo
							$preparoDAO = new \App\Models\PreparoDAO();
							$preparo = $preparoDAO->buscarPorEnvio($receita);
							foreach($preparo as $dados)
							{
								$receita->setPreparo($dados->id_preparo,$dados->preparo,$dados->ordem,$dados->id_receita);
							}
						//Preparo
						//Fotos
							$fotosDAO = new \App\Models\FotoDAO();
							$fotos = $fotosDAO->buscarPorEnvio($receita);
							foreach($fotos as $dados)
							{
								$receita->setFoto($dados->id_foto, $dados->nome, $dados->caminho, $dados->id_receita);
							}
						//Fotos
					//Criando o obj de receita
					//echo "<pre>";
					//var_dump($receita);
					//var_dump($receita->getFotos());
				}
				catch(\Exception $e)
				{
					//echo $e->getMessage();
					throw new \Exception("Receita não encontrada",404);
				}
				require_once('../app/views/alterar_envio.php');
			}
		}

		protected function deletarFoto()
		{
			if(isset($_POST['id_receita']) && isset($_POST['id_foto']) && isset($_SESSION['usuario']['id_usuario']))
			{
				try
				{
					$receita = new \App\Models\Receita();
					$receita->setId_receita($_POST['id_receita']);

					$receitaDAO = new \App\Models\ReceitaDAO();
					$ret = $receitaDAO->buscarUmEnvio($receita);
					if(empty($ret))
					{
						throw new \Exception("Receita não encontrada");
					}
					elseif($ret->status === 'ACEITO')
					{
						header('Content-type: application/json');
						echo json_encode('{"result" : false, "msg" : "Não é possível deletar fotos de uma receita aceita!"}');
						die();//Poderia ser também um return false
					}

					$foto = new \App\Models\Foto();
					$foto->setId_foto($_POST['id_foto']);
					$foto->setId_receita($_POST['id_receita']);
					
					$fotoDAO = new \App\Models\FotoDAO();
					$ret = $fotoDAO->buscarUmaFotoEnvio($foto);
					if(empty($ret))
					{
						throw new \Exception("Foto não encontrada");
					}
					$foto->setCaminho($ret->caminho);
					$foto->setCapa($ret->capa);

					$ret = $fotoDAO->buscarPorEnvio($receita);
					if(count($ret) <= 1)
					{
						header('Content-type: application/json');
						echo json_encode('{"result" : false, "msg" : "Receita deve conter no minimo uma foto!"}');
						die();
					}
					else
					{
						$ret = $fotoDAO->removerFoto($foto);
					}

					if($ret == true && $foto->getCapa() == 's')
					{
						$ret = $fotoDAO->buscarPorEnvio($receita);
						$foto->setId_foto($ret[0]->id_foto);//Substitue o id_receita com o primeiro id que for encontrado em buscarPorEnvio()
						$ret = $fotoDAO->novaCapa($foto);
					}

					if($ret)
					{
						header('Content-type: application/json');
						echo json_encode('{"result" : true, "msg" : "Foto removida!"}');
					}
					else
					{
						header('Content-type: application/json');
						echo json_encode('{"result" : false, "msg" : "Erro ao remover foto!"}');
					}
				}
				catch(\Exception $e)
				{
					echo $e->getMessage();
					//throw new \Exception("Página não encontrada",404);
				}
			}
		}
	}
?>