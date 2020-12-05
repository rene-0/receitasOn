$(document).ready(function(){
	$('#nao').click(closeNav);
	/*
form.addEventListener('submit', function (e){
		e.preventDefault();
		//console.log("Prevent");
		$.ajax({
		  type: "POST",
		  url: form.action,
		  data: $('#form').serialize(),
		  beforeSend: function (){
			$('#loader').fadeIn();
			$('#loader').css('display','flex');//fadeIn por padrão usar display: block, queremos que fique display: flex, então logo em seguida do fadeIn trocamos para flex
		  },
		  success: function (data){
			$('#loader').fadeOut(400);
			//console.log(data);
			//Remover o aviso de nenhum comentário
			var disabled = document.getElementById('disabled');
			if(disabled != null)
			{
				disabled.parentNode.removeChild(disabled);
			}
			//Remover o aviso de nenhum comentário
			//
			adicionarComentario(data);
		  }
		});
	});
	*/
});//Fim do on ready

function openModal(id_receita)
{
	$('#modal').fadeIn();
	$('#modal').css('display', 'flex');
	$('#modal-titulo').html("Confirme a remoção da receita '" + $('#titulo-'+id_receita).html() + "'");//Adiciona o nomde da receita no aviso
	$('#sim').attr('onclick', "deletarReceita("+ id_receita +")");
}

function closeNav()
{
	$('#modal').fadeOut();
}

function deletarReceita(id_receita)
{
		$.ajax({
		  type: "POST",
		  url: document.location.origin + document.location.pathname + '/deletarReceita',
		  data: { id_receita : id_receita},
		  beforeSend: function (){
			
		  },
		  success: function (data){
			console.log(data);
			if(data == 'true')
			{
				var obj = JSON.parse(data);
				showToast('Receita removida');
				closeNav();
				$('#'+id_receita).remove();
			}
			else
			{
				var obj = JSON.parse(data);
				showToast('Erro ao deletar receita');
			}
			console.log('Funcionou');
		  }
		});
}