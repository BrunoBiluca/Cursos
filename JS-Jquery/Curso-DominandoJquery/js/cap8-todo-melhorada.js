//on<identificador do elemento><nome do evento>
//Padrão acima de nomes para funções de eventos
$(document).ready(function(){
	var login = "seu@email.com";
	var server = "http://livro-capitulo07.herokuapp.com"

	var $lastClicked;

	//Função responsável por deletar uma tarefa da lista
	function onTarefaDeleteClick() {
		$(this).parent(".tarefa-item").off('click').hide("slow", function(){
			$this = $(this);
			$.post(server + "/tarefa", 
				{usuario: login, tarefa_id: $this.children(".tarefa-id").text(), 
				_method: "DELETE"});

			$(this).remove();
		});
	}

	function onTarefaItemClick() {
		//Verifica se a terefa clicada é diferente da tarefa que estava sendo editada
		//Se diferente a tarefa editada é salva e a nova tarefa pode ser editada
		if(!$(this).is($lastClicked)){
			if($lastClicked !== undefined){
				SavePendingEdition($lastClicked);
			}
			
			$lastClicked = $(this);

			var text = $lastClicked.children('.tarefa-texto').text();
			var id = $lastClicked.children('.tarefa-id').val();
			var html = "<div class='tarefa-id'>" + id + "</div>"  + "<input type='text' " +
			"class='tarefa-edit' value='" + text + "' >";

			$lastClicked.html(html);

			$(".tarefa-edit").keydown(onTarefaEditKeydown);
		}
	}

	function onTarefaEditKeydown(event) {
		if(event.which === 13){
			SavePendingEdition($lastClicked);
			$lastClicked = undefined;
		}
	}

	function onTarefaKeydown(event) {
		if(event.which === 13){
			AddTarefa($("#tarefa").val());
			$("#tarefa").val("");
		}
	}

	function AddTarefa(text, id) {
		id = id || 0;	//Forma elegante de escrever um if
		var $tarefa = $("<div />").addClass("tarefa-item");
		$tarefa.append("<div class='tarefa-id'>" + id + "</div>");
		$tarefa.append($("<div />").addClass("tarefa-texto").text(text));
		$tarefa.append($("<div />").addClass("tarefa-delete"));
		$tarefa.append($("<div />").addClass("clear"));

		$("#tarefa-list").append($tarefa);

		$(".tarefa-delete").click(onTarefaDeleteClick);
		$(".tarefa-item").click(onTarefaItemClick);

		if(id === 0){
			var div = $($tarefa.children(".tarefa-id"));
			console.log("id", div);
			NovaTarefa(text, $(div));
		}
	}

	function SavePendingEdition($tarefa) {
		var text = $tarefa.children('.tarefa-edit').val();
		var id = $tarefa.children('.tarefa-id').val();
		$tarefa.empty();
		//Forma 1 de adicionar HTML dinâmico - usando HTML puro
		//$tarefa.append("<div class='tarefa-texto'>" + text + "</div>");
		//$tarefa.append("<div class='tarefa-delete'></div>");
		//$tarefa.append("<div class='clear'></div>");

		//Forma 2 de adicionar HTML dinâmico - usando funções do Jquery
		$tarefa.append("<div class='tarefa-id'>" + id + "</div>");
		$tarefa.append($("<div />").addClass("tarefa-texto").text(text));
		$tarefa.append($("<div />").addClass("tarefa-delete"));
		$tarefa.append($("<div />").addClass("clear"));

		UpdateTarefa(text, id);	//Atualiza a tarefa no servidor

		$(".tarefa-delete").click(onTarefaDeleteClick);
		$tarefa.click(onTarefaItemClick);
	}

	//Carrega as tarefas cadastradas no servidor
	function LoadTarefas() {
		$("#tarefa").empty();

		//Método do Jquery para fazer requisições GET
		$.getJSON(server + "/tarefas", {usuario: login})
			.done(function (data) {
				console.log("data: ", data);
				for (var i = 0; i < data.length; i++) {
					AddTarefa(data[i].texto, data[i].id);
				}
			});
	}

	//Função responsável por atualizar as tarefas no servidor
	function UpdateTarefa(text, id){
		$.post(server + "/tarefa", {tarefa_id: id, texto: text});
	}

	//Função responsável por enviar a nova tarefa para o servidor
	function NovaTarefa(text, $div) {
		$.post(server + "/tarefa", {usuario: login, texto: text, _method: "PUT"})
		.done(function (data) {
			$div.text(data.id);
		})
	}

	$(".tarefa-delete").click(onTarefaDeleteClick);
	$(".tarefa-item").click(onTarefaItemClick);

	$("#tarefa").keydown(onTarefaKeydown);

	LoadTarefas();
});
















/************************************************************
Exemplos
************************************************************/


$("#tarefa").keydown(function (event){
	//console.log(event.which, String.fromCharCode(event.which));
	if(event.which === 13){
		console.log("Aqui escrevemos nossa nova tarefa!");
	}
});

//Exemplo para mostrar quando dois eventos são acionados ao mesmo tempo
//Por padrão os eventos são chamados em sequência
//Utilizando esta forma podemos desassociar apenas um evento, evitando que outros eventos sejam desassociados
$("#tarefa").on("keydown.primeiro", function() {
	console.log("Esse é o primeiro evento");
});
$("#tarefa").on("keydown.segundo", function() {
	console.log("Esse é o segundo evento");
});

//Desassociação de um evento
$("#tarefa").off("keydown.segundo");