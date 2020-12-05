<?php
	namespace App\Controllers\Sysadm;
	class Controller
	{
		protected function before()
		{
			//echo "Antes";
			if (session_status() == PHP_SESSION_NONE || !isset($_SESSION['adm']['id_adm'])) {
				header("Location:".\App\Core\Router::getBaseUrl().'sysadm/login');
				die();
			}
		}
		
		protected function after()
		{
			//echo "Depois";
		}
	}
?>