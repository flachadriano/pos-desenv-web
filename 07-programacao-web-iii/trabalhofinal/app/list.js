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
		var form_actions = [];

		for (var i = 0; i < actions.length; i++) {
			if (actions[i].form === "true") {
				form_actions.push(actions[i]);
			} else {
				var link = "<a ";
				link += "href=" + actions[i].url + "?";
				link += "model=" + getURLParameter("model");
				link += ">";
				link += actions[i].label;
				link += "</a><br/>";

				$("#content").append(link);
			}
		}

		$.get("controllers/models.php", {
			model : getURLParameter("model")
		}, function(data) {
			var model = JSON.parse(data).fields;
			var table = "<table>";

			table += "<tr>";
			for (var i = 0; i < model.length; i++) {
				table += "<th>" + model[i].label + "</th>";
			}
			$.each(form_actions, function(key, action) {
				table += "<th>" + action.label + "</th>";
			});
			table += "</tr>";

			$.get("controllers/records.php", {
				model : getURLParameter("model")
			}, function(data) {
				var records = JSON.parse(data);

				for (var i = 0; i < records.length; i++) {
					table += "<tr>";

					$.each(records[i], function(key, value) {
						if (key !== "id") {
							table += "<td>" + value + "</td>";
						}
					});

					if (form_actions.length > 0) {
						$.each(form_actions, function(key, action) {
							var field = "<td>";
							field += "<a href=" + action.url + "?";
							field += "model=" + getURLParameter("model");
							field += "&id=" + records[i].id + ">";
							field += "Execute</a>";
							table += field;
						});
					}

					table += "</tr>";
				}

				table += "</table>";
				$("#content").append(table);
			});
		});
	});

}