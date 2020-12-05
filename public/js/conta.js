$(document).ready(function (){
	$('#nao').click(closeModal);
});
function deletar(id_receita)
{
	console.log("Triger");
	$.ajax({
	  type: "POST",
	  url: document.location.origin + '/receitasOn/public/conta' + '/deletarEnvio',
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
				$('#'+id_receita).remove();//Remove a receita
				showToast('Envio removido!');
			}
			else
			{
				showToast('Erro ao remover envio!');
			}
			closeModal();
		}
		catch(e)
		{
			showToast('Erro ao remover envio!!');
			closeModal();
		}
	  }
	});
}
function openModal(id_receita,title,func)
{
	$('#modal').fadeIn();
	$('#modal').css('display','flex');
	$('#modal-title').html(title);
	$('#sim').attr('onclick', func + '('+id_receita+')');
}
function closeModal()
{
	$('#modal').fadeOut();
}