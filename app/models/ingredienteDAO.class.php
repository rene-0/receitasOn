<?php
	namespace App\Models;
	use PDO;//Importante
	class IngredienteDAO extends Conexao
	{
		function buscarPorReceita($receita)
		{
			$sql = "SELECT * FROM ingredientes WHERE id_receita = ? ORDER BY ordem";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$stm->execute();
			$ret = $stm->fetchAll(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function buscarPorEnvio($receita)
		{
			$sql = "SELECT * FROM u_ingredientes WHERE id_receita = ? ORDER BY ordem";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$stm->execute();
			$ret = $stm->fetchAll(PDO::FETCH_OBJ);
			return $ret;
		}
	}
?>