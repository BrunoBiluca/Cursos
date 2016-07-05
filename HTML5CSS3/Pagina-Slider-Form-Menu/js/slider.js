//Slider
//Função padrão do slider. A cada 5 segundos ocorre a troca de imagens. Está função é executada em loop durante a visita na página
function slideSwitch() {
	var $active = $('.slideshow img.active');

	if ( $active.length == 0 ) $active = $('.slideshow img:last');

	var $next =  $active.next().length ? $active.next() : $('.slideshow img:first');

	$active.addClass('last-active');

	$next.css({opacity: 0.0}).addClass('active').animate({opacity: 1.0}, 1000, function() {
		$active.removeClass('active last-active');
	});
}

//Determina o intervalo de execução da função padrão do slider.
var interval = null;
$(function() {
	interval = setInterval( "slideSwitch()", 5000 );
});

//Troca para a imagem anterior a atual no slider. Reinicia a contagem para a chamada da função padrão
function ImagemAnterior(){
	var $active = $('.slideshow img.active');
	var $prev =  $active.prev().length ? $active.prev() : $('.slideshow img:last');
	$active.addClass('last-active');
	$prev.css({opacity: 0.0}).addClass('active').animate({opacity: 1.0}, 200, function() {
		$active.removeClass('active last-active');
	});

	clearInterval(interval);
	interval = setInterval( "slideSwitch()", 5000 );
}

//Troca para a imagem posterior a atual do slider. Reinicia a contagem para a chamada da função padrão
function ImagemProxima(){
	var $active = $('.slideshow img.active');
	var $next =  $active.next().length ? $active.next() : $('.slideshow img:first');
	$active.addClass('last-active');
	$next.css({opacity: 0.0}).addClass('active').animate({opacity: 1.0}, 200, function() {
		$active.removeClass('active last-active');
	});

	clearInterval(interval);
	interval = setInterval( "slideSwitch()", 5000 );
}