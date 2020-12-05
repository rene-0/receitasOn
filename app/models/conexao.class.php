<?php
	namespace App\Models;
	use PDO; //Classe do PDO ou use um '\' antes de criar a classe PDO
	use App\Core\Config; //Classe de configuração
	abstract class Conexao
	{
		protected static $conec = null;
		
		function __construct(){}
		
		protected static function getConec()
		{
			try
			{
				if(self::$conec === null)
				{
					$dns = "mysql:host=" . Config::DB_HOST . ";port=3306;dbname=" . Config::DB_NAME . ";charset=utf8mb4";
					self::$conec = new PDO($dns,Config::DB_USER,Config::DB_PASSWORD);
					self::$conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
		
		protected function killConec()
		{
			if(Conexao::$conec != null)
			{
				Conexao::$conec = null;
				$this->stm = null;
			}
		}
	}
?>