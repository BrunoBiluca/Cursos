//Máscaras do formulário
function Mascara_Cep() {
	var v = $('#cep').val();
	$('#cep').val($('#cep').val().replace(/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/, ""));
	if (v.match(/^\d{5}$/) !== null) {
		$('#cep').val(v + '-');
	}
}

function Mascara_Cpf() {
	var v = $('#doc').val();
	$('#doc').val($('#doc').val().replace(/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/, ""));
	if (v.match(/^\d{3}$/) !== null) {
		$('#doc').val(v + '.');
	} else if (v.match(/^\d{3}\.\d{3}$/) !== null) {
		$('#doc').val(v + '.');
	} else if (v.match(/^\d{3}\.\d{3}\.\d{3}$/) !== null) {
		$('#doc').val(v + '-');
	}
}

function Mascara_Cnpj() {
	var v = $('#doc').val();
	$('#doc').val($('#doc').val().replace(/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/, ""));
	if (v.match(/^\d{2}$/) !== null) {
		$('#doc').val(v + '.');
	} else if (v.match(/^\d{2}\.\d{3}$/) !== null) {
		$('#doc').val(v + '.');
	} else if (v.match(/^\d{2}\.\d{3}\.\d{3}$/) !== null) {
		$('#doc').val(v + '/');
	} else if (v.match(/^\d{2}\.\d{3}\.\d{3}\/\d{4}$/) !== null) {
		$('#doc').val(v + '-');
	}
}

//Determina o tipo de documento que será preenchido
$(":radio").on("click", function(){
	var v = $( "input:checked" ).val();
	if(v == "cpf"){
		$("#doc").attr('onkeyup', 'Mascara_Cpf()');
		$("#doc").attr('maxlength','14');
	}else if(v == "cnpj"){
		$("#doc").attr('onkeyup', 'Mascara_Cnpj()');
		$("#doc").attr('maxlength','18');
	}
	$("#doc").val("");
});