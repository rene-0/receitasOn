<?php
	namespace App\Models;
	class Foto
	{
		private $id_foto;
		private $nome;
		private $caminho;
		private $id_receita;
		
		function __construct($id_foto = null, $nome = null, $caminho = null, $id_receita = null)
		{
			$this->id_foto = $id_foto;
			$this->nome = $nome;
			$this->caminho = $caminho;
			$this->id_receita = $id_receita;
		}
		
		//Get's
		function getId_foto()
		{
			return $this->id_foto;
		}
		
		function getNome()
		{
			return $this->nome;
		}
		
		function getCaminho()
		{
			return $this->caminho;
		}
		
		function getId_receita()
		{
			return $this->id_receita;
		}
		
		//Set'scandir
		function setId_foto($id_foto)
		{
			$this->id_foto = $id_foto;
		}
		
		function setNome($nome)
		{
			$nome = trim($nome);
			if(empty($nome))
			{
				throw new \Exception('Nome não pode ser vazio');
			}
			elseif(strlen($nome) > 255)
			{
				throw new \Exception('Nome não pode ser maio que 255 caracteres');
			}
			else
			{
				$this->nome = $nome;
			}
		}
		
		function setCaminho($caminho)
		{
			$caminho = trim($caminho);
			if(empty($caminho))
			{
				throw new \Exception('Caminho não pode ser vazio');
			}
			elseif(strlen($caminho) > 255)
			{
				throw new \Exception('Caminho não pode ser maio que 255 caracteres');
			}
			else
			{
				$this->caminho = $caminho;
			}
		}
		
		function setId_receita($id_receita)
		{
			$this->id_receita = $id_receita;
		}
	}
?>