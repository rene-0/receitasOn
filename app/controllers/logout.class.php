<?php
	namespace App\Controllers;
	class Logout extends Controller
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
			$_SESSION['usuario'] = array();
			unset($_SESSION);
			session_destroy();
			header("Location:".\App\Core\Router::getBaseUrl().'home');
		}
	}
?>