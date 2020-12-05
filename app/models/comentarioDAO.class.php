<?php
	namespace App\Models;
	use PDO;//Importante
	class ComentarioDAO extends Conexao
	{
		function buscarPorReceita($receita)
		{
			$sql = "SELECT * FROM comentarios c INNER JOIN usuarios u ON(c.id_usuario = u.id_usuario) WHERE c.id_receita = ? ORDER BY c.id_comentario DESC";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$stm->execute();
			$ret = $stm->fetchAll(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function inserir($comentario)
		{
			$sql = "INSERT INTO comentarios (comentario,id_receita,id_usuario) VALUES (?,?,?)";
			try
			{
				$this->getConec();
				$stm = Conexao::$conec->prepare($sql);
				$stm->bindValue(1,$comentario->getComentario());
				$stm->bindValue(2,$comentario->getId_receita());
				$stm->bindValue(3,$comentario->getId_usuario());
				$ret = $stm->execute();
				if($ret)
				{
					$sql = "SELECT c.comentario, c.data, u.nome FROM comentarios c INNER JOIN usuarios u ON(c.id_usuario = u.id_usuario) WHERE c.id_comentario = ?";
					$this->getConec();
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,Conexao::$conec->lastInsertId());
					$stm->execute();
					$ret = $stm->fetch(PDO::FETCH_OBJ);
					return $ret;
				}
				else
				{
					throw new \Exception("Erro ao inserir comentário");
				}
			}
			catch(\Exception $e)
			{
				echo "Erro ao inserir comentário";
			}
		}
	}
?>