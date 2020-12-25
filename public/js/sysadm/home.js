$(document).ready(function (){
	$('.fas.fa-expand').click(function (){
        $('.ultima-receita').toggleClass('full-screen');
        $('.fas.fa-expand').toggle();
        $('.fas.fa-compress').toggle();
    });
    $('.fas.fa-compress').click(function (){
        $('.ultima-receita').toggleClass('full-screen');
        $('.fas.fa-expand').toggle();
        $('.fas.fa-compress').toggle();
	});
});