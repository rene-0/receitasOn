<?php
	namespace App\Models;
	use PDO;//Importante
	class FotoDAO extends Conexao
	{
		function buscarUmaFoto($foto)
		{
			$sql = "SELECT * FROM fotos WHERE id_foto = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$foto->getId_foto());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function buscarUmaFotoEnvio($foto)
		{
			$sql = "SELECT * FROM u_fotos WHERE id_foto = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$foto->getId_foto());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}

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

		function sysadmRemoverFoto($foto)
		{
			$sql = "DELETE FROM fotos WHERE id_receita = ? AND id_foto = ?";
			$this->getConec();
			Conexao::$conec->beginTransaction();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$foto->getId_receita());
			$stm->bindValue(2,$foto->getId_foto());
			$ret = $stm->execute();
			if(!$ret)
			{
				Conexao::$conec->rollBack();
				return false;
			}
			else
			{
				$base_dir = dirname(dirname(dirname(__FILE__)));//C:\xampp\htdocs\receitasOn
				$ex = explode('/',$foto->getCaminho());
				$file = "{$base_dir}\\public\\{$ex[count($ex)-2]}\\{$ex[count($ex)-1]}";//O aquivo que vai ser deletado
				if(file_exists($file))//Só deleta se ele existir
				{
					if(!unlink($file))
					{
						Conexao::$conec->rollBack();
						throw new \Exeception("Erro ao deletar imagem!");
					}
				}
				else
				{
					//Quando criar o logger - Colocar no log que o aquivo que está tentando ser deletado não existe
				}
				Conexao::$conec->commit();
				return $ret;
			}
		}

		function sysadmNovaCapa($foto)
		{
			$sql = "UPDATE fotos SET capa = 's' WHERE id_foto = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$foto->getId_foto());
			$ret = $stm->execute();
			return $ret;
		}

		function removerFoto($foto)
		{
			$sql = "DELETE FROM u_fotos WHERE id_receita = ? AND id_foto = ?";
			$this->getConec();
			Conexao::$conec->beginTransaction();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$foto->getId_receita());
			$stm->bindValue(2,$foto->getId_foto());
			$ret = $stm->execute();
			if(!$ret)
			{
				Conexao::$conec->rollBack();
				return false;
			}
			else
			{
				$base_dir = dirname(dirname(dirname(__FILE__)));//C:\xampp\htdocs\receitasOn
				$ex = explode('/',$foto->getCaminho());
				$file = "{$base_dir}\\public\\{$ex[count($ex)-2]}\\{$ex[count($ex)-1]}";//O aquivo que vai ser deletado
				if(file_exists($file))//Só deleta se ele existir
				{
					if(!unlink($file))
					{
						Conexao::$conec->rollBack();
						throw new \Exeception("Erro ao deletar imagem!");
					}
				}
				else
				{
					//Quando criar o logger - Colocar no log que o aquivo que está tentando ser deletado não existe
				}
				Conexao::$conec->commit();
				return $ret;
			}
		}

		function novaCapa($foto)
		{
			$sql = "UPDATE u_fotos SET capa = 's' WHERE id_foto = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$foto->getId_foto());
			$ret = $stm->execute();
			return $ret;
		}
	}
?>