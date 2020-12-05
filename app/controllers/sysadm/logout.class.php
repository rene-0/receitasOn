<?php
	namespace App\Controllers\Sysadm;
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
			//parent::before();
			if (!isset($_SESSION['adm']['id_adm'])) {
				header("Location:".\App\Core\Router::getBaseUrl().'sysadm/login');
				die();
			}
		}
		
		protected function after()
		{
			//echo "Depois";
		}
		
		protected function index()
		{
			$_SESSION['adm'] = array();
			unset($_SESSION);
			session_destroy();
			header("Location:".\App\Core\Router::getBaseUrl().'sysadm/login');
		}
	}
?>