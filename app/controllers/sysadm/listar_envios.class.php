<?php
	namespace App\Controllers\Sysadm;
	class Listar_Envios extends Controller
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
		
		protected function index($page = null)
		{
			//Adicionar o botão de REMOVER receita
			//Remover receita remove a receita da tabela receitas mas mantem a receita da tabela u_receitas (talvez até mudar a capa da receita para uma imagem com foto removida)
			$receitasDAO = new \App\Models\ReceitaDAO();
			//Paginação
				$per_page = 10;
				$page--;
				if(!is_numeric($page) && !ctype_digit((string)$page) || $page < 0)
				{
					$page = 0;
				}
				
				$paginas = $receitasDAO->sysadmEnviosPaginas($_GET);
				$base = \App\Core\Router::getBaseUrl();
				$get_url = "?";
				if(isset($_GET['titulo']) && !empty($_GET['titulo']))
				{
					$get_url .= "titulo={$_GET['titulo']}&";
				}
				if(isset($_GET['data']) && !empty($_GET['data']))
				{
					$get_url .= "data={$_GET['data']}&";
				}
				if(isset($_GET['criador']) && !empty($_GET['criador']))
				{
					$get_url .= "criador={$_GET['criador']}&";
				}
				$get_url = substr($get_url,0,-1);
			//Paginação
			$ret = $receitasDAO->sysadmPesquisarEnvios($_GET,$page,$per_page);
			//var_dump($paginas);
			require_once('../app/views/sysadm/listar_envios.php');
		}
		
		protected function deletarEnvio()
		{
			header('Content-type: application/json');
			if(isset($_POST['id_receita']))
			{
				$receitaDAO = new \App\Models\ReceitaDAO();
				$receita = new \App\Models\Receita();
				$receita->setId_receita($_POST['id_receita']);//id_receita da tabela u_receitas
				$id_ureceita = $receita->getId_receita();
				$ret = $receitaDAO->buscarReceitaPorEnvio($receita);//Busca a receita pelo id_ureceita
				$receita->setId_receita($ret->id_receita);//Sobrescreve para usar o id_receita da tabela receitas dentro do método deletarEnvio, que chamara o método deletar. Como o método deletar é usado para deletar somente reecitas da tabela receita, é necessário sobrescrever id_receita da tabela u_receitas pelo id_receita da tabela receitas e passa-lo separadamente
				/*echo "<pre>";
				var_dump($receita);
				var_dump($id_ureceita);*/
				$ret = $receitaDAO->deletarEnvio($receita, $id_ureceita);
				if($ret)
				{
					echo json_encode('{"result" : true, "msg" : "Evnio removida"}');
				}
				else
				{
					echo json_encode('{"result" : false, "msg" : "Erro ao remover envio"}');
				}
			}
			else
			{
				echo json_encode('{"result" : false, "msg" : "Erro ao remover receita"}');
				//Talvez responder com um 404
			}
		}
		
		protected function aceitar()
		{
			//Verificar se a receita na tabela de u_receita já não está com o status de ACEITO, RECUSADO ou REMOVIDO
			//A receita só pode ser aceita ou recusada se seu status for ANÁLIZE, talve criar um novo método para subistituir 'buscarUmEnvio' onde no WHERE tem status = 'ANALIZE'
			header('Content-type: application/json');
			if(isset($_POST['id_receita']))
			{
				$receita = new \App\Models\Receita();
				$receita->setId_receita($_POST['id_receita']);
				$receitaDAO = new \App\Models\ReceitaDAO();
				$ret = $receitaDAO->buscarUmEnvio($receita);
				if($ret->status == "ANÁLIZE")
				{
					$id_usuario = $ret->id_usuario;
					//Duplicando receita
						$receita = new \App\Models\Receita($ret->id_receita);//id_receita da tabela u_receitas
						$receita->setTitulo($ret->titulo);
						$receita->setTempo_preparo($ret->temp_preparo);
						$receita->setRendimento($ret->rendimento);
						$receita->setAdicionais($ret->adicionais);
						//Ingredientes
							$ingredienteDAO = new \App\Models\IngredienteDAO();
							$ret = $ingredienteDAO->buscarPorEnvio($receita);
							foreach($ret as $dados)
							{
								$receita->setIngredientes(null,$dados->ingrediente,$dados->ordem,$dados->id_receita);
							}
						//Ingredientes
						//Preparo
							$preparoDAO = new \App\Models\PreparoDAO();
							$ret = $preparoDAO->buscarPorEnvio($receita);
							foreach($ret as $dados)
							{
								$receita->setPreparo(null,$dados->preparo,$dados->ordem,$dados->id_receita);
							}
						//Preparo
						//Fotos
							$fotoDAO = new \App\Models\FotoDAO();
							$ret = $fotoDAO->buscarPorEnvio($receita);
							foreach($ret as $dados)
							{
								$receita->setFoto(null, $dados->nome, $dados->caminho, $dados->id_receita);
							}
						//Fotos
					//Duplicando receita
					$adm = new \App\Models\Usuario($_SESSION['adm']['id_adm']);
					$usuario = new \App\Models\Usuario($id_usuario);
					$ret = $receitaDAO->aceitarReceita($receita,$adm,$usuario);
					if($ret)
					{
						echo json_encode('{"result" : true, "msg" : "Receita aceita"}');
					}
					else
					{
						echo json_encode('{"result" : false, "msg" : "Erro ao aceitar receita"}');
					}
				}//Fim do if de status
				else
				{
					echo json_encode('{"result" : false, "msg" : "Receita em status inválido"}');
				}
			}//If do post
			else
			{
				header("Location ".App\Core\Router::getBaseUrl()."sysadm");
			}
		}
		
		protected function recusar()
		{
			if(isset($_POST['id_receita']))
			{
				$receita = new \App\Models\Receita();
				$receita->setId_receita($_POST['id_receita']);
				$receitaDAO = new \App\Models\ReceitaDAO();
				$ret = $receitaDAO->recusarReceita($receita);
				header('Content-type: application/json');
				if($ret)
				{
					echo json_encode('{"result" : true, "msg" : "Receita recusada"}');
				}
				else
				{
					echo json_encode('{"result" : false, "msg" : "Erro ao recusar receita"}');
				}
			}
			else
			{
				header("Location ".App\Core\Router::getBaseUrl()."sysadm");
			}
		}
		
		/*protected function teste()
		{
			$receitaDAO = new \App\Models\ReceitaDAO();
			$receita = new \App\Models\Receita();
			$receita->setId_receita('bananas');
			$ret = $receitaDAO->deletar($receita);
			var_dump($ret);
		}*/
	}
?>