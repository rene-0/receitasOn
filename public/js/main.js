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
			$('#nav-cortina').fadeIn();
		}
	});
	$('#mobile-close').click(function (){
		if($('#nav-cortina').css('display') == 'block')
		{
			$('#nav-cortina').fadeOut();
		}
	});
});
/* Navegação */