<?php
	namespace App\Models;
	use PDO;//Importante
	class FotoDAO extends Conexao
	{
		function buscarPorReceita($receita)
		{
			$sql = "SELECT * FROM fotos WHERE id_receita = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$stm->execute();
			$ret = $stm->fetchAll(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function buscarPorEnvio($receita)
		{
			$sql = "SELECT * FROM u_fotos WHERE id_receita = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$stm->execute();
			$ret = $stm->fetchAll(PDO::FETCH_OBJ);
			return $ret;
		}
	}
?>