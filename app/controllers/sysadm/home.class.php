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
			//echo "Olá do index do sysadm!";
			require_once('../app/views/sysadm/home.php');
		}
	}
?>