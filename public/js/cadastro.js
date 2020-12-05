$(document).ready(function(){
	//Adicionando os eventos nos inputs
	document.getElementsByName('nome')[0].addEventListener('input',validarNome);
	document.getElementsByName('mail')[0].addEventListener('input',validarEmail);
	document.getElementsByName('conf-mail')[0].addEventListener('input',validarEmail);
	document.getElementsByName('password')[0].addEventListener('input',validarSenha);
	document.getElementsByName('conf-password')[0].addEventListener('input',validarSenha);
	document.getElementsByName('data')[0].addEventListener('input',validarData);
	//Previnindo o formulário
	var form = document.getElementById('form');
	form.addEventListener('submit', function (e){
		e.preventDefault();
		if(!validarNome() || !validarEmail() || !validarSenha() || !validarData())//Validação
		{
			document.getElementsByClassName('invalido')[0].scrollIntoView({behavior: "smooth"});//Faz o browser dar scroll para o primeiro item com 'invalido'
		}
		else
		{
			//Enviar
			form.submit();
		}
	});
});

function validarNome()
{
	var nome = document.getElementsByName('nome')[0];
	if(nome.value.trim() == '')
	{
		invalido(nome,"Nome não pode ser vazio");
		return false;
	}
	else if(nome.value.trim().length > 100)
	{
		invalido(nome, "Nome deve ser menor ou igual a 100 caracteres");
		return false;
	}
	else if(nome.value.trim().length < 4)
	{
		invalido(nome, "Nome deve ser maior que 3 caracteres");
		return false;
	}
	else
	{
		valido(nome);
		return true;
	}
}

function validarEmail()
{
	var reg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	var mail = document.getElementsByName('mail')[0];
	var conf_mail = document.getElementsByName('conf-mail')[0];
	if(mail.value.trim() == '')
	{
		invalido(mail,"E-mail não pode ser vazio");
		invalido(conf_mail,"E-mail não pode ser vazio");
		return false;
	}
	else if(mail.value.trim().length > 100)
	{
		invalido(mail, "E-mail deve ser menor ou igual a 100 caracteres");
		invalido(conf_mail, "E-mail deve ser menor ou igual a 100 caracteres");
		return false;
	}
	else if(mail.value.trim().length < 4)
	{
		invalido(mail, "E-mail deve ser maior que 3 caracteres");
		invalido(conf_mail, "E-mail deve ser maior que 3 caracteres");
		return false;
	}
	else if(mail.value.trim() != conf_mail.value.trim())
	{
		invalido(mail, "E-mail deve ser igual a confirmar E-mail");
		invalido(conf_mail, "E-mail deve ser igual a confirmar E-mail");
		return false;
	}
	else if(!reg.test(mail.value.trim()))
	{
		invalido(mail, "E-mail inválido, exemplo de e-mail válido: exemplo@exemplo.com");
		invalido(conf_mail, "E-mail inválido, exemplo de e-mail válido: exemplo@exemplo.com");
	}
	else
	{
		valido(mail);
		valido(conf_mail);
		return true;
	}
}

function validarSenha()
{
	var reg = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
	/* 
		* 1- Pelo menos um caracter alfabético minúsculo
		* 2- Pelo menos um caracter alfabético maiúsculo
		* 3- Pelo menos um caracter númerico 
		* 4- Pelo menos um caracter especial: !@#$%^&*
		* 5- Pelo menos 8 caracteres
	*/
	var senha = document.getElementsByName('password')[0];
	var conf_senha = document.getElementsByName('conf-password')[0];
	if(senha.value.trim() == '')
	{
		invalido(senha,"Senha não pode ser vazio");
		invalido(conf_senha,"Senha não pode ser vazio");
		return false;
	}
	else if(senha.value.trim().length > 250)
	{
		invalido(senha, "Senha deve ser menor ou igual a 250 caracteres");
		invalido(conf_senha, "Senha deve ser menor ou igual a 250 caracteres");
		return false;
	}
	else if(senha.value.trim() != conf_senha.value.trim())
	{
		invalido(senha, "Senha deve ser igual a confirmar senha");
		invalido(conf_senha, "Senha deve ser igual a confirmar senha");
		return false;
	}
	else if(!reg.test(senha.value.trim()))
	{
		invalido(senha, "Senha deve satisfazer esses requesitos: 1- Pelo menos um caracter alfabético minúsculo,\n 2- Pelo menos um caracter alfabético maiúsculo, 3- Pelo menos um caracter númerico, 4- Pelo menos um caracter especial: !@#$%^&* e 5- Pelo menos 8 caracteres");
		invalido(conf_senha, "Senha deve satisfazer esses requesitos: 1- Pelo menos um caracter alfabético minúsculo, 2- Pelo menos um caracter alfabético maiúsculo, 3- Pelo menos um caracter númerico, 4- Pelo menos um caracter especial: !@#$%^&* e 5- Pelo menos 8 caracteres");
		return false;
	}
	else
	{
		valido(senha);
		valido(conf_senha);
		return true;
	}
}

function validarData()
{
	var data = document.getElementsByName('data')[0];
	if(data.value.trim() == '')
	{
		invalido(data, "Data não pode ser vazio");
		return false;
	}
	else if(isNaN(Date.parse(data.value.trim())))
	{
		invalido(data, "Data inválida");
		return false;
	}
	else
	{
		valido(data);
		return true;
	}
}

function invalido(input,text)
{
	var target = input.parentNode.getElementsByTagName('small')[0];
	target.innerHTML = text;
	input.classList.remove('valido');
	input.classList.add('invalido');
}

function valido(input)
{
	var target = input.parentNode.getElementsByTagName('small')[0];
	target.innerHTML = '';
	input.classList.remove('invalido');
	input.classList.add('valido');
}