<?php
	session_start();
	//Auto loader
	spl_autoload_register(function ($className){
		//var_dump($className);
		$root = dirname(__DIR__);
		//var_dump($root);
		$file = $root. '/' .$className. '.class.php';
		if(!file_exists($file))
		{
			trigger_error("Classe '{$className}' não encontrada", E_USER_ERROR);//Trocar por algo melhor
		}
		else
		{
			require_once "{$file}";
		}
	});
	//Auto loader
	
	//Erro e exceção handler
	set_error_handler('App\Core\Error::errorHandler');
	set_exception_handler('App\Core\Error::exceptionHandler');
	date_default_timezone_set('America/Sao_Paulo');
	//Router
	$router = new App\Core\Router();
?>