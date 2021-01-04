<?php
    namespace App\Models;
    use PDO;//Importante
    class Backup extends Conexao
    {
        private $tabelas;
        private $arquivo;

        function __construct($tabelas, $arquivo)
        {
            $this->setTabelas($tabelas);
            $this->setArquivo($arquivo);
        }

        function getTabelas()
        {
            return $this->tabelas;
        }

        function getArquivo()
        {
            return $this->arquivo;
        }

        function setTabelas($tabelas)
        {
            if(is_array($tabelas))
            {
                $this->tabelas = $tabelas;
            }
            else
            {
                throw \Exception('Tabelas deve ser um array!');
            }
        }

        function setArquivo($arquivo)
        {
            if(is_string($arquivo) && $arquivo != '')
            {
                $this->arquivo = $arquivo;
            }
            else
            {
                throw \Exception('Arquivo deve ser uma string não vazia');
            }
        }
        
        function backUp()
        {
            $this->getConec();
			//$dbc = Conexao::$conec;
			//------------------------------------------------------
				//Se $tabelas estiver vazio, busca todas
				if(empty($this->tabelas))
				{
					$stm = Conexao::$conec->prepare('SHOW TABLES'); 
                    $stm->execute();
                    $this->setTabelas($stm->fetchAll(PDO::FETCH_NUM));
					//$tabelas = $stm->fetchAll(PDO::FETCH_NUM);
				}
				else//Caso contrário, refaz o array para ter o mesmo formato de PDO::FETCH_NUM
				{
					foreach($this->tabelas as $key => $dados)
					{
						$this->tabelas[$key] = array($dados);
					}
				}
			//------------------------------------------------------
			$conteudo = '';//Variável que vai armazenar todo o conteúdo do backup
			foreach($this->tabelas as $dados)
			{
				//Tabelas
					//Inserindo a estrutura das tabelas
					$stm = Conexao::$conec->prepare('SHOW CREATE TABLE '.$dados[0]); 
					$stm->execute();
					$ret = $stm->fetchAll(PDO::FETCH_NUM);
					$conteudo = $conteudo.$ret[0][1].';'.PHP_EOL.PHP_EOL;
				//Tabelas
				//Informações da tabela
					$stm = Conexao::$conec->prepare('SELECT * FROM '.$dados[0]); 
					$stm->execute();
					$table_rows = $stm->fetchAll(PDO::FETCH_NUM);
				//Informações da tabela
				//Insert para popular a tabela
					//Inicializando a variável que vai em VALUES
					$set = '';
					foreach($table_rows as $row)//Loop pelas linhas
					{
						$slaches = '';//Inicialização da variável
						foreach($row as $field)//Loop pelos campos adicionando aspas e virgulas
						{
							if($field == null)
							{
								$slaches .= "NULL, ";
							}
							else
							{
								$slaches .= "'{$field}', ";
							}
							//Retirando o último virgula e espaço
								$slaches = trim($slaches);
								$values = substr($slaches, 0, -1);
							//Retirando o último virgula e espaço
						}
						$set .= "({$values}), ".PHP_EOL;//Após terminar cerca com ( e )
					}
					//Retirando o último virgula e espaço. Ex: (1,2,3), (1,2,3), =   (1,2,3), (1,2,3)
						$set = trim($set);
						$set = substr($set, 0, -1);
					//Retirando o último virgula e espaço
					$conteudo .= "INSERT INTO {$dados[0]} VALUES {$set};".PHP_EOL.PHP_EOL;
				//Insert para popular a tabela
			}
			/*;
			echo "<pre>";
				echo $conteudo;
			echo "</pre>";
			*/
			$file = fopen($this->arquivo, "w+");
			//fwrite($file, pack("CCC",0xef,0xbb,0xbf));
			fwrite($file,$conteudo); 
            fclose($file);
            return $conteudo;
        }
    }
?>