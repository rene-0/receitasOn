$(document).ready(function (){
	$('#nao').click(closeNav);
})
function aceitar(id_receita)
{
	$.ajax({
	  type: "POST",
	  url: document.location.origin + document.location.pathname + '/aceitar',
	  data: { id_receita : id_receita},
	  beforeSend: function (){
		
	  },
	  success: function (ret){
		console.log(ret);
		try
		{
			var obj = JSON.parse(ret);
			if(obj.result == true)
			{
				$('#'+id_receita+' .fas.fa-check').remove();//Remove o botão de aceitar
				$('#'+id_receita+' .fas.fa-times').remove();//Remove o botão de recusar
				$('#'+id_receita+' .analize').remove();//Remove o botão de recusar
				$('#'+id_receita+' .status').html("<div class='aceito'>ACEITO</div>");
				showToast('Receita aceita!');
			}
			else
			{
				showToast('Erro ao aceita receita!');
			}
			closeNav();
		}
		catch(e)
		{
			showToast('Erro ao aceita receita!');
			closeNav();
		}
	  }
	});
}

function recusar(id_receita)
{
	$.ajax({
	  type: "POST",
	  url: document.location.origin + document.location.pathname + '/recusar',
	  data: { id_receita : id_receita},
	  beforeSend: function (){
		
	  },
	  success: function (ret){
		console.log(ret);
		console.log(ret.result);
		try
		{
			var obj = JSON.parse(ret);
			console.log(obj);
			console.log(obj.result);
			if(obj.result == true)
			{
				$('#'+id_receita+' .fas.fa-check').remove();//Remove o botão de aceitar
				$('#'+id_receita+' .fas.fa-times').remove();//Remove o botão de recusar
				$('#'+id_receita+' .status').html("<div class='recusado'>RECUSADO</div>");
				showToast('Receita recusada!');
			}
			else
			{
				showToast('Erro ao recusar receita!');
			}
			closeNav();
		}
		catch(e)
		{
			showToast('Erro ao recusar receita!');
			closeNav();
		}
	  }
	});
}

function remover(id_receita)
{
	console.log('Ativo');
	$.ajax({
	  type: "POST",
	  url: document.location.origin + document.location.pathname + '/deletarEnvio',
	  data: { id_receita : id_receita},
	  beforeSend: function (){
		
	  },
	  success: function (ret){
		console.log(ret);
		try
		{
			var obj = JSON.parse(ret);
			console.log(obj);
			console.log(obj.result);
			if(obj.result == true)
			{
				$('#'+id_receita+' .fas.fa-eye').remove();//Remove o botão de aceitar
				$('#'+id_receita+' .fas.fa-trash').remove();//Remove o botão de recusar
				$('#'+id_receita+' .status').html("<div class='removido'>REMOVIDO</div>");
				showToast('Receita removida!');
			}
			else
			{
				showToast('Erro ao remover receita!');
			}
			closeNav();
		}
		catch(e)
		{
			showToast('Erro ao remover receita!');
			closeNav();
		}
	  }
	});
}

//icon = Icone para o modal, title = Titulo/mensagem para o modal, func = Funcão que vai ser atribuida para o botão de confirmar e id_receita = o id da receita
function openModal(icon,title,func,id_receita)
{
	$('#modal').fadeIn();
	$('#modal').css('display','flex');
	$('#icon').attr('class',icon);
	$('#modal-title').html(title);
	if(func == 'aceitar')
	{
		$('#sim').attr('onclick', 'aceitar('+id_receita+')');
	}
	else if(func == 'recusar')
	{
		$('#sim').attr('onclick', 'recusar('+id_receita+')');
	}
	else if(func == 'remover')
	{
		$('#sim').attr('onclick', 'remover('+id_receita+')');
	}
}

function closeNav()
{
	$('#modal').fadeOut();
}