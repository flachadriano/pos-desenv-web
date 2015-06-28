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
			link += "</a>";

			$("#content").html(link);
		}
	});
}