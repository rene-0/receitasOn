$(document).ready(function(){
	$('#nao').click(closeModal);
});//Fim do on ready

function openModal(id_receita)
{
	$('#modal').fadeIn();
	$('#modal').css('display', 'flex');
	$('#modal-titulo').html("Confirme a remoção da receita '" + $('#titulo-'+id_receita).html() + "'");//Adiciona o nomde da receita no aviso
	$('#sim').attr('onclick', "deletarReceita("+ id_receita +")");
}

function closeModal()
{
	$('#modal').fadeOut();
}

function deletarReceita(id_receita)
{
	$.ajax({
		type: "POST",
		url: document.location.origin + '/receitasOn/public/sysadm/listar_receitas/deletarReceita',
		data: { id_receita : id_receita},
		beforeSend: function (){
		
		},
		success: function (ret){
			console.log(ret);
			try
			{
				var obj = JSON.parse(ret);
				console.log(obj);
				if(obj.result == true)
				{
					showToast(obj.msg);
					closeModal();
					$('#'+id_receita).remove();
				}
				else
				{
					showToast(obj.msg);
					closeModal();
				}
			}
			catch(e)
			{
				showToast('Erro ao remover a receita');
				closeModal();
			}
		}
	});
}