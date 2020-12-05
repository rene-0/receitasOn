<?php
	namespace App\Controllers;
	class Login extends Controller
	{
		/*
			*Ao usar uma classe de name space diferente do que está sendo usado agora 'App\Controllers' coloca-se um \ antes para saber que se trata de um namespace exterior '\App\Models\Model'
		*/
		protected function before()
		{
			//echo "Antes";
			if (isset($_SESSION['usuario']['id_usuario']))
			{
				header("Location:".\App\Core\Router::getBaseUrl().'home');
				die();
			}
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
			if(isset($_POST['email']) && isset($_POST['senha']))
			{
				$usuario = new \App\Models\Usuario(null,null,$_POST['email'],$_POST['senha']);
				$usuarioDAO = new \App\Models\UsuarioDAO();
				$ret = $usuarioDAO->login($usuario);
				//var_dump($ret);
				if($ret !== false && $ret !== NULL)
				{
					if($ret->tentativas >= 3)
					{
						//Maior que 3 conta bloqueada
						$msg = "Conta bloqueada";
						require_once('../app/views/login.php');
						die();
					}
					else
					{
						if(password_verify($_POST['senha'], $ret->senha))//Testa se a sneha é válida
						{
							//Senha válida
							$_SESSION['usuario'] = array('id_usuario' => $ret->id_usuario, 'nome' => $ret->nome, 'email' => $ret->email, 'nascimento' => $ret->nascimento, 'criado' => $ret->criado);
							$usuario->setId_usuario($ret->id_usuario);
							$usuarioDAO->tentativas($usuario);//Reseta as tentativas
							header("Location:".\App\Core\Router::getBaseUrl()."conta");
							//var_dump($_SESSION);
							//var_dump($usuario);
						}
						else
						{
							//Não encontrou um usuario
							$msg = "E-mail ou senha inválidos";
							require_once('../app/views/login.php');
							die();
						}
					}
				}
				else
				{
					//Não encontrou o usuario
					$msg = "E-mail ou senha não podem ser vazios";
					require_once('../app/views/login.php');
					die();
				}
			}
			else
			{
				require_once "../app/views/login.php";
			}
		}
	}
?>