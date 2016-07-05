//Validação formulário
$("#dform").submit( function(){
	//Validação do nome
	if (document.dform.name.value.length == 0){ 
		$(".p-name .error").css({opacity: 1.0});
		$(".p-name .error").append("Por favor, escreva seu nome");
		document.dform.name.focus();
		return false; 
	}

	//Validação do e-mail
	var v = document.dform.email.value;
	if (v.match(/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/) == null) {
		$(".p-email .error").css({opacity: 1.0});
		$(".p-email .error").append("Por favor, digite um email válido");
		document.dform.email.focus();
		return false; 
	}

    //Valida o formato do CEP.
    var validacep = /^[0-9]{8}$/;
    if(validacep.test(cep)) {
    	$(".p-cep .error").css({opacity: 1.0});
    	$(".p-cep .error").append("Por favor, digite um cep válido");
    	document.dform.cep.focus();
    	return false; 
    }
    $('#sucesso').show();
    $('#sucesso').focus();
    $("#dform").hide();
    return false;
});

$("#name").on('keyup', function(){
	$(".p-name .error").css({opacity: 0.0});
	$(".p-name .error").html("");
});

$("#email").on('keyup', function(){
	$(".p-email .error").css({opacity: 0.0});
	$(".p-email .error").html("");
});

$("#cep").on('keyup', function(){
	$(".p-cep .error").css({opacity: 0.0});
	$(".p-cep .error").html("");
});

//CEP
function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#cidade").val("");
    $("#estado").val("");
}

$("#cep").blur(function() {
    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            $("#cidade").val("...")
            $("#estado").val("...")

            //Consulta o webservice viacep.com.br/
            $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
            	if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#cidade").val(dados.localidade);
                    $("#estado").val(dados.uf);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    $(".p-cep .error").css({opacity: 1.0});
                    $(".p-cep .error").append("CEP não encontrado, por favor tente outro");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            $(".p-cep .error").css({opacity: 1.0});
            $(".p-cep .error").append("Por favor, digite um cep válido");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
});