$(document).ready(function() {
	buildList();
});

function getURLParameter(name) {
	return decodeURIComponent((new RegExp('[?|&]' + name + '='
			+ '([^&;]+?)(&|#|;|$)').exec(location.search) || [ , "" ])[1]
			.replace(/\+/g, '%20'))
			|| null;
}

function buildList() {
	$.get("controllers/actions.php", {
		model : getURLParameter("model")
	}, function(data) {
		var actions = JSON.parse(data);

		for (var i = 0; i < actions.length; i++) {
			var link = "<a ";
			link += "href=" + actions[i].url + "?";
			link += "model=" + getURLParameter("model");
			link += ">";
			link += actions[i].label;
			link += "</a><br/>";

			$("#content").append(link);
		}
	});

	$.get("controllers/models.php", {
		model : getURLParameter("model")
	}, function(data) {
		var model = JSON.parse(data);
		var table = "<table>";

		table += "<tr>";
		for (var i = 0; i < model.length; i++) {
			table += "<th>" + model[i].label + "</th>";
		}
		table += "</tr>";

		$.get("controllers/records.php", {
			model : getURLParameter("model")
		}, function(data) {
			var records = JSON.parse(data);

			for (var i = 0; i < records.length; i++) {
				table += "<tr>";
				$.each(records[i], function(key, value) {
					table += "<td>" + value + "</td>";
				});
				table += "</tr>";
			}

			table += "</table>";
			$("#content").append(table);
		});
	});

}