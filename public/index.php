<?php
	session_start();
	//Auto loader
	//Uma das partes mais importantes do framework, o autoload. Esta função da require automaticamente nas classes usadas, para isso é necessário colocar as classes em pastas relativas ao seu namespace ou vise e versa, é recomendado deixar os var_dump's comentado no código para rapidamente visualizar o path que esta indo no require.
	spl_autoload_register(function ($className){
		//var_dump($className);
		$root = dirname(__DIR__);
		//var_dump($root);
		$file = $root. '\\' .$className. '.class.php';//Como se trata de um CLASS AUTOLOADER e temos '.class.php' escrito como constante, todas as classes devem ser terminadas como '.class.php' e NÃO só como '.php', o resto dos arquivos  devem ser .php
		//var_dump($file);
		if(!file_exists($file))//(Adicionado recentemente) Se não encontrar o arquivo no camanho especificado retorna um erro pelo error handler, sem isso, errors no require_once não são 'pegos' pelo error handler
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
	//echo date("Y-m-d H:i:s");//Padrão para sql (Ano-mês-dia Hora-minuto-segundos)
	//Router
	$router = new App\Core\Router();
?>