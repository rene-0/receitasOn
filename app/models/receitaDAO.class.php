<?php
	namespace App\Models;
	use PDO;//Importante
	class ReceitaDAO extends Conexao
	{
		function buscarUm($receita)
		{
			//$sql = "SELECT * FROM receitas WHERE id_receita = ?";
			$sql = "SELECT id_receita, titulo, temp_preparo, rendimento, adicionais, DATE_FORMAT(data_criacao,'%d/%m/%Y') 'data_criacao', DATE_FORMAT(data_modificacao,'%d/%m/%Y') 'data_modificacao', r.ativo,(20*IFNULL((SELECT AVG(star) FROM stars WHERE id_receita = r.id_receita),0)) 'estrelas', a.nome 'nome_adm', a.id_adm, u.nome 'nome_user'
			FROM receitas r 
			INNER JOIN adm a ON(r.id_adm = a.id_adm) 
			LEFT JOIN usuarios u ON(r.id_usuario = u.id_usuario)
			WHERE r.ativo = 's' AND r.id_receita = ?
			LIMIT 9";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function buscarTodos()
		{
			$sql = "SELECT * FROM receitas";
			try
			{
				$this->getConec();
				$stm = Conexao::$conec->prepare($sql);
				$stm->execute();
				$ret = $stm->fetchAll(PDO::FETCH_OBJ);
				return $ret;
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		
		function Home()
		{
			$sql = "SELECT r.id_receita, titulo, temp_preparo, rendimento, adicionais, DATE_FORMAT(data_criacao,'%d/%m/%Y') 'data_criacao', DATE_FORMAT(data_modificacao,'%d/%m/%Y') 'data_modificacao', r.ativo,(20*IFNULL((SELECT AVG(star) FROM stars WHERE id_receita = r.id_receita),0)) 'estrelas', a.nome 'nome_adm', u.nome 'nome_user', f.caminho 'capa'
			FROM receitas r 
			INNER JOIN adm a ON(r.id_adm = a.id_adm) 
			LEFT JOIN usuarios u ON(r.id_usuario = u.id_usuario)
            LEFT JOIN fotos f ON(r.id_receita = f.id_receita)
			WHERE r.ativo = 's' AND f.capa = 's'
			LIMIT 16";
			try
			{
				$this->getConec();
				$stm = Conexao::$conec->prepare($sql);
				$stm->execute();
				$ret = $stm->fetchAll(PDO::FETCH_OBJ);
				return $ret;
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		
		function buscarUltimos()
		{
			$sql = "SELECT r.id_receita, titulo, temp_preparo, rendimento, adicionais, DATE_FORMAT(data_criacao,'%d/%m/%Y') 'data_criacao', DATE_FORMAT(data_modificacao,'%d/%m/%Y') 'data_modificacao', r.ativo,(20*IFNULL((SELECT AVG(star) FROM stars WHERE id_receita = r.id_receita),0)) 'estrelas', a.nome 'nome_adm', u.nome 'nome_user', caminho
			FROM receitas r 
			INNER JOIN adm a ON(r.id_adm = a.id_adm) 
			LEFT JOIN usuarios u ON(r.id_usuario = u.id_usuario)
            INNER JOIN fotos f ON(f.id_receita = r.id_receita)
			WHERE r.ativo = 's' AND capa = 's'
			LIMIT 4";
			try
			{
				$this->getConec();
				$stm = Conexao::$conec->prepare($sql);
				$stm->execute();
				$ret = $stm->fetchAll(PDO::FETCH_OBJ);
				return $ret;
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		
		function buscarTodasReceitas()
		{
			$sql = "SELECT id_receita, titulo, temp_preparo, rendimento, adicionais, DATE_FORMAT(data_criacao,'%d/%m/%Y') 'data_criacao', DATE_FORMAT(data_modificacao,'%d/%m/%Y') 'data_modificacao', r.ativo,(20*IFNULL((SELECT AVG(star) FROM stars WHERE id_receita = r.id_receita),0)) 'estrelas', a.nome 'nome_adm', u.nome 'nome_user'
			FROM receitas r 
			INNER JOIN adm a ON(r.id_adm = a.id_adm) 
			LEFT JOIN usuarios u ON(r.id_usuario = u.id_usuario)
			WHERE r.ativo = 's'
			LIMIT 9";
			try
			{
				$this->getConec();
				$stm = Conexao::$conec->prepare($sql);
				$stm->execute();
				$ret = $stm->fetchAll(PDO::FETCH_OBJ);
				return $ret;
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		
		function pesquisarReceita($get = null, $page = null, $per_page = null)
		{
			//Paginação
			if($per_page === null){$per_page = 10;}//Para se eu esquecer de definir
			if($page === null){$page = 0;}//Para se eu esquecer de definir
			$on = $page*$per_page;
			//Cria o where
			$where = "";
			if(isset($get['titulo']) && !empty($get['titulo']))
			{
				$where .= "titulo LIKE :titulo AND ";
			}
			if(isset($get['data']) && !empty($get['data']))
			{
				$where .= "data_criacao = :data AND ";
			}
			$sql = "SELECT r.id_receita, titulo, temp_preparo, rendimento, adicionais, DATE_FORMAT(data_criacao,'%d/%m/%Y') 'data_criacao', DATE_FORMAT(data_modificacao,'%d/%m/%Y') 'data_modificacao', r.ativo,(20*IFNULL((SELECT AVG(star) FROM stars WHERE id_receita = r.id_receita),0)) 'estrelas', a.nome 'nome_adm', u.nome 'nome_user', caminho, f.nome 'nome_foto'
			FROM receitas r 
			INNER JOIN adm a ON(r.id_adm = a.id_adm) 
			LEFT JOIN usuarios u ON(r.id_usuario = u.id_usuario)
			INNER JOIN fotos f ON(f.id_receita = r.id_receita)
			WHERE {$where} r.ativo = 's' AND capa = 's'";
			
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			if(isset($get['titulo']) && !empty($get['titulo']))
			{
				$stm->bindValue(':titulo','%'.$get['titulo'].'%');
			}
			if(isset($get['data']) && !empty($get['data']))
			{
				$stm->bindValue("DATE_FORMAT(:data_criacao, '%Y-%m-%d')",$get['data']);
			}
			$stm->execute();
			$ret = $stm->fetchAll(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function paginas($get = null)
		{
			$where = "";
			if(isset($get['titulo']) && !empty($get['titulo']))
			{
				$where .= "titulo LIKE :titulo AND ";
			}
			if(isset($get['data']) && !empty($get['data']))
			{
				$where .= "data_criacao = :data AND ";
			}
			//$sql = "SELECT COUNT(r.id_receita) 'paginas' FROM receitas r INNER JOIN adm a ON(r.id_adm = a.id_adm) LEFT JOIN usuarios u ON(r.id_usuario = u.id_usuario) {$where}";
			$sql = "SELECT COUNT(id_receita) 'paginas' FROM receitas WHERE {$where} ativo = 's'";
			//echo $sql;
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			if(isset($get['titulo']) && !empty($get['titulo']))
			{
				$stm->bindValue(':titulo','%'.$get['titulo'].'%');
			}
			if(isset($get['data']) && !empty($get['data']))
			{
				$stm->bindValue("DATE_FORMAT(:data_criacao, '%Y-%m-%d')",$get['data']);
			}
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function sysadmPesquisarReceita($get = null,$page = null,$per_page = null)
		{
			//Paginação
			if($per_page === null){$per_page = 10;}//Para se eu esquecer de definir
			if($page === null){$page = 0;}//Para se eu esquecer de definir
			$on = $page*$per_page;
			//Paginação
			//Cria o where
			$where = "";
			if(isset($get['titulo']) && !empty($get['titulo']))
			{
				$where .= "titulo LIKE :titulo AND ";
			}
			if(isset($get['data']) && !empty($get['data']))
			{
				$where .= "data_criacao = :data AND ";
			}
			if(isset($get['criador']) && !empty($get['criador']))
			{
				$where .= "a.nome = :criadora OR u.nome = :criadoru AND ";
			}
			//Cria o where
			$sql = "SELECT id_receita, titulo, temp_preparo, rendimento, adicionais, DATE_FORMAT(data_criacao,'%d/%m/%Y') 'data_criacao', DATE_FORMAT(data_modificacao,'%d/%m/%Y') 'data_modificacao', r.ativo,(20*IFNULL((SELECT AVG(star) FROM stars WHERE id_receita = r.id_receita),0)) 'estrelas', a.nome 'nome_adm', u.nome 'nome_user'
			FROM receitas r 
			INNER JOIN adm a ON(r.id_adm = a.id_adm) 
			LEFT JOIN usuarios u ON(r.id_usuario = u.id_usuario)
			WHERE {$where} r.ativo = 's'
			LIMIT :on,:per_page";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			//Cria os bindValues
			if(isset($get['titulo']) && !empty($get['titulo']))
			{
				$stm->bindValue(':titulo','%'.$_GET['titulo'].'%');
			}
			if(isset($getT['data']) && !empty($get['data']))
			{
				$stm->bindValue(':data',$_GET['data']);
			}
			if(isset($get['criador']) && !empty($get['criador']))
			{
				$stm->bindValue(':criadora',$_GET['criador']);
				$stm->bindValue(':criadoru',$_GET['criador']);
			}
			$stm->bindValue(':on',$on, PDO::PARAM_INT);//Os parametros de LIMIT não podem ser strin, 		somente INT
			$stm->bindValue(':per_page',$per_page, PDO::PARAM_INT);//Os parametros de LIMIT não podem ser strin, somente INT
			//Cria os bindValues
			$stm->execute();
			$ret = $stm->fetchAll(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function sysadmPaginas($get = null)
		{
			$where = "";
			if($get != null && (!empty($get['titulo']) || !empty($get['data']) || !empty($get['criador'])))
			{
				$where .= "WHERE";
				if(isset($get['titulo']) && !empty($get['titulo']))
				{
					$where .= " titulo LIKE :titulo AND";
				}
				if(isset($get['data']) && !empty($get['data']))
				{
					$where .= " data_criacao = :data AND";
				}
				if(isset($get['criador']) && !empty($get['criador']))
				{
					$where .= " a.nome = :criadora OR u.nome = :criadoru AND";
				}
				$where = substr($where,0,-4);
			}
			$sql = "SELECT COUNT(r.id_receita) 'paginas' FROM receitas r INNER JOIN adm a ON(r.id_adm = a.id_adm) LEFT JOIN usuarios u ON(r.id_usuario = u.id_usuario) {$where}";
			//echo $sql;
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			if($get != null)
			{
				if(isset($get['titulo']) && !empty($get['titulo']))
				{
					$stm->bindValue(':titulo','%'.$_GET['titulo'].'%');
				}
				if(isset($getT['data']) && !empty($get['data']))
				{
					$stm->bindValue(':data',$_GET['data']);
				}
				if(isset($get['criador']) && !empty($get['criador']))
				{
					$stm->bindValue(':criadora',$_GET['criador']);
					$stm->bindValue(':criadoru',$_GET['criador']);
				}
			}
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function sysadmIncluir($receita,$usuario)
		{
			$sql = "INSERT INTO receitas (titulo,temp_preparo,rendimento,adicionais,id_adm,ativo) VALUES(?,?,?,?,?,?)";
			$this->getConec();
			Conexao::$conec->beginTransaction();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getTitulo());
			$stm->bindValue(2,$receita->getTempo_preparo());
			$stm->bindValue(3,$receita->getRendimento());
			$stm->bindValue(4,$receita->getAdicionais());
			$stm->bindValue(5,$usuario->getId_usuario());
			$stm->bindValue(6,'s');
			$ret = $stm->execute();
			$id_receita = Conexao::$conec->lastInsertId();
			if(!$ret)
			{
				Conexao::$conec->rollBack();
				throw new \Exception("Erro ao inserir receita");
				return false;//Se falhar
			}
			else
			{
				$sql = "INSERT INTO ingredientes (ingrediente,ordem,id_receita) VALUES(?,?,?)";
				foreach($receita->getIngredientes() as $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getIngrediente());
					$stm->bindValue(2,$dados->getOrdem());
					$stm->bindValue(3,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao inserir ingrediente");
						break;
						return false;//Se falhar
					}
				}
				$sql = "INSERT INTO preparo (preparo,ordem,id_receita) VALUES(?,?,?)";
				foreach($receita->getPreparos() as $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getPreparo());
					$stm->bindValue(2,$dados->getOrdem());
					$stm->bindValue(3,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao inserir preparo");
						break;
						return false;//Se falhar
					}
				}
				//Fotos banco de dados
				$sql = "INSERT INTO fotos (nome,caminho,capa,id_receita) VALUES(?,?,?,?)";
				foreach($receita->getFotos() as $key => $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getNome());
					$stm->bindValue(2, \App\Core\Router::getBaseUrl()."img/".basename($dados->getNome()));
					if($key == 0)
					{
						$stm->bindValue(3,'s');
					}
					else
					{
						$stm->bindValue(3,'n');
					}
					$stm->bindValue(4,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao inserir foto");
						break;
						return false;//Se falhar
					}
				}
				//Fotos arquvio
				//Se mover do upload se todo o metodo funcionar
				foreach($receita->getFotos() as $dados)
				{
					$ret = move_uploaded_file($dados->getCaminho(), "img/".basename($dados->getNome()));
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao mover arquivo");
						return false;//Se falhar
					}
				}
				Conexao::$conec->commit();
				return true;
			}
		}
		
		/*
			PARA REFERENCIAS FUTURAS SEPARA SQLs QUE SAO DE DAOs DEFERENTES EM SEUS RESPECTIVOS ARQUIVOS, PORE EXEMPLO PARA INSERIR INGREDINTES, CRIAR UMA FUNÇÃO QUE QUE INSIRA INGREDINTES NO ingredientesDAO E UTILIZA-LA AQUI EXTENENDO ingredientesDAO e usando prent::->inserirInrgediente. Tambem Não criar mais funçõe com somente inserir ou deletar, em vez disso, inserirReceita e deletarReceita
		*/
		function sysadmAlterar($receita,$usuario)
		{
			$this->getConec();
			Conexao::$conec->beginTransaction();
			/*
			*	Essa parte de deletar usa o mesmo código de deletar(), porem só a parte de ingredientes e preparo. Para deletar fotos uma função própria sera feita no DAO de fotos, comentários e stars não deve ser alterado.
			*/
			//Deleta antes de reinserir
				//É necessário deletar campos de ingredites, fotos, preparo, comentarios e stars antes
				$sql = "DELETE FROM ingredientes WHERE id_receita = ?";//Deleta ingredientes
				$stm = Conexao::$conec->prepare($sql);
				$stm->bindValue(1,$receita->getId_receita());
				$ret = $stm->execute();
				if(!$ret)
				{
					Conexao::$conec->rollBack();
					return false;
				}
				else
				{
					$sql = "DELETE FROM preparo WHERE id_receita = ?";//Deleta modo de preparo
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$receita->getId_receita());
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						return false;
					}
				}
			//Deleta antes de reinserir
			$sql = "UPDATE receitas SET titulo = ?,temp_preparo = ?,rendimento = ?, adicionais = ? WHERE id_receita = ?";
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getTitulo());
			$stm->bindValue(2,$receita->getTempo_preparo());
			$stm->bindValue(3,$receita->getRendimento());
			$stm->bindValue(4,$receita->getAdicionais());
			$stm->bindValue(5,$receita->getId_receita());
			$ret = $stm->execute();
			$id_receita = $receita->getId_receita();
			if(!$ret)
			{
				Conexao::$conec->rollBack();
				throw new \Exception("Erro ao inserir receita");
				return false;//Se falhar
			}
			else
			{
				$sql = "INSERT INTO ingredientes (ingrediente,ordem,id_receita) VALUES(?,?,?)";
				foreach($receita->getIngredientes() as $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getIngrediente());
					$stm->bindValue(2,$dados->getOrdem());
					$stm->bindValue(3,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao inserir ingrediente");
						break;
						return false;//Se falhar
					}
				}
				$sql = "INSERT INTO preparo (preparo,ordem,id_receita) VALUES(?,?,?)";
				foreach($receita->getPreparos() as $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getPreparo());
					$stm->bindValue(2,$dados->getOrdem());
					$stm->bindValue(3,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao inserir preparo");
						break;
						return false;//Se falhar
					}
				}
				//Fotos banco de dados
				$sql = "INSERT INTO fotos (nome,caminho,capa,id_receita) VALUES(?,?,?,?)";
				foreach($receita->getFotos() as $key => $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getNome());
					$stm->bindValue(2, \App\Core\Router::getBaseUrl()."img/".basename($dados->getNome()));
					$stm->bindValue(3,'n');
					$stm->bindValue(4,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao inserir foto");
						break;
						return false;//Se falhar
					}
				}
				//Fotos arquvio
				//Se mover do upload se todo o metodo funcionar
				foreach($receita->getFotos() as $dados)
				{
					$ret = move_uploaded_file($dados->getCaminho(), "img/".basename($dados->getNome()));
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao mover arquivo");
						return false;//Se falhar
					}
				}
				Conexao::$conec->commit();
				return true;
			}
		}
		
		//ERRADO, DEVERIA ESTAR EM fotoDAO (CRIAR UM) - Feito
		//REMOVER E TESTAR ONDE ERA USADO
		function buscarFotos($receita)
		{
			$sql = "SELECT * FROM fotos WHERE id_receita = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$stm->execute();
			$ret = $stm->fetchAll(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function deletar($receita)
		{
			// É necessário deletar campos de ingredites, fotos, preparo, comentarios e stars antes
			$sql = "DELETE FROM ingredientes WHERE id_receita = ?";//Deleta ingredientes
			$this->getConec();
			Conexao::$conec->beginTransaction();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$ret = $stm->execute();
			if(!$ret)
			{
				Conexao::$conec->rollBack();
				return false;
			}
			else
			{
				$sql = "DELETE FROM preparo WHERE id_receita = ?";//Deleta modo de preparo
				$stm = Conexao::$conec->prepare($sql);
				$stm->bindValue(1,$receita->getId_receita());
				$ret = $stm->execute();
				if(!$ret)
				{
					Conexao::$conec->rollBack();
					return false;
				}
				else
				{
					//Antes de deletar as fotos do banco de dados, busca elas para poder remove-las no servidor
					$fotos = $this->buscarFotos($receita);
					$sql = "DELETE FROM fotos WHERE id_receita = ?";//Deleta as fotos
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$receita->getId_receita());
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						return false;
					}
					else
					{
						$sql = "DELETE FROM stars WHERE id_receita = ?";//Deleta as avaliações
						$stm = Conexao::$conec->prepare($sql);
						$stm->bindValue(1,$receita->getId_receita());
						$ret = $stm->execute();
						if(!$ret)
						{
							Conexao::$conec->rollBack();
							return false;
						}
						else
						{
							$sql = "DELETE FROM comentarios WHERE id_receita = ?";//Deleta os comentários
							$stm = Conexao::$conec->prepare($sql);
							$stm->bindValue(1,$receita->getId_receita());
							$ret = $stm->execute();
							if(!$ret)
							{
								Conexao::$conec->rollBack();
								return false;
							}
							else
							{
								$sql = "DELETE FROM receitas WHERE id_receita = ?";//Deleta a própria receita
								$stm = Conexao::$conec->prepare($sql);
								$stm->bindValue(1,$receita->getId_receita());
								$ret = $stm->execute();
								if(!$ret)
								{
									Conexao::$conec->rollBack();
									return false;
								}
								else
								{
									//Se tudo deu certo remove as fotos
									foreach($fotos as $key => $dados)
									{
										$base_dir = dirname(dirname(dirname(__FILE__)));//C:\xampp\htdocs\receitasOn
										$ex = explode('/',$dados->caminho);
										$file = "{$base_dir}\\public\\{$ex[count($ex)-2]}\\{$ex[count($ex)-1]}";//O aquivo que vai ser deletado
										if(file_exists($file))//Só deleta se ele existir
										{
											if(!unlink($file))
											{
												throw new \Exeception("Erro ao deletar imagem!");
											}
										}
										else
										{
											//Quando criar o logger - Colocar no log que o aquivo que está tentando ser deletado não existe
										}
									}
									Conexao::$conec->commit();
									return true;
								}
							}
						}
					}
				}
			}
			//$sql = "DELETE FROM receitas WHERE id_receita = ?";
			//Depois de deletar a receita, remover as fotos da receita
		}
		
		function receitasUsuario($usuario)
		{
			$sql = "SELECT *, DATE_FORMAT(data_criacao,'%d/%m/%Y') 'data_criacao' FROM u_receitas r
			INNER JOIN u_fotos f ON(r.id_receita = f.id_receita)
			WHERE id_usuario = ? AND capa = 's'";
			
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$usuario->getId_usuario());
			$stm->execute();
			$ret = $stm->fetchAll(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function usuarioEnviar($receita,$usuario)
		{
			$sql = "INSERT INTO u_receitas (titulo,temp_preparo,rendimento,adicionais,id_usuario,ativo,status) VALUES(?,?,?,?,?,?,?)";
			$this->getConec();
			Conexao::$conec->beginTransaction();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getTitulo());
			$stm->bindValue(2,$receita->getTempo_preparo());
			$stm->bindValue(3,$receita->getRendimento());
			$stm->bindValue(4,$receita->getAdicionais());
			$stm->bindValue(5,$usuario->getId_usuario());
			$stm->bindValue(6,'s');
			$stm->bindValue(7,'ANÁLIZE');
			$ret = $stm->execute();
			$id_receita = Conexao::$conec->lastInsertId();
			if(!$ret)
			{
				Conexao::$conec->rollBack();
				//trigger_error("Erro ao inserir receita", E_USER_ERROR);
				throw new \Exception("Erro ao inserir receita");
				return false;//Se falhar
			}
			else
			{
				$sql = "INSERT INTO u_ingredientes (ingrediente,ordem,id_receita) VALUES(?,?,?)";
				foreach($receita->getIngredientes() as $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getIngrediente());
					$stm->bindValue(2,$dados->getOrdem());
					$stm->bindValue(3,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						//trigger_error("Erro ao inserir ingrediente", E_USER_ERROR);
						throw new \Exception("Erro ao inserir ingrediente");
						break;
						return false;//Se falhar
					}
				}
				$sql = "INSERT INTO u_preparo (preparo,ordem,id_receita) VALUES(?,?,?)";
				foreach($receita->getPreparos() as $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getPreparo());
					$stm->bindValue(2,$dados->getOrdem());
					$stm->bindValue(3,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						//trigger_error("Erro ao inserir preparo", E_USER_ERROR);
						throw new \Exception("Erro ao inserir preparo");
						break;
						return false;//Se falhar
					}
				}
				//Fotos banco de dados
				$sql = "INSERT INTO u_fotos (nome,caminho,capa,id_receita) VALUES(?,?,?,?)";
				foreach($receita->getFotos() as $key => $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getNome());
					$stm->bindValue(2, \App\Core\Router::getBaseUrl()."img/".basename($dados->getNome()));
					if($key == 0)
					{
						$stm->bindValue(3,'s');
					}
					else
					{
						$stm->bindValue(3,'n');
					}
					$stm->bindValue(4,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						//trigger_error("Erro ao inserir foto", E_USER_ERROR);
						throw new \Exception("Erro ao inserir foto");
						break;
						return false;//Se falhar
					}
				}
				//Fotos arquvio
				//Se mover do upload se todo o metodo funcionar
				foreach($receita->getFotos() as $dados)
				{
					$ret = move_uploaded_file($dados->getCaminho(), "img/".basename($dados->getNome()));
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						//trigger_error("Erro ao mover arquivo", E_USER_ERROR);
						throw new \Exception("Erro ao mover arquivo");
						return false;//Se falhar
					}
				}
				Conexao::$conec->commit();
				return true;
			}
		}
		
		function sysadmPesquisarEnvios($get = null,$page = null,$per_page = null)
		{
			//Paginação
			if($per_page === null){$per_page = 10;}//Para se eu esquecer de definir
			if($page === null){$page = 0;}//Para se eu esquecer de definir
			$on = $page*$per_page;
			//Paginação
			//Cria o where
			$where = "";
			if(isset($get['titulo']) && !empty($get['titulo']))
			{
				$where .= "titulo LIKE :titulo AND ";
			}
			if(isset($get['data']) && !empty($get['data']))
			{
				$where .= "data_criacao = :data AND ";
			}
			if(isset($get['criador']) && !empty($get['criador']))
			{
				$where .= "u.nome = :criadoru AND ";
			}
			//Cria o where
			$sql = "SELECT id_receita, titulo, temp_preparo, rendimento, adicionais, DATE_FORMAT(data_criacao,'%d/%m/%Y') 'data_criacao', DATE_FORMAT(data_modificacao,'%d/%m/%Y') 'data_modificacao', r.ativo,(20*IFNULL((SELECT AVG(star) FROM stars WHERE id_receita = r.id_receita),0)) 'estrelas', u.nome, r.status
			FROM u_receitas r 
			INNER JOIN usuarios u ON(r.id_usuario = u.id_usuario)
			WHERE {$where} r.ativo = 's'
			LIMIT :on,:per_page";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			//Cria os bindValues
			if(isset($get['titulo']) && !empty($get['titulo']))
			{
				$stm->bindValue(':titulo','%'.$_GET['titulo'].'%');
			}
			if(isset($getT['data']) && !empty($get['data']))
			{
				$stm->bindValue(':data',$_GET['data']);
			}
			if(isset($get['criador']) && !empty($get['criador']))
			{
				$stm->bindValue(':criadoru',$_GET['criador']);
			}
			$stm->bindValue(':on',$on, PDO::PARAM_INT);//Os parametros de LIMIT não podem ser strin, 		somente INT
			$stm->bindValue(':per_page',$per_page, PDO::PARAM_INT);//Os parametros de LIMIT não podem ser strin, somente INT
			//Cria os bindValues
			$stm->execute();
			$ret = $stm->fetchAll(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function sysadmEnviosPaginas($get = null)
		{
			$where = "";
			if($get != null && (!empty($get['titulo']) || !empty($get['data']) || !empty($get['criador'])))
			{
				$where .= "WHERE";
				if(isset($get['titulo']) && !empty($get['titulo']))
				{
					$where .= " titulo LIKE :titulo AND";
				}
				if(isset($get['data']) && !empty($get['data']))
				{
					$where .= " data_criacao = :data AND";
				}
				if(isset($get['criador']) && !empty($get['criador']))
				{
					$where .= "u.nome = :criadoru AND";
				}
				$where = substr($where,0,-4);
			}
			$sql = "SELECT COUNT(r.id_receita) 'paginas' FROM u_receitas r INNER JOIN usuarios u ON(r.id_usuario = u.id_usuario) {$where}";
			//echo $sql;
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			if($get != null)
			{
				if(isset($get['titulo']) && !empty($get['titulo']))
				{
					$stm->bindValue(':titulo','%'.$_GET['titulo'].'%');
				}
				if(isset($getT['data']) && !empty($get['data']))
				{
					$stm->bindValue(':data',$_GET['data']);
				}
				if(isset($get['criador']) && !empty($get['criador']))
				{
					$stm->bindValue(':criadoru',$_GET['criador']);
				}
			}
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		//Envios
		
		function buscarUmEnvio($receita)
		{
			$sql = "SELECT r.id_receita, titulo, temp_preparo, rendimento, adicionais, status, DATE_FORMAT(data_criacao,'%d/%m/%Y') 'data_criacao', DATE_FORMAT(data_modificacao,'%d/%m/%Y') 'data_modificacao', r.ativo,(20*IFNULL((SELECT AVG(star) FROM stars WHERE id_receita = r.id_receita),0)) 'estrelas', u.nome, r.id_usuario, uf.caminho, uf.capa
			FROM u_receitas r 
			INNER JOIN usuarios u ON(r.id_usuario = u.id_usuario)
            INNER JOIN u_fotos uf ON(uf.id_receita = r.id_receita)
			WHERE r.ativo = 's' AND r.id_receita = ? AND capa = 's'";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function buscarReceitaPorEnvio($receita)
		{
			$sql = "SELECT r.* FROM receitas r INNER JOIN u_receitas ur ON(r.id_ureceita = ur.id_receita) WHERE ur.id_receita = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$stm->execute();
			$ret = $stm->fetch(PDO::FETCH_OBJ);
			return $ret;
		}
		
		function aceitarReceita($receita,$adm,$usuario)
		{
			$sql = "INSERT INTO receitas (titulo,temp_preparo,rendimento,adicionais,id_adm,ativo,id_usuario,id_ureceita) VALUES(?,?,?,?,?,?,?,?)";
			$this->getConec();
			Conexao::$conec->beginTransaction();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getTitulo());
			$stm->bindValue(2,$receita->getTempo_preparo());
			$stm->bindValue(3,$receita->getRendimento());
			$stm->bindValue(4,$receita->getAdicionais());
			$stm->bindValue(5,$adm->getId_usuario());
			$stm->bindValue(6,'s');
			$stm->bindValue(7,$usuario->getId_usuario());
			$stm->bindValue(8,$receita->getId_receita());//id_receita da tabela u_receitas
			$ret = $stm->execute();
			$id_receita = Conexao::$conec->lastInsertId();
			if(!$ret)
			{
				Conexao::$conec->rollBack();
				throw new \Exception("Erro ao inserir receita");
				return false;//Se falhar
			}
			else
			{
				$sql = "INSERT INTO ingredientes (ingrediente,ordem,id_receita) VALUES(?,?,?)";
				foreach($receita->getIngredientes() as $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getIngrediente());
					$stm->bindValue(2,$dados->getOrdem());
					$stm->bindValue(3,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao inserir ingrediente");
						break;
						return false;//Se falhar
					}
				}
				$sql = "INSERT INTO preparo (preparo,ordem,id_receita) VALUES(?,?,?)";
				foreach($receita->getPreparos() as $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getPreparo());
					$stm->bindValue(2,$dados->getOrdem());
					$stm->bindValue(3,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao inserir preparo");
						break;
						return false;//Se falhar
					}
				}
				//Fotos banco de dados
				$sql = "INSERT INTO fotos (nome,caminho,capa,id_receita) VALUES(?,?,?,?)";
				foreach($receita->getFotos() as $key => $dados)
				{
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$dados->getNome());
					$stm->bindValue(2, \App\Core\Router::getBaseUrl()."img/".basename($dados->getNome()));
					if($key == 0)
					{
						$stm->bindValue(3,'s');
					}
					else
					{
						$stm->bindValue(3,'n');
					}
					$stm->bindValue(4,$id_receita);
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						throw new \Exception("Erro ao inserir foto");
						break;
						return false;//Se falhar
					}
				}
				//Fotos arquvio
				$sql = "UPDATE u_receitas SET status = 'ACEITO' WHERE id_receita = ?";
				$this->getConec();
				$stm = Conexao::$conec->prepare($sql);
				$stm->bindValue(1,$receita->getId_receita());
				$stm->execute();
				Conexao::$conec->commit();
				return true;
			}
		}
		
		function recusarReceita($receita)
		{
			$sql = "UPDATE u_receitas SET status = 'RECUSADO' WHERE id_receita = ?";
			$this->getConec();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$ret = $stm->execute();
			return $ret;
		}
		/**
		* Esse remove o envio e sua receita relacionada. Essa aplicação contem um erro em seu UML, u_receitas e componentes deveria ter uma classe de Envio.
		*/
		function deletarEnvio($receita,$id_ureceita)
		{
			$ret = $this->deletar($receita);
			if($ret)
			{
				$sql = "UPDATE u_receitas SET status = 'REMOVIDO' WHERE id_receita = ?";
				$this->getConec();
				$stm = Conexao::$conec->prepare($sql);
				$stm->bindValue(1,$id_ureceita);
				$ret = $stm->execute();
				return $ret;
			}
		}
		
		function deletarUreceita($receita)
		{
			// É necessário deletar campos de ingredites, fotos, preparo, comentarios e stars antes
			$sql = "DELETE FROM u_ingredientes WHERE id_receita = ?";//Deleta ingredientes
			$this->getConec();
			Conexao::$conec->beginTransaction();
			$stm = Conexao::$conec->prepare($sql);
			$stm->bindValue(1,$receita->getId_receita());
			$ret = $stm->execute();
			if(!$ret)
			{
				Conexao::$conec->rollBack();
				return false;
			}
			else
			{
				$sql = "DELETE FROM u_preparo WHERE id_receita = ?";//Deleta modo de preparo
				$stm = Conexao::$conec->prepare($sql);
				$stm->bindValue(1,$receita->getId_receita());
				$ret = $stm->execute();
				if(!$ret)
				{
					Conexao::$conec->rollBack();
					return false;
				}
				else
				{
					//Antes de deletar as fotos do banco de dados, busca elas para poder remove-las no servidor
					$fotos = $this->buscarFotos($receita);
					$sql = "DELETE FROM u_fotos WHERE id_receita = ?";//Deleta as fotos
					$stm = Conexao::$conec->prepare($sql);
					$stm->bindValue(1,$receita->getId_receita());
					$ret = $stm->execute();
					if(!$ret)
					{
						Conexao::$conec->rollBack();
						return false;
					}
					else
					{
						$sql = "DELETE FROM u_receitas WHERE id_receita = ?";//Deleta a própria receita
						$stm = Conexao::$conec->prepare($sql);
						$stm->bindValue(1,$receita->getId_receita());
						$ret = $stm->execute();
						if(!$ret)
						{
							Conexao::$conec->rollBack();
							return false;
						}
						else
						{
							//Se tudo deu certo remove as fotos
							foreach($fotos as $key => $dados)
							{
								$base_dir = dirname(dirname(dirname(__FILE__)));//C:\xampp\htdocs\receitasOn
								$ex = explode('/',$dados->caminho);
								$file = "{$base_dir}\\public\\{$ex[count($ex)-2]}\\{$ex[count($ex)-1]}";//O aquivo que vai ser deletado
								if(file_exists($file))//Só deleta se ele existir
								{
									if(!unlink($file))
									{
										throw new \Exeception("Erro ao deletar imagem!");
										return false;
									}
								}
								else
								{
									//Quando criar o logger - Colocar no log que o aquivo que está tentando ser deletado não existe
								}
							}
							Conexao::$conec->commit();
							return true;
						}
					}
				}
			}
		}
	}
?>