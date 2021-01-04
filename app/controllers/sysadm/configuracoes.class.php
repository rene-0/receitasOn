<?php
	namespace App\Controllers\Sysadm;
	class Configuracoes extends Controller
	{
		function __call($name, $args)
		{
			$this->before();//Codigo antes do method ser achamado
			call_user_func_array([$this, $name], $args);
			$this->after();//Codigo depois do method ser achamado
		}
		
		protected function before()
		{
			//echo "Antes";
			//Teste de login
			parent::before();
		}
		
		protected function after()
		{
			//echo "Depois";
		}
		
		protected function index()
		{
			//var_dump(dirname(dirname(__DIR__)) . '\backups');
			//Escaneia o diretório backups, remove os pontos que vem por padrão e re-arruma os indexs do array 
			$folders = array_diff(scandir(dirname(dirname(__DIR__)) . '\backups'), array('..', '.'));
			foreach($folders as $key => $dados)
			{
				if(substr($dados,-4) !== '.sql')
				{
					unset($folders[$key]);
				}
			}
			$folders = array_values($folders);
			//var_dump($folders);
			require_once('../app/views/sysadm/configuracoes.php');
		}

		protected function backup()
		{
			header('Content-type: application/json');
			try
			{
				$arquivo = dirname(dirname(__DIR__)) . '\backups\backup-receitason-' . date('d-m-Y-H-i-s') . ".sql";
				$tabelas = array('adm','usuarios','u_receitas','u_preparo','u_ingredientes','u_fotos','receitas','stars','preparo','ingredientes','fotos','comentarios');
				$backuper = new \App\Models\Backup($tabelas, $arquivo);
				$ret = $backuper->backUp();
				if(!empty($ret))
				{
					$arquivo = "backup-receitason-" . date('d-m-Y-H-i-s') . '.sql';
					echo json_encode('{"result" : true, "msg" : "Backup concluido", "backup" : "'.$arquivo.'"}');
				}
				else
				{
					echo json_encode('{"result" : false, "msg" : "Falha ao criar backup"}');
				}
			}
			catch (\Exception $e)
			{
				echo json_encode('{"result" : false, "msg" : "Falha ao criar backup"}');
			}
		}
	}
?>