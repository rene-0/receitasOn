$(document).ready(function(){
	var quill = new Quill('#editor', {
		theme: 'snow'
	});
	quill.on('text-change', function() {
		console.log($('.ql-editor').html());
		document.getElementById('desc').value = $('.ql-editor').html();
	});
	document.getElementById('add-ingredientes').addEventListener('click',adicionaIngrediente);
	document.getElementById('add-preparo').addEventListener('click',adicionaPreparo);
	
	
	
	
	//Validação
	var form = document.getElementById('form');
	//console.log(form);
		//Titulo
			var titulo = document.getElementById('titulo');
			titulo.addEventListener('input',validarTitulo);
		//Titulo
		//Preparo
			var temp_preparo = document.getElementById('preparo');
			temp_preparo.addEventListener('input',validarTempPreparo);
		//Preparo
		//Rendimento
			var rendimento = document.getElementById('rendimento');
			rendimento.addEventListener('input', validarRendimento);
		//Rendimento
		//Fotos
			var fotos = document.getElementsByName('fotos[]')[0];
			fotos.addEventListener('input',validarFotos);
			//console.log(fotoss);
		//Fotos
		//Ingredientes
			var ingredientes = document.getElementsByName('ingrediente[]');
			ingredientes[0].addEventListener('input',validarIngredientes);
			ingredientes[1].addEventListener('input',validarIngredientes);
		//Ingredientes
		//Preparo
			var preparo = document.getElementsByName('preparo[]');
			preparo[0].addEventListener('input',validarPreparo);
			preparo[1].addEventListener('input',validarPreparo);
		//Preparo
	form.addEventListener('submit', function (e){
		//e.preventDefault();
		if(!validarTitulo() || !validarTempPreparo() || !validarRendimento() || !validarFotos() || !validarIngredientes() || !validarPreparo())
		{
			e.preventDefault();
			console.log('Inválido');
		}
		else
		{
			form.submit();
			console.log('Validado');
		}
		console.log('Enviou');
	});
	validarTitulo(); 
	validarTempPreparo();
	validarRendimento();
	validarFotos();
	validarIngredientes();
	validarPreparo();
});

	function validarTitulo()
	{
		var titulo = document.getElementById('titulo');
		//console.log(titulo.value.trim().length);
		if(titulo.value.trim() == '')
		{
			invalido(titulo,'Titulo não pode ser vazio');
			return false;
		}
		else if(titulo.value.trim().length > 150)
		{
			invalido(titulo, 'Titulo deve ser menor ou igual a 150 caracteres');
			return false;
		}
		else if(titulo.value.trim().length < 4)
		{
			invalido(titulo, 'Titulo deve ser maior que 3 caracteres');
			return false;
		}
		else
		{
			valido(titulo);
			return true;
		}
	}
	
	function validarTempPreparo()
	{
		var temp_preparo = document.getElementById('preparo');
		if(temp_preparo.value.trim() == '')
		{
			invalido(temp_preparo,'Tempo de preparo não pode ser vazio');
			return false;
		}
		else if(temp_preparo.value.trim().length > 50)
		{
			invalido(temp_preparo, 'Tempo de preparo deve ser menor ou igual a 50 caracteres');
			return false;
		}
		else
		{
			valido(temp_preparo);
			return true;
		}
	}
	
	function validarRendimento()
	{
		var rendimento = document.getElementById('rendimento');
		if(rendimento.value.trim() == '')
		{
			invalido(rendimento,'Rendimento não pode ser vazio');
			return false;
		}
		else if(rendimento.value.trim().length > 50)
		{
			invalido(rendimento, 'Rendimento deve ser menor ou igual a 50 caracteres');
			return false;
		}
		else
		{
			valido(rendimento);
			return true;
		}
	}
	
	function validarFotos()
	{
		foto = document.getElementsByName('fotos[]')[0];
		if(foto.value.trim() != '')//Se for enviado uma imagem
		{
			if(!validarExt())
			{
				var target = document.getElementById('fotos');
				target.parentNode.getElementsByTagName('small')[0].innerHTML = 'Foto deve ser de extenção .jpg, .jpeg ou .png';
				target.classList.remove('valido');
				target.setAttribute('class', 'invalido');
			}
			else if(foto.files[0].size > 15000000)
			{
				var target = document.getElementById('fotos');
				target.parentNode.getElementsByTagName('small')[0].innerHTML = 'Foto não pode ser maior que 15mbs';
				target.classList.remove('valido');
				target.setAttribute('class', 'invalido');
			}
			else
			{
				var target = document.getElementById('fotos');
				target.parentNode.getElementsByTagName('small')[0].innerHTML = '';
				target.classList.remove('invalido');
				target.setAttribute('class', 'valido');
				return true;
			}
		}
	}
	
	function validarExt()
	{
		//Validar extenções
			var fotos = document.getElementsByName('fotos[]');
			for(var i = 0; i < fotos.length; i++)
			{
				var caminho_foto = fotos[0].value;
				var ext = caminho_foto.substr(caminho_foto.lastIndexOf('.'))
				console.log(ext);
				if(ext == '.png' || ext == '.jpg' || ext == '.jpeg')
				{
					//console.log('true')
					return true;
				}
				else
				{
					//console.log('false')
					return false;
				}
			}
		//Validar extenções
	}
	
	function validarIngredientes()
	{
		//Fazer um loop para verificar todos os ingrediente de uma vez
		var ret;
		//console.log(ret != false);
		var ingredientes = document.getElementsByName('ingrediente[]');
		for(var i = 0; i < ingredientes.length; i++)
		{
			//console.log(i);
			if(ingredientes[i].value.trim() == '')
			{
				document.getElementById('ingredientes-container').parentNode.getElementsByTagName('small')[0].innerHTML = 'Ingrediente não pode ser vazio';
				ingredientes[i].classList.remove('valido');
				ingredientes[i].setAttribute('class', 'invalido');
				//invalido(ingrediente,'Ingrediente não pode ser vazio');
				ret = false;
			}
			else if(ingredientes[i].value.trim().length > 255)
			{
				document.getElementById('ingredientes-container').parentNode.getElementsByTagName('small')[0].innerHTML = 'Ingrediente não pode ser maio que 255 caracteres';
				ingredientes[i].classList.remove('valido');
				ingredientes[i].setAttribute('class', 'invalido');
				//invalido(ingrediente, 'Ingrediente não pode ser maio que 255 caracteres');
				ret = false;
			}
			else
			{
				ingredientes[i].classList.remove('invalido');
				ingredientes[i].setAttribute('class', 'valido');
				if(ret != false)
				{
					ret = true;
					document.getElementById('ingredientes-container').parentNode.getElementsByTagName('small')[0].innerHTML = '';
				}
			}
		}
		//console.log(ret);
		return ret;
	}
	
	function validarPreparo()
	{
		//Fazer um loop para verificar todos os preparos de uma vez
		var ret;
		//console.log(ret != false);
		var preparo = document.getElementsByName('preparo[]');
		for(var i = 0; i < preparo.length; i++)
		{
			if(preparo[i].value.trim() == '')
			{
				document.getElementById('preparo-container').parentNode.getElementsByTagName('small')[0].innerHTML = 'Preparo não pode ser vazio';
				preparo[i].classList.remove('valido');
				preparo[i].setAttribute('class', 'invalido');
				ret = false;
			}
			else if(preparo[i].value.trim().length > 255)
			{
				document.getElementById('preparo-container').parentNode.getElementsByTagName('small')[0].innerHTML = 'Preparo não pode ser maio que 255 caracteres';
				preparo[i].classList.remove('valido');
				preparo[i].setAttribute('class', 'invalido');
				ret = false;
			}
			else
			{
				preparo[i].classList.remove('invalido');
				preparo[i].setAttribute('class', 'valido');
				if(ret != false)
				{
					document.getElementById('preparo-container').parentNode.getElementsByTagName('small')[0].innerHTML = '';
					ret = true;
				}
			}
		}
		//console.log(ret);
		return ret;
	}
	
	function invalido(input,text)
	{
		var target = input.parentNode.getElementsByTagName('small')[0];
		target.innerHTML = text;
		input.classList.remove('valido');
		input.setAttribute('class', 'invalido');
	}
	
	function valido(input)
	{
		var target = input.parentNode.getElementsByTagName('small')[0];
		target.innerHTML = '';
		input.classList.remove('invalido');
		input.setAttribute('class', 'valido');
	}
	
	//IMAGENS -------------------------
	
	function imageDemo(input)
	{
		//console.log(input);
		var container_foto = input.parentNode.parentNode;//O container de foto (class = foto)
		if(input.value == '')//Se o valor for vazio remove a imagem antiga
		{
			container_foto.getElementsByTagName('img')[0].parentNode.removeChild(container_foto.getElementsByTagName('img')[0]);
		}
		else
		{
			var file = input.files[0];
			//console.log(file);
			if(file.type == 'image/png' || file.type == 'image/jpg' || file.type == 'image/jpeg')
			{
				var reader = new FileReader();
				reader.addEventListener('load', function (){
					var img = document.createElement('img');
					img.setAttribute('src', this.result);
					img.setAttribute('class', 'inner-img');
					input.parentNode.parentNode.getElementsByClassName('imagem')[0].appendChild(img);
				});
				reader.readAsDataURL(file);
				adicionarImagem();
			}
			if(input.parentNode.parentNode.getElementsByTagName('i')[0] != null)//Se existir a tag i (No primeiro não tem)
			{
				container_foto.getElementsByTagName('i')[0].setAttribute('onclick', 'deletarImagem(this)');//Adiciona o evento de remover o item 
				container_foto.getElementsByTagName('i')[0].classList.remove('disabled');//Retira o css de desabilitado
			}
		}
	}
	
	function adicionarImagem()
	{
		//Container das fotos
		var container = document.getElementById('fotos');
		//Container da foto
		var foto = document.createElement('div');
		foto.setAttribute('class','foto');
		//Container do img
		var imagem = document.createElement('div');
		imagem.setAttribute('class','imagem');
		foto.appendChild(imagem);//Coloca imagem em foto
		//Container de input
		var input = document.createElement('div');
		input.setAttribute('class','input');
		input.addEventListener('input',validarFotos)
		//Input file
		var file = document.createElement('input');
		file.setAttribute('onchange', 'imageDemo(this)');
		file.setAttribute('type', 'file');
		file.setAttribute('name', 'fotos[]');
		input.appendChild(file);//Coloca o input file dentro do container de input
		foto.appendChild(input);//Coloca o container de input dentro do container da foto
		//Botão de deletar imagem
		var i = document.createElement('i');
		i.setAttribute('class', 'fas fa-times');
		//i.setAttribute('onclick', 'deletarImagem(this)');
		i.classList.add('disabled');
		foto.appendChild(i);
		container.appendChild(foto);
	}
	
	function deletarImagem(target)
	{
		//console.log(target);
		target.parentNode.parentNode.removeChild(target.parentNode);
	}
	
	//IMAGENS -------------------------
	
	function adicionaIngrediente()
	{
		var container = document.getElementById('ingredientes-container');
		var div = document.createElement('div');
		div.setAttribute('class','ingrediente');
		
		var input = document.createElement('input');
		input.setAttribute('type','text');
		input.setAttribute('name','ingrediente[]');
		input.addEventListener('input',validarIngredientes);;
		
		var i = document.createElement('i');
		i.setAttribute('class','fas fa-times');
		
		var button = document.createElement('button');
		button.setAttribute('onclick','deletarItem(this)');
		button.setAttribute('type','button');
		
		div.appendChild(input);
		button.appendChild(i);
		div.appendChild(button);
		
		//console.log(div);
		container.appendChild(div);
	}
	
	function adicionaPreparo()
	{
		var container = document.getElementById('preparo-container');
		var div = document.createElement('div');
		div.setAttribute('class','preparo');
		
		var item = document.createElement('div');
		item.setAttribute('class','item');
		item.textContent = (document.getElementsByClassName('item').length + 1);
		div.appendChild(item);
		
		var input = document.createElement('input');
		input.setAttribute('type','text');
		input.setAttribute('name','preparo[]');
		input.addEventListener('input',validarPreparo);
		
		var i = document.createElement('i');
		i.setAttribute('class','fas fa-times');
		
		var button = document.createElement('button');
		button.setAttribute('onclick','deletarItem(this)');
		button.setAttribute('type','button');
		
		div.appendChild(input);
		button.appendChild(i);
		div.appendChild(button);
		
		//console.log(div);
		container.appendChild(div);
	}
	
	function deletarItem(alvo)
	{
		//console.log(alvo);
		//console.log(alvo.parentNode);
		alvo.parentNode.remove();
	}