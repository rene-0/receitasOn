<?php
	namespace App\Core;
	
	class Error
	{
		//Função de loggar o erro
		private function logError($exception)
		{
			ini_set('error_log',dirname(__DIR__) . '\logs\\' . date('d-m-Y') . '.txt');
			$message = "Uncaught exception: '". get_class($exception) ."'";
			$message .= "Message: '". $exception->getMessage() ."'";
			$message .= "\nStack trace:". $exception->getTraceAsString() ."";
			$message .= "\nThrow in '". $exception->getFile() ."' on line ". $exception->getLine() ."\n";
			error_log($message);
		}
		
		//função que transforma erro em execeção
		public static function errorHandler($level, $message, $file, $line)
		{
			if(error_reporting() !== 0)
			{
				throw new \ErrorException($message, 0, $level, $file, $line);
			}
		}
		
		public static function exceptionHandler($exception)
		{
			if(\App\Core\Config::SHOW_ERRORS)
			{
				echo "<h1>Fatal error</h1>";
				echo "<p>Uncaught exception: '". get_class($exception) ."'</p>";
				echo "<p>Message: '". $exception->getMessage() ."'</p>";
				echo "<p>Stack trace:<pre>". $exception->getTraceAsString() ."</pre></p>";
				echo "<p>Throw in '". $exception->getFile() ."' on line ". $exception->getLine() ."</p>";
			}
			else
			{
				if($exception->getCode() == 404)
				{
					http_response_code(404);
					//echo $exception->getMessage();
					require_once("../app/views/error404.php");
				}
				else
				{
					http_response_code(500);
					(new self)->logError($exception);//Quando for necesáario referenciar a propria classe em uma função estatica usa-se (new self)-> em vez de $this->
					//echo "Deu um erro";
					require_once("../app/views/error.php");
				}
			}
		}
	}
?>