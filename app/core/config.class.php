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
		
		//Desativado mostra uma messagem de erro generica (Produção), ativado mostra o erro detalhado (Desenvolvimento)
		const SHOW_ERRORS = true;
	}
?>