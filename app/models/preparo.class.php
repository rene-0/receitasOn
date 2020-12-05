<?php
	namespace App\Models;
	class Preparo
	{
		private $id_preparo;
		private $preparo;
		private $ordem;
		private $id_receita;
		
		function __construct($id_preparo = null, $preparo = null, $ordem = null, $id_receita = null)
		{
			$this->id_preparo = $id_preparo;
			$this->setPreparo($preparo);
			$this->setOrdem($ordem);
			$this->id_receita = $id_receita;
		}
		
		//Get's
		function getId_preparo()
		{
			return $this->id_preparo;
		}
		
		function getPreparo()
		{
			return $this->preparo;
		}
		
		function getOrdem()
		{
			return $this->ordem;
		}
		
		function getId_receita()
		{
			return $this->preparo;
		}
		
		//Set's
		function setId_preparo($id_preparo)
		{
			$this->id_preparo = $id_preparo;
		}
		
		function setPreparo($preparo)
		{
			$preparo = trim($preparo);
			if(empty($preparo))
			{
				throw new \Exception('Preparo não pode ser vazio');
			}
			elseif(strlen($preparo) > 255)
			{
				throw new \Exception('Preparo não pode ser maio que 255 caracteres');
			}
			else
			{
				$this->preparo = $preparo;
			}
		}
		
		function setOrdem($ordem)
		{
			if(!ctype_digit((string)$ordem))
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