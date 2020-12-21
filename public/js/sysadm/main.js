$(document).ready(function (){
	$('.open-mobile-nav-button').click(function (){
		$('.mobile-cortina').fadeIn();
	});
	$('.close-mobile-nav-button').click(function (){
		$('.mobile-cortina').fadeOut();
	});
});
function showToast(text){
	var x=document.getElementById("toast");
	x.classList.add("show");
	x.innerHTML=text;
	setTimeout(function(){
	x.classList.remove("show");
	},3000);
}