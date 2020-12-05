<?php
	namespace App\Controllers;
	class Receitas extends Controller
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
		
		protected function index($page = null)
		{
			$receitaDAO = new \App\Models\ReceitaDAO();
			//var_dump($_GET);
			//Paginação
				$per_page = 3;
				$page--;
				if(!is_numeric($page) && !ctype_digit((string)$page) || $page < 0)
				{
					$page = 0;
				}
				$paginas = $receitaDAO->paginas($_GET);
				//var_dump($paginas);
				$get_url = "?";
				if(isset($_GET['titulo']) && !empty($_GET['titulo']))
				{
					$get_url .= "titulo={$_GET['titulo']}&";
				}
				if(isset($_GET['data']) && !empty($_GET['data']))
				{
					$get_url .= "data={$_GET['data']}&";
				}
				$get_url = substr($get_url,0,-1);
			//Paginação
			$ret = $receitaDAO->pesquisarReceita($_GET);
			//var_dump($ret);
			require_once "../app/views/receitas.php";
		}
	}
?>