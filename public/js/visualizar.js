$(document).ready(function(){
	$('.carousel').slick({
		dots: true,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		arrows: true,
		prevArrow: "<button class='prev'><i class='fas fa-angle-left' aria-hidden='true'></i></button>",
		nextArrow: "<button class='next'><i class='fas fa-angle-right' aria-hidden='true'></i></button>",
		centerMode: true,
		variableWidth: true,
		variableHeight: true
	});
})