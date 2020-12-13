<?php
	namespace App\Models;
	class Receita
	{
		private $id_receita;
		private $titulo;
		private $tempo_preparo;
		private $rendimento;
		private $adicionais;
		private $data_criacao;
		private $data_modificacao;
		private $ativo;
		private $id_adm;
		private $id_usuario;
		private $ingredientes;
		private $preparo;
		private $foto;
		private $status;
		
		function __construct($id_receita = null, $titulo = null, $tempo_preparo = null, $rendimento = null, $adicionais = null, $data_criacao = null, $data_modificacao = null, $ativo = null, $id_adm = null, $id_usuario = null)
		{
			$this->id_receita = $id_receita;
			$this->titulo = $titulo;
			$this->tempo_preparo = $tempo_preparo;
			$this->rendimento = $rendimento;
			$this->adicionais = $adicionais;
			$this->data_criacao = $data_criacao;
			$this->data_modificacao = $data_modificacao;
			$this->ativo = $ativo;
			$this->id_adm = $id_adm;
			$this->id_usuario = $id_usuario;
		}
		
		//Get's
		function getId_receita()
		{
			return $this->id_receita;
		}
		
		function getTitulo()
		{
			return $this->titulo;
		}
		
		function getTempo_preparo()
		{
			return $this->tempo_preparo;
		}
		
		function getRendimento()
		{
			return $this->rendimento;
		}
		
		function getAdicionais()
		{
			return $this->adicionais;
		}
		
		function getData_criacao()
		{
			return $this->data_criacao;
		}
		
		function getData_modificacao()
		{
			return $this->data_modificacao;
		}
		
		function getAtivo()
		{
			return $this->ativo;
		}
		
		function getId_adm()
		{
			return $this->id_adm;
		}
		
		function getId_usuario()
		{
			return $this->id_usuario;
		}
		
		function getIngredientes()
		{
			return $this->ingredientes;
		}
		
		function getPreparos()
		{
			return $this->preparo;
		}
		
		function getFotos()
		{
			return $this->foto;
		}

		function getStatus()
		{
			return $this->status;
		}
		//Set's
		function setId_receita($id_receita)
		{
			if(!ctype_digit((string)$id_receita))
			{
				throw new \Exception('Usuário inválido');
			}
			else
			{
				$this->id_receita = $id_receita;
			}
		}
		
		/*
			Para usar exceções criadas por usuário e não ser carregadas pelo autoloader usa-se \Exception
		*/
		
		function setTitulo($titulo)
		{
			$titulo = trim($titulo);
			if(empty($titulo))
			{
				throw new \Exception('Titulo não pode ser vazio');
			}
			elseif(strlen($titulo) > 150)
			{
				throw new \Exception('Titulo deve ser menor ou igual a 150 caracteres');
			}
			elseif(strlen($titulo) < 4)
			{
				throw new \Exception('Titulo deve ser maior que 3 caracteres');
			}
			else
			{
				$this->titulo = $titulo;
			}
		}
		
		function setTempo_preparo($tempo_preparo)
		{
			$tempo_preparo = trim($tempo_preparo);
			if(empty($tempo_preparo))
			{
				throw new \Exception('Tempo de preparo não pode ser vazio');
			}
			elseif(strlen($tempo_preparo) > 50)
			{
				throw new \Exception('Tempo de preparo deve ser menor ou igual a 50 caracteres');
			}
			else
			{
				$this->tempo_preparo = $tempo_preparo;
			}
		}
		
		function setRendimento($rendimento)
		{
			$rendimento = trim($rendimento);
			if(empty($rendimento))
			{
				throw new \Exception('Rendimento não pode ser vazio');
			}
			elseif(strlen($rendimento) > 50)
			{
				throw new \Exception('Rendimento deve ser menor ou igual a 50 caracteres');
			}
			else
			{
				$this->rendimento = $rendimento;
			}
		}
		
		function setAdicionais($adicionais)
		{
			$adicionais = trim($adicionais);
			if(strlen($adicionais) > 15535)
			{
				throw new \Exception('Informações adicionais muito grande');
			}
			else
			{
				$this->adicionais = $adicionais;
			}
		}
		
		function setdata_criacao($data_criacao)
		{
			$this->data_criacao = $data_criacao;
		}
		
		function setData_modificacao($data_modificacao)
		{
			$this->data_modificacao = $data_modificacao;
		}
		
		function setAtivo($ativo)
		{
			$this->ativo = $ativo;
		}
		
		function setId_adm($id_adm)
		{
			$this->id_adm = $id_adm;
		}
		
		function setId_usuario($id_usuario)
		{
			$this->id_usuario = $id_usuario;
		}

		function setStatus($status)
		{
			if($status === 'ACEITO' || $status === 'RECUSADO' || $status === 'ANÁLIZE' || $status === 'REMOVIDO')
			{
				$this->status = $status;
			}
			else
			{
				throw new \Exception('Status inválido!');
			}
		}
		
		function setIngredientes($id_ingrediente,$ingrediente,$ordem,$id_receita)
		{
			//Não tem tem necessidade de colocar o namespace de ingrediente pois é o mesmo de receita e o php procura por classes relativo ao namespace atual 'App\Models'
			$this->ingredientes[] = new Ingrediente($id_ingrediente,$ingrediente,$ordem,$id_receita);
		}
		
		function setPreparo($id_preparo,$preparo,$ordem,$id_receita)
		{
			$this->preparo[] = new Preparo($id_preparo,$preparo,$ordem,$id_receita);
		}
		
		function setFoto($id_foto, $nome, $caminho, $id_receita)
		{
			$this->foto[] = new Foto($id_foto, $nome, $caminho, $id_receita);
		}
	}
?>