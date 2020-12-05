<?php
	namespace App\Models;
	
	class Model extends Conexao
	{
		protected $stm;
		
		function tester()
		{
			Conexao::getConec();//Cria a conexão se não existir uma, se já existir uma, usa a mesma, deve ser a primeira linha depois do try. Lembre-se Conexao::getConec(); só atribui a con

		}
	}
?>