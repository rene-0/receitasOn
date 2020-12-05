<?php
	namespace App\Core;
	class Config
	{
		//Host do banco de dados
		const DB_HOST = 'localhost';
		
		//Nome do banco de dados
		const DB_NAME = 'receitasOn';
		//const DB_NAME = 'renede48_receitasOn';
		
		//Usuário do banco de dados
		const DB_USER = 'root';
		//const DB_USER = 'renede48_receita';
		
		//Senha do banco de dados
		const DB_PASSWORD = '';
		//const DB_PASSWORD = 'Receita$#';
		
		//Desativado mostra uma messagem de erro generica, ativado mostra o erro detalhado
		const SHOW_ERRORS = true;
		
		//Local de armazenamento de erros, se os erros estiverem ativados
		//ini_set('error_log',dirname(__DIR__) . '\logs\\' . date('d-m-Y') . '.txt');
	}
?>