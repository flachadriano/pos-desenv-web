$(document).ready(function() {
	buildResourcesTable();
});

function buildResourcesTable() {
	$.get("resources.php", null, function(data) {
		var resources = JSON.parse(data);

		for (var i = 0; i < resources.length; i++) {
			$("#home_resources").html(
					"<a href=" + resources[i].url + ">"
							+ resources[i].label + "</a>");
		}
	});
}