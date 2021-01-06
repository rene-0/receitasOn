<?php
	namespace App\Models;
	class Comentario
	{
		private $id_comentario;
		private $comentario;
		private $data;
		private $id_usuario;
		private $id_receita;
		
		function __construct($id_comentario = null, $comentario = null, $data = null, $id_usuario = null, $id_receita = null)
		{
			$this->id_comentario = $id_comentario;
			$this->comentario = $comentario;
			$this->data = $data;
			$this->id_usuario = $id_usuario;
			$this->id_receita = $id_receita;
		}
		
		//Get's
		function getId_comentario()
		{
			return $this->id_comentario;
		}
		
		function getComentario()
		{
			return $this->comentario;
		}
		
		function getData()
		{
			return $this->data;
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
		function setId_comentario($id_comentario)
		{
			$this->id_comentario = $id_comentario;
		}
		
		function setComentario($comentario)
		{
			if(is_string($comentario))
			{
				$comentario = trim($comentario);
				if(empty($comentario))
				{
					throw new \Exception('Comentario não pode ser vazio');
				}
				else
				{
					$comentario = $comentario;
				}
			}
			else
			{
				throw new \Exception('Comentario inválido');
			}
			
		}
		
		function setData($data)
		{
			$this->data = $data;
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
				throw new \Exception('Usuário inválido');
			}
			elseif(!ctype_digit((string)$id_receita))
			{
				throw new \Exception('Usuário inválido');
			}
			else
			{
				$this->id_receita = $id_receita;
			}
		}
	}
?>