<?php
	namespace App\Models;
	class ADM
	{
		private $id_adm;
		private $nome;
		private $login;
		private $senha;
		private $ativo;
		private $tentativas;
		
		function __construct($id_adm = null, $nome = null, $login = null, $senha = null, $ativo = null, $tentativas = null)
		{
			$this->id_adm = $id_adm;
			$this->nome = $nome;
			$this->login = $login;
			$this->senha = $senha;
			$this->ativo = $ativo;
			$this->tentativas = $tentativas;
		}
		
		//Get's
		function getId_adm()
		{
			return $this->id_adm;
		}
		
		function getNome()
		{
			return $this->nome;
		}
		
		function getLogin()
		{
			return $this->login;
		}
		
		function getSenha()
		{
			return $this->senha;
		}
		
		function getAtivo()
		{
			return $this->ativo;
		}
		
		function getTentativas()
		{
			return $this->tentativas;
		}
		
		//Set's
		function setId_adm($id_adm)
		{
			$this->id_adm = $id_adm;
		}
		
		function setNome($nome)
		{
			$this->nome = $nome;
		}
		
		function setLogin($login)
		{
			$this->login = $login;
		}
		
		function setSenha($senha)
		{
			$this->senha = $senha;
		}
		
		function setAtivo($ativo)
		{
			$this->ativo = $ativo;
		}
		
		function setTentativas($tentativas)
		{
			$this->tentativas = $tentativas;
		}
	}
?>