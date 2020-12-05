<?php
	namespace App\Models;
	class Star
	{
		private $id_star;
		private $rating;
		private $id_usuario;
		private $id_receita;
		
		function __construct($id_star = null, $rating = null, $id_usuario = null, $id_receita = null)
		{
			$this->id_star = $id_star;
			$this->rating = $rating;
			$this->id_usuario = $id_usuario;
			$this->id_receita = $id_receita;
		}
		
		//Get's
		function getId_star()
		{
			return $this->id_star;
		}
		
		function getRating()
		{
			return $this->rating;
		}
		
		function getId_usuario()
		{
			return $this->id_usuario;
		}
		
		function getId_receita()
		{
			return $this->id_receita;
		}
		
		//Set's
		
		function setRating($rating)
		{
			//$rating = round($rating, 1);
			if(!is_numeric($rating))
			{
				throw new \Exception('Avaliação inválida');
			}
			elseif($rating >= 5 || $rating <= 0)
			{
				throw new \Exception('Avaliação não pode ser maior que 5 nem menor que 0');
			}
			else
			{
				$this->rating = $rating;
			}
		}
		
		function setId_usuario($id_usuario)
		{
			if(!$id_usuario || $id_usuario === null)
			{
				throw new \Exception('Usuário inválido');
			}
			elseif(!ctype_digit((string)$id_usuario))
			{
				throw new \Exception('Usuário inválido');
			}
			else
			{
				$this->id_usuario = $id_usuario;
			}
		}
		
		function setId_receita($id_receita)
		{
			if(!$id_receita || $id_receita === null)
			{
				throw new \Exception('Receita inválida');
			}
			elseif(!ctype_digit((string)$id_receita))
			{
				throw new \Exception('Receita inválida');
			}
			else
			{
				$this->id_receita = $id_receita;
			}
		}
	}
?>