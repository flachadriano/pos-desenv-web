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
		data : $("#form").serialize(),
		success : function(errors, status, xhr) {
			var message = "";
			for (var i = 0; i < errors.length; i++) {
				message += errors[i].field + ": " + errors[i].msg + "\r\n";
			}
			$("#error").val(message);
		},
		error : function(xhr, status, error) {
			$("#error").val(error);
		}
	});
}