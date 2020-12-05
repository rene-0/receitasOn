<?php
	namespace App\Controllers;
	class Cadastro extends Controller
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
			//var_dump($_POST);
			if(isset($_POST['nome']))
			{
				try
				{
					$usuarioDAO = new \App\Models\UsuarioDAO();
					$usuario = new \App\Models\Usuario(null);
					//Usando os sets para validar os inputs
					$usuario->setNome($_POST['nome']);
					$usuario->setEmail($_POST['mail']);
					$usuario->setSenha($_POST['password']);
					$usuario->setNascimento($_POST['data']);
					//Usando os sets para validar os inputs
					//var_dump($usuario);
					$mail_check = $usuarioDAO->vereficarEmail($usuario);
					//var_dump($mail_check);
					if($mail_check->qtd > 0)
					{
						throw new \Exception('Email já cadastrado');
					}
					$usuarioDAO->inserir($usuario);
				}
				catch(\Exception $e)
				{
					echo $e->getMessage();
					require_once "../app/views/cadastro.php";
				}
				header("Location: ".\App\Core\Router::getBaseUrl()."/login");
			}
			else
			{
				require_once "../app/views/cadastro.php";
			}
		}
	}
?>