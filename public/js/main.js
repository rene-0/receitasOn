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
	$('#btn-mobile').click(function (){
		if($('#nav-cortina').css('display') == 'none')
		{
			console.log('Teste open');
			$('#nav-cortina').fadeIn();
		}
	});
	$('#mobile-close').click(function (){
		if($('#nav-cortina').css('display') == 'block')
		{
			console.log('Teste close');
			$('#nav-cortina').fadeOut();
		}
	});
});
/* Navegação */