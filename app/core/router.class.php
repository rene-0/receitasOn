<?php
	namespace App\Core;
	class Router
	{
		private $controller = "home";
		private $method = "index";
		private $prefix = array('sysadm');//Prefixo da url, por exemplo sysadm é o prefixo de sysadm/home/index
		private $params = array();
		function __construct()
		{
			//var_dump($_GET);
			$this->url = $this->parseUrl();
			//var_dump($this->url);
			$this->setPrefix();
			
			if(isset($this->url[0]))
			{
				if(file_exists("../app/controllers/". $this->prefix['path'] ."{$this->url[0]}.class.php"))
				{
					$this->controller = $this->url[0];
					unset($this->url[0]);
				}
				else
				{
					throw new \Exception("Erro 404, não encontrado", 404);
				}
			}
			
			//Criando o obj do controller
			$this->controller = "App\Controllers\\". $this->prefix['namespace'] .$this->controller;
			$this->controller = new $this->controller();
			if(isset($this->url[1]))
			{
				if(method_exists($this->controller, $this->url[1]))
				{
					$this->method = $this->url[1];
					unset($this->url[1]);
				}
				else
				{
					throw new \Exception("Erro 404, não encontrado",404);
				}
			}
			//Criando o obj do controller
			
			//Re arrumando o array
			if(isset($this->url))
			{
				$this->params = array_values($this->url);
				unset($this->url);
			}
			//Re arrumando o array
			
			//Chamando o metodo
			call_user_func_array(array($this->controller,$this->method),$this->params);
			//Chamando o metodo
		}
		
		function parseUrl()
		{
			if(isset($_GET['URL']))
			{
				$this->url = explode('/',filter_var(rtrim($_GET['URL'], '/'), FILTER_SANITIZE_URL));
				unset($_GET['URL']);
				return $this->url;
			}
		}
		
		static function getBaseUrl()
		{
			if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
			{
				$link = "https"; 
			}
			else
			{
				$link = "http";
			}
			$link .= "://{$_SERVER['HTTP_HOST']}/receitasOn/public/";
			return $link;
		}
		
		function setPrefix()
		{
			//Testa se tem um prefixo
			if(isset($this->url[0]) && in_array($this->url[0], $this->prefix))
			{
				//Se tiver, o armazena como prefixo da requisição e re arruma o array $this->url
				$this->prefix = array(
							'namespace' => $this->url[0].'\\',
							'path' => $this->url[0].'/'
				);
				unset($this->url[0]);//Destroi o primeiro index
				$this->url = array_values($this->url);//Reorganiza os indexes do array de urls
			}
			else
			{
				//Se não, o aramazena como vazio
				$this->prefix = array(
							'namespace' => '',
							'path' => ''
				);
			}
			//Testa se tem um prefixo
		}
	}
?>