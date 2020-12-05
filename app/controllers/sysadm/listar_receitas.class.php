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
			//echo "Olá do index do sysadm!";
			//var_dump($_GET);
			//var_dump($ret);
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
			//var_dump($paginas);
			require_once('../app/views/sysadm/listar_receitas.php');
		}
		
		protected function deletarReceita()
		{
			//var_dump($_POST);
			if(isset($_SESSION['adm']['id_adm']))
			{
				if(isset($_POST['id_receita']))
				{
					$receitaDAO = new \App\Models\ReceitaDAO();
					$receita = new \App\Models\Receita();
					$receita->setId_receita($_POST['id_receita']);
					$ret = $receitaDAO->deletar($receita);
					if($ret)
					{
						echo "true";
					}
					else
					{
						echo "Erro ao inserir";
					}
				}
			}
			else
			{
				//O que eu faço se não estiver logado
				//Talvez responder com um 404
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