<?php
	namespace App\Models;
	use PDO;//Importante
	class StarDAO extends Conexao
	{
		function inserir($star)
		{
			$sql = "INSERT INTO stars (star,id_receita,id_usuario) VALUES(?,?,?)";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$star->getRating());
			$stm->bindValue(2,$star->getId_receita());
			$stm->bindValue(3,$star->getId_usuario());
			$stm->execute();
		}
		
		function buscarMediaUm($star)
		{
			$sql = "SELECT AVG(star) FROM stars WHERE id_receita = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$star->getId_receita());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function alterar($star)
		{
			$sql = "UPDATE stars SET star = ? WHERE id_receita = ? AND id_usuario = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$star->getRating());
			$stm->bindValue(2,$star->getId_receita());
			$stm->bindValue(3,$star->getId_usuario());
			$stm->execute();
		}
		
		function vareficarAvaliacao($star)
		{
			$sql = "SELECT count(id_star) 'qtd' FROM stars WHERE id_receita = ? AND id_usuario = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$star->getId_receita());
			$stm->bindValue(2,$star->getId_usuario());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		//Busca a avaliação do usuário
		function avaliacaoUsuario($star)
		{
			$sql = "SELECT * FROM stars WHERE id_receita = ? AND id_usuario = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$star->getId_receita());
			$stm->bindValue(2,$star->getId_usuario());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
	}
?>