$(document).ready(function() {
	$("#btnLoad").click(loadData);
});

function loadData() {
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
		}
	});

	$("#data").append(html);
}
