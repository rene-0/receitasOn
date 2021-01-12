<?php
	namespace App\Controllers\Sysadm;
	class Listar_Receitas extends Controller
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
		
		protected function index($page = null)
		{
			$receitasDAO = new \App\Models\ReceitaDAO();
			//Paginação
				$per_page = 10;
				$page--;
				if(!is_numeric($page) && !ctype_digit((string)$page) || $page < 0)
				{
					$page = 0;
				}
				$paginas = $receitasDAO->sysadmPaginas($_GET);
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
			$ret = $receitasDAO->sysadmPesquisarReceita($_GET,$page,$per_page);
			require_once('../app/views/sysadm/listar_receitas.php');
		}
		
		protected function deletarReceita()
		{
			header('Content-type: application/json');
			//SE FOR UMA RECEITA ENVIADA POR UM USUÁRIO E NÃO UM ADM USAR OUTRA FUNÇÃO
			if(isset($_POST['id_receita']))
			{
				$receitaDAO = new \App\Models\ReceitaDAO();
				$receita = new \App\Models\Receita();
				$receita->setId_receita($_POST['id_receita']);
				$ret = $receitaDAO->buscarUm($receita);
				if($ret->id_usuario === null)
				{
					$ret = $receitaDAO->deletar($receita);
					if($ret)
					{
						echo json_encode('{"result" : true, "msg" : "Receita removida"}');
					}
					else
					{
						echo json_encode('{"result" : false, "msg" : "Erro ao remover receita"}');
					}
				}
				else
				{
					$ret = $receitaDAO->deletarEnvio($receita,$ret->id_ureceita);
					if($ret)
					{
						echo json_encode('{"result" : true, "msg" : "Receita removida"}');
					}
					else
					{
						echo json_encode('{"result" : false, "msg" : "Erro ao remover receita"}');
					}
				}
			}
		}
	}
?>