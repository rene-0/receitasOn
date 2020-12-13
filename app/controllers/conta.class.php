<?php
	namespace App\Controllers;
	class Conta extends Controller
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
		
		protected function index()
		{
			$usuario = new \App\Models\Usuario($_SESSION['usuario']['id_usuario']);
			$usuarioDAO = new \App\Models\UsuarioDAO();
			$ret = $usuarioDAO->buscarUsuario($usuario);
			//var_dump($ret);
			$receitasDAO = new \App\Models\ReceitaDAO();
			$receitas = $receitasDAO->receitasUsuario($usuario);
			//Se a imagem não existe não usa a padão
			foreach($receitas as $dados)
			{
				$base_dir = dirname(dirname(dirname(__FILE__)));//C:\xampp\htdocs\receitasOn
				$ex = explode('/',$dados->caminho);
				$file = "{$base_dir}\\public\\{$ex[count($ex)-2]}\\{$ex[count($ex)-1]}";//O aquivo que vai ser deletado
				if(!file_exists($file))
				{
					$dados->caminho = \App\Core\Router::getBaseUrl() . 'img/main/imagem_removida.png';
				}
			}
			require_once('../app/views/conta.php');
		}
		
		protected function deletarEnvio()
		{
			if(isset($_POST['id_receita']))
			{
				header('Content-type: application/json');
				//Receita
				$receita = new \App\Models\Receita();
				$receita->setId_receita($_POST['id_receita']);
				$usuario = new \App\Models\Usuario($_SESSION['usuario']['id_usuario']);
				$receitaDAO = new \App\Models\ReceitaDAO();
				$ret = $receitaDAO->buscarEnvioPorUsuario($receita,$usuario);
				$receita->setStatus($ret->status);
				//Receita
				if(empty($ret))
				{
					echo json_encode('{"result" : false, "msg" : "Receita não encontrada"}');
					die();
				}
				
				$ret = $receitaDAO->deletarUreceita($receita);
				if($ret)
				{
					echo json_encode('{"result" : true, "msg" : "Envio removido"}');
				}
				else
				{
					echo json_encode('{"result" : false, "msg" : "Erro ao remover envio"}');
				}

			}
		}
	}
?>