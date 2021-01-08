<?php
	namespace App\Models;
	class Ingrediente
	{
		private $id_ingrediente;
		private $ingrediente;
		private $ordem;
		private $id_receita;
		
		function __construct($id_ingrediente = null, $ingrediente = null, $ordem = null, $id_receita = null)
		{
			$this->id_ingrediente = $id_ingrediente;
			$this->ingrediente = $ingrediente;
			$this->ordem = $ordem;
			$this->id_receita = $id_receita;
		}
		
		//Get's
		function getId_ingrediente()
		{
			return $this->id_ingrediente;
		}
		
		function getIngrediente()
		{
			return $this->ingrediente;
		}
		
		function getOrdem()
		{
			return $this->ordem;
		}
		
		function getId_receita()
		{
			return $this->id_receita;
		}
		
		//Set's
		function setId_ingrediente($id_ingrediente)
		{
			$this->id_ingrediente = $id_ingrediente;
		}
		
		function setIngrediente($ingrediente)
		{
			if(is_string($ingrediente))
			{
				$ingrediente = trim($ingrediente);
				if(empty($ingrediente))
				{
					throw new \Exception('Ingrediente não pode ser vazio');
				}
				elseif(strlen($ingrediente) > 255)
				{
					throw new \Exception('Ingrediente não pode ser maio que 255 caracteres');
				}
				else
				{
					$this->ingrediente = $ingrediente;
				}
			}
			else
			{
				throw new \Exception('Ingrediente inválido');
			}
		}
		
		function setOrdem($ordem)
		{
			if(!ctype_digit((string)$ordem))//Testa se é inteiro
			{
				throw new \Exception('Ordem só pode ser um número inteiro não negativo');
			}
			elseif($ordem == 0)
			{
				throw new \Exception('Ordem não pode ser 0');
			}
			elseif($ordem > 99)
			{
				throw new \Exception('Ordem não pode ser maior que 99');
			}
			else
			{
				$this->ordem = $ordem;
			}
		}
		
		function setId_receita($id_receita)
		{
			$this->id_receita = $id_receita;
		}
	}
?>