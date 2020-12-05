<?php
	namespace App\Controllers\Sysadm;
	class Login extends Controller
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
			if (session_status() == PHP_SESSION_NONE || isset($_SESSION['adm']['id_adm'])) {
				header("Location:".\App\Core\Router::getBaseUrl().'sysadm');
				die();
			}
		}
		
		protected function after()
		{
			//echo "Depois";
		}
		
		protected function index()
		{
			//echo "Olá do index do sysadm!";
			//var_dump($_SESSION);
			if(isset($_POST['submit']))
			{
				$usuario = new \App\Models\Usuario(null,null,$_POST['usuario'],$_POST['senha']);
				$usuarioDAO = new \App\Models\UsuarioDAO();
				$ret = $usuarioDAO->sysadmLogin($usuario);
				//var_dump($ret);
				if($ret !== false && $ret !== NULL)//Testa se encontrou um usuário
				{
					if($ret->tentativas >= 3)//Testa se es´ta bloqueado
					{
						//Maior que 3 conta bloqueada
						$msg = "Conta bloqueada";
						require_once('../app/views/sysadm/login.php');
						die();
					}
					else
					{
						if(password_verify($_POST['senha'], $ret->senha))//Testa se a sneha é válida
						{
							//Senha válida
							$_SESSION['adm'] = array('id_adm' => $ret->id_adm, 'nome' => $ret->nome, 'login' => $ret->login);
							$usuario->setId_usuario($ret->id_adm);
							$usuarioDAO->sysadmTentativas($usuario);//Reseta as tentativas
							header("Location:".\App\Core\Router::getBaseUrl().'sysadm');
						}
						else
						{
							//Não encontrou um usuario
							$msg = "Usuário ou senha inválidos";
							require_once('../app/views/sysadm/login.php');
							die();
						}
					}
				}
				else
				{
					//Não encontrou um usuario
					$msg = "Usuário ou senha inválidos";
					require_once('../app/views/sysadm/login.php');
					die();
				}
				var_dump($_SESSION);
			}
			else
			{
				require_once('../app/views/sysadm/login.php');
			}
		}
	}
?>