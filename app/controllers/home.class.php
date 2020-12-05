<?php
	namespace App\Controllers;
	//use Exception;
	class Home extends Controller
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
		
		protected function index()
		{
			$receitaDAO = new \App\Models\ReceitaDAO();
			$ret = $receitaDAO->Home();
			//var_dump($ret);
			require_once "../app/views/home.php";
		}
		
		protected function teste()
		{
			/*$receita = new \App\Models\Receita();
			$receita->setIngredientes(1,'Um ingrediente',1,2);
			$receita->setPreparo(1,'Um preparo',1,2);
			$receita->setPreparo(2,'Dois preparo',2,2);
			echo "<pre>";
			var_dump($receita);
			$receita = new \App\Models\Receita(2);
			$receitaDAO = new \App\Models\ReceitaDAO();
			$ret = $receitaDAO->buscarUm($receita);
			var_dump($ret);
			try
			{
				$receita = new \App\Models\Receita(null,"Bolo","12");
				//$receita->setTitulo('Um titulo');
				$receita->setIngredientes(null,"Um ingrediente",'10',null);
				$receita->setPreparo(null,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consectetur bibendum viverra.','10',null);
				echo "<pre>";
				var_dump($receita);
				echo "</pre>";
			}
			catch(\Exception $e)
			{
				echo $e->getMessage();
			}*/
			//echo "TEste";
			//throw new \Exception('Bananas');
		}
	}
?>