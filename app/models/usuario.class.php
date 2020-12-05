<?php
	namespace App\Models;
	class Usuario
	{
		private $id_usuario;
		private $nome;
		private $email;
		private $senha;
		private $nascimento;
		private $criado;
		private $ativo;
		private $tentativas;
		
		function __construct($id_usuario = null, $nome = null, $email = null, $senha = null, $nascimento = null, $criado = null, $ativo = null, $tentativas = null)
		{
			$this->id_usuario = $id_usuario;
			$this->nome = $nome;
			$this->email = $email;
			$this->senha = $senha;
			$this->nascimento = $nascimento;
			$this->criado = $criado;
			$this->ativo = $ativo;
			$this->tentativas = $tentativas;
		}
		
		//Get's
		function getId_usuario()
		{
			return $this->id_usuario;
		}
		
		function getNome()
		{
			return $this->nome;
		}
		
		function getEmail()
		{
			return $this->email;
		}
		
		function getSenha()
		{
			return $this->senha;
		}
		
		function getNascimento()
		{
			return $this->nascimento;
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
		function setId_usuario($id_usuario)
		{
			$this->id_usuario = $id_usuario;
		}
		
		function setNome($nome)
		{
			$nome = trim($nome);
			if(empty($nome))
			{
				throw new \Exception('Nome não pode ser vazio');
			}
			elseif(strlen($nome) > 100)
			{
				throw new \Exception('Nome deve ser menor ou igual a 100 caracteres');
			}
			elseif(strlen($nome) < 4)
			{
				throw new \Exception('Nome deve ser maior que 3 caracteres');
			}
			else
			{
				$this->nome = $nome;
			}
			//$this->nome = $nome;
		}
		
		function setEmail($email)
		{
			$email = trim($email);
			if(empty($email))
			{
				throw new \Exception('E-mail não pode ser vazio');
			}
			elseif(strlen($email) > 100)
			{
				throw new \Exception('E-mail deve ser menor ou igual a 100 caracteres');
			}
			elseif(strlen($email) < 4)
			{
				throw new \Exception('E-mail deve ser maior que 3 caracteres');
			}
			elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				throw new \Exception('E-mail inválido');
			}
			else
			{
				$this->email = $email;
			}
			//$this->email = $email;
		}
		
		function setSenha($senha)
		{
			$senha = trim($senha);
			if(empty($senha))
			{
				throw new \Exception('Senha não pode ser vazio');
			}
			elseif(strlen($senha) > 250)
			{
				throw new \Exception('Senha deve ser menor ou igual a 250 caracteres');
			}
			// elseif(strlen($senha) < 4)
			// {
				// throw new \Exception('Nome deve ser maior que 3 caracteres');
			// }
			else
			{
				$this->senha = $senha;
			}
		}
		
		function setNascimento($nascimento)
		{
			$nascimento = trim($nascimento);
			$date = explode('-',$nascimento);
			//$date[0] = Ano, $date[1] = Mês, $date[2] = Dia
			//checkdate(Mês,Dia,Ano)
			if(empty($nascimento))
			{
				throw new \Exception('Data de nascimento não pode ser vazio');
			}
			elseif(!checkdate($date[1],$date[2],$date[0]))
			{
				throw new \Exception('Data inválida');
			}
			else
			{
				$this->nascimento = $nascimento;
			}
		}
		
		function setCriado($criado)
		{
			$this->criado = $criado;
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