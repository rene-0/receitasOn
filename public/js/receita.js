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
	var form = document.getElementById('form');
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
	
	//Stars
	var stars = document.getElementById('stars');//Estrelas da receita
	var stars_modal = document.getElementById('stars-modal');//Container do modal
	var hide = document.getElementById('hide');//Botão para esconder o modal
	stars.addEventListener('click', function () {
		$(stars_modal).fadeIn(1000);
		$(stars_modal).css('display', 'flex');
	});
	hide.addEventListener('click', function (){
		$(stars_modal).fadeOut(1000);
	})
	
	
	//var form_stars = document.getElementById('form-stars');//Estrlas copntainer
	var stars_ativo = document.getElementById('star-ativo');//Estrlas ativas
	
	var stars_input = document.getElementsByName('star')[0];//Stars input
	stars_input.addEventListener('input', function (){
		stars_ativo.style.width =  stars_input.value + '%';
	});
	
	//Avaliação
	var form_star = document.getElementById('form-star');
	form_star.addEventListener('submit', function (e){
		e.preventDefault();
		//console.log("Prevent");
		$.ajax({
		  type: "POST",
		  url: form_star.action,
		  data: $(form_star).serialize(),
		  beforeSend: function (){
			
		  },
		  success: function (data){
			//console.log(data)
			try
			{
				//console.log(typeof(JSON.parse(data)))
				var obj = JSON.parse(data);
				showToast('Avaliação registrado!');
			}
			catch(e)
			{
				//showToast('Erro - '+data);//Um erro generico seria melhor
				showToast('Erro - Erro ao inserir avaliação');
			}
		  }
		});
	});
});
function adicionarComentario(data)
{
	try
	{
		var obj = JSON.parse(data);
		//console.log(obj);
		var li = document.createElement('li');
		//Div img
		var img = document.createElement('div');
		img.setAttribute('class', 'img');
			var imagem = document.createElement('img');
			imagem.setAttribute('src','http://localhost/receitasOn/public//img/main/user.png');
			imagem.setAttribute('title','Icone de usuário');
		img.appendChild(imagem);
			var header = document.createElement('div');
			header.setAttribute('class','header');
				var mark = document.createElement('mark');
				mark.innerHTML = obj.nome;
				var p = document.createElement('p');
				p.innerHTML = obj.data;
			header.appendChild(mark);
			header.appendChild(p);
		img.appendChild(header);
		//Div img
		//Div texto
		var text = document.createElement('div');
		text.setAttribute('class','text');
			var texto = document.createElement('p');
			texto.innerHTML = obj.comentario;
		text.appendChild(texto);
		//Div texto
		li.appendChild(img);
		li.appendChild(text);
		//console.log(li);
		var alvo = document.getElementById('comentar').getElementsByTagName('ul')[0];
		//alvo.appendChild(li);
		alvo.insertBefore(li, alvo.firstChild);
	}
	catch(e)
	{
		showToast('Erro - '+data);
	}
	/*
	if(typeof(obj) === 'object')
			{
				var obj = JSON.parse(data);
				console.log(obj);
				var li = document.createElement('li');
				//Div img
				var img = document.createElement('div');
				img.setAttribute('class', 'img');
					var imagem = document.createElement('img');
					imagem.setAttribute('src','http://localhost/receitasOn/public//img/main/user.png');
					imagem.setAttribute('title','Icone de usuário');
				img.appendChild(imagem);
					var header = document.createElement('div');
					header.setAttribute('class','header');
						var mark = document.createElement('mark');
						mark.innerHTML = obj.nome;
						var p = document.createElement('p');
						p.innerHTML = obj.data;
					header.appendChild(mark);
					header.appendChild(p);
				img.appendChild(header);
				//Div img
				//Div texto
				var text = document.createElement('div');
				text.setAttribute('class','text');
					var texto = document.createElement('p');
					texto.innerHTML = obj.comentario;
				text.appendChild(texto);
				//Div texto
				li.appendChild(img);
				li.appendChild(text);
				//console.log(li);
				var alvo = document.getElementById('comentar').getElementsByTagName('ul')[0];
				//alvo.appendChild(li);
				alvo.insertBefore(li, alvo.firstChild);
			}
			else
			{
				showToast('Erro - '+data);
			}//End if
	*/
}