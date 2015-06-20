$(document).ready(function() {
	$("#btnLoad").click(loadData);
});

function loadData() {
	$("#data").empty();
	$("#data").html('<span class="loading">Carregando...</span>');
	
	$.getJSON("http://www.koiote.com.br/dojsonp.php?koiote_json_callback=?")
			.done(function(data) {
				processData(data);
			}).error(
					function(obj, status, error) {
						$("#data").empty();
						var text = $("span").css("color", "red").text(
								"Erro: " + status + " (" + error + ")");
						$("data").append(text);
					});
}

function processData(data) {
	$("#data").empty();

	var html = "<table><thead><tr>";
	html += "<th>Id</th>";
	html += "<th>Nome</th>";
	html += "<th>E-mail</th>";
	html += "</tr></thead>";

	$('input[value=""]').attr("value", data.length);
	$('label:eq(2) > span').text("Todos[" + data.length + "]");

	var numReg = $(":checked").attr("value");
	$.each(data, function(i, obj) {
		if (i < numReg) {
			html += "<tr>";
			html += "<td>" + obj.id + "</td>";
			html += "<td>" + obj.name + "</td>";
			html += "<td>" + obj.email + "</td>";
			html += "</tr>";
		} else {
			return false;
		}
	});

	$("#data").append(html);
	$("#data table thead tr").css("backgroundColor", "#e3f1ff");
	$("#data table tbody tr:odd").css("backgroundColor", "#f6faff");
	$("#data tbody td:first-child").css("backgroundColor", "#e3f1ff");
}
