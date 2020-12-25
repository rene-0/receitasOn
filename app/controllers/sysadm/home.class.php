<?php
	namespace App\Controllers\Sysadm;
	class Home extends Controller
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
			//Receita
			$receitaDAO = new \App\Models\ReceitaDAO();
			$ret = $receitaDAO->buscarUltimoEnvio();
			$receita = new \App\Models\Receita($ret->id_receita);
				if(!empty($ret))
				{
					$ingredienteDAO = new \App\Models\IngredienteDAO();
					$ingre = $ingredienteDAO->buscarPorEnvio($receita);
					
					$preparoDAO = new \App\Models\PreparoDAO();
					$preparo = $preparoDAO->buscarPorEnvio($receita);
					
					$fotoDAO = new \App\Models\FotoDAO();
					$fotos = $fotoDAO->buscarPorEnvio($receita);
				}
				else
				{
					throw new \Exception("Erro 404, não encontrado",404);
				}
			//Receita
			$usuarioDAO = new \App\Models\UsuarioDAO();
			$usuario = $usuarioDAO->buscarTodosUsuarios();

			require_once('../app/views/sysadm/home.php');
		}
	}
?>