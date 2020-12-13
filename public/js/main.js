function showToast(text){
	var x=document.getElementById("toast");
	x.classList.add("show");
	x.innerHTML=text;
	setTimeout(function(){
	x.classList.remove("show");
	},3000);
}
/* Navegação */
$(document).ready(function (){
	$('#btn-mobile, #mobile-close').click(function (){
		var cortina = $('#nav-cortina');
		if(cortina.css('display') == 'block')
		{
			cortina.fadeOut();
		}
		else
		{
			cortina.fadeIn();
		}
	});
});
/* Navegação */