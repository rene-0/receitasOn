<?php
	namespace App\Controllers;
	class Visualizar extends Controller
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
				$ret = $receitaDAO->buscarUmEnvio($receita);
				if(!empty($ret))
				{
					//var_dump($ret);
					$ingredienteDAO = new \App\Models\IngredienteDAO();
					$ingre = $ingredienteDAO->buscarPorEnvio($receita);
					//var_dump($ingre);
					$preparoDAO = new \App\Models\PreparoDAO();
					$preparo = $preparoDAO->buscarPorEnvio($receita);
					//var_dump($preparo);
					$fotoDAO = new \App\Models\FotoDAO();
					$fotos = $fotoDAO->buscarPorEnvio($receita);
					//var_dump($fotos);
					if(isset($_SESSION['usuario']['id_usuario']))
					{
						$starDAO = new \App\Models\StarDAO();
						$star = new \App\Models\Star();
						$star->setId_usuario($_SESSION['usuario']['id_usuario']);
						$star->setId_receita($receita->getId_receita());
						$rating = $starDAO->avaliacaoUsuario($star);
						//var_dump($rating);
					}
					require_once "../app/views/visualizar.php";
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
	}
?>