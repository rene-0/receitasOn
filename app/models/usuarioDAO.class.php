<?php
	namespace App\Models;
	use PDO;
	class UsuarioDAO extends Conexao
	{
		function sysadmLogin($usuario)
		{
			$sql = "SELECT * FROM adm WHERE login = ?";
			
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$usuario->getEmail());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function sysadmTentativas($usuario)
		{
			$sql = "UPDATE adm SET tentativas = 0 WHERE id_adm = ?";
			
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$usuario->getId_usuario());
			$stm->execute();
		}
		
		function vereficarEmail($usuario)
		{
			$sql = "SELECT COUNT(id_usuario) 'qtd' FROM usuarios WHERE email = ?";
			
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$usuario->getEmail());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function inserir($usuario)
		{
			$sql = "INSERT INTO usuarios (nome,email,senha,nascimento) VALUES(?,?,?,?)";
			
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$usuario->getNome());
			$stm->bindValue(2,$usuario->getEmail());
			$stm->bindValue(3,password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
			$stm->bindValue(4,$usuario->getNascimento());
			$stm->execute();
		}
		
		function login($usuario)
		{
			$sql = "SELECT * FROM usuarios WHERE email = ?";
			
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$usuario->getEmail());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function tentativas($usuario)
		{
			$sql = "UPDATE usuarios SET tentativas = 0 WHERE id_usuario = ?";
			
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$usuario->getId_usuario());
			$stm->execute();
		}
		
		function buscarUsuario($usuario)
		{
			$sql = "SELECT *, DATE_FORMAT(nascimento,'%d/%m/%Y') 'nascimento' FROM usuarios WHERE id_usuario = ?";
			
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$usuario->getId_usuario());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
	}
?>