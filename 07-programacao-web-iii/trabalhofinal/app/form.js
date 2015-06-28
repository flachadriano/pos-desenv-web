$(document).ready(function() {
	$("#btnSend").click(save);

	buildForm();
});

function getURLParameter(name) {
	return decodeURIComponent((new RegExp('[?|&]' + name + '='
			+ '([^&;]+?)(&|#|;|$)').exec(location.search) || [ , "" ])[1]
			.replace(/\+/g, '%20'))
			|| null;
}

function buildForm() {
	$.get("controllers/models.php", {
		model : getURLParameter("model")
	}, function(data) {
		var fields = JSON.parse(data);

		for (var i = 0; i < fields.length; i++) {
			var field = "<div class=field>";
			field += "<span>" + fields[i].label + ": </span>";
			field += "<input type='text' name=" + fields[i].name + ">";
			field += "</div>";

			$("#form").append(field);
		}
	});
}

function save() {
	$.ajax({
		type : "POST",
		url : "controllers/validate.php?model=" + getURLParameter("model"),
		dataType : "json",
		async : false,
		data : $("#form").serialize(),
		success : function() {
		}
	});
}