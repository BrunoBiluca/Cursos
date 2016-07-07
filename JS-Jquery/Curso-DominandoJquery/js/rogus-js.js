/* Função responsável por pegar o valor do total */
function GetTotal(){
	var total = document.getElementById('total');
	return MoneyTextToFloat(total.innerHTML);
}

/* Função responsável por setar o valor do total */
function SetTotal(value) {
	var total = document.getElementById("total");
	total.innerHTML = FloatToMoneyText(value);
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
	var produtos = document.getElementsByClassName('product');
	var valorTotal = 0;
	for (var i = 0; i < produtos.length; i++) {
		var priceElements = produtos[i].getElementsByClassName('price');
		var priceText = priceElements[0].innerHTML;
		var price = MoneyTextToFloat(priceText);

		var qtyElements = produtos[i].getElementsByClassName('quantity');
		var qtyText = qtyElements[0].value;
		var quantity = MoneyTextToFloat(qtyText);

		valorTotal += price * quantity;
	} 
	return valorTotal;
}

/* Função responsável por trocar o valor do total quando a quantidade de uma produto é alterada */
function QuantityChange(){
	SetTotal(CalculateTotalProducts());
}

/* Verifica quando a quantidade de um produto é alterada e então chama a função
para alterar o valor total do carrinho */
function onDocumentLoad() {
	var textEdits = document.getElementsByClassName("quantity");
	for (var i = 0; i < textEdits.length; i++) {
		//Aciona o atributo onchange para verificar se existe mudança e chama a função para tratar isso
		textEdits[i].onchange = QuantityChange;	
	}
}
