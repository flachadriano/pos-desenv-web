$(document).ready(function() {
	buildResourcesTable();
});

function buildResourcesTable() {
	$.get("controllers/resources.php", null, function(data) {
		var resources = JSON.parse(data);

		for (var i = 0; i < resources.length; i++) {
			var link = "<a ";
			link += "href=" + resources[i].url + "?";
			link += "model=" + resources[i].model;
			link += ">";
			link += resources[i].label;
			link += "</a>";

			$("#content").html(link);
		}
	});
}