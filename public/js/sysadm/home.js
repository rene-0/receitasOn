$(document).ready(function (){
	$('.fas.fa-expand').click(function (){
        $('.ultima-receita').toggleClass('full-screen');
        $('.fas.fa-expand').toggle();
        $('.fas.fa-compress').toggle();
        $('.drop-receita').toggleClass('full-screen');
        $('.receita-container').addClass('active');
        showToast('Precione [Esc] para sair da tela cheia');
        document.onkeyup = function(e) {
            if (e.key == 'Escape') {
                $('.ultima-receita').toggleClass('full-screen');
                $('.fas.fa-expand').toggle();
                $('.fas.fa-compress').toggle();
                $('.drop-receita').toggleClass('full-screen');
                $('.receita-container').removeClass('active');
                document.onkeyup = '';
            }
        };
    });
    $('.fas.fa-compress').click(function (){
        $('.ultima-receita').toggleClass('full-screen');
        $('.fas.fa-expand').toggle();
        $('.fas.fa-compress').toggle();
        $('.drop-receita').toggleClass('full-screen');
        $('.receita-container').removeClass('active');
        document.onkeyup = '';
    });
    $('.drop-receita').click(function (){
        $('.receita-container').toggleClass('active');
    });
});