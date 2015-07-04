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
		model : getURLParameter("model"),
		id : getURLParameter("id")
	}, function(data) {
		var result = JSON.parse(data);

		var fields = result.fields;
		var record = result.record;

		for (var i = 0; i < fields.length; i++) {
			var field = "<div class=field>";
			field += "<span>" + fields[i].label + ": </span>";
			field += "<input type='text'";
			field += " name=" + fields[i].name;
			if (record) {
				field += " value=" + record[fields[i].name];
			}
			field += ">";
			field += "</div>";

			$("#form").append(field);
		}
	});
}

function save() {
	$.ajax({
		type : "POST",
		url : "controllers/create.php?model=" + getURLParameter("model")
				+ "&id=" + getURLParameter("id"),
		dataType : "json",
		data : $("#form").serialize(),
		success : function(errors, status, xhr) {
			if (errors.length == 0) {
				window.location.href = "list.html?model="
						+ getURLParameter("model");
			} else {
				var message = "";
				for (var i = 0; i < errors.length; i++) {
					message += errors[i].field + ": " + errors[i].msg + "\r\n";
				}
				$("#error").val(message);
			}
		},
		error : function(xhr, status, error) {
			$("#error").val(error);
		}
	});
}