/* Função responsável por pegar o valor do total */
function GetTotal(){
	var total = $('#total').text();
	return MoneyTextToFloat(total);
}

/* Função responsável por setar o valor do total */
function SetTotal(value) {
	var text = FloatToMoneyText(value);
	$("#total").text(text);
}

/* Função responsável por transformar o texto na página em um valor float */
function MoneyTextToFloat(text) {
	//Substituiu o símbolo de real por nada e a vírgula por ponto
	var cleanText = text.replace("R$ ", "").replace(",", ".");
	return parseFloat(cleanText);
}

/*	Função responsável por transformar o valor float do total na formatação da página */
function FloatToMoneyText(value) {
	//Define os dígitos do número
	var text = (value < 1 ? "0" : "") + Math.floor(value * 100);
	//Acrescenta o símbolo do real
	text = "R$ " + text;
	//Acrescenta a vírgulo dos centavos
	return text.substr(0, text.length -2) + "," + text.substr(-2);
}

/*	Função responsável por calcular o valor total dos produtos no carrinho */
function CalculateTotalProducts() {
	var produtos = $('.product'); 
	var valorTotal = 0;
	$(produtos).each(function(pos, produto){
		//Produtos é uma array de elementos do DOM, necessário cast para objetos Jquery
	 	//Adicionamos então $() para fazer o cast
		var $produto = $(produto); //Utiliza $ antes do nome da variável para mostrar que é um objeto Jquery
		var quantity = MoneyTextToFloat($produto.find('.quantity').val());
		var price = MoneyTextToFloat($produto.find('.price').text());
		valorTotal += price * quantity;
	});
	return valorTotal;
}

//Determina quando o documento está carregado
$(document).ready(function () {
	SetTotal(CalculateTotalProducts());
	$('.quantity').change(function(){
		SetTotal(CalculateTotalProducts());
	});
});
