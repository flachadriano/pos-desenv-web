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
	var model = getURLParameter("model");
	var id = getURLParameter("id");
	var type = id ? "update" : "create";
	var params = "type=" + type + "&model=" + model + "&id=" + id;

	$.ajax({
		type : "POST",
		url : "controllers/library.php?" + params,
		dataType : "json",
		data : $("#form").serialize(),
		success : function(data, status, xhr) {
			$("#error").val("");

			if (data.success == true) {
				window.location.href = data.url + "?model=" + model;
			} else {
				$.each(data.errors, function(field, error) {
					$("#error").val(
							$("#error").val() + field + ": " + error + "\r\n");
				})
			}
		}
	});
}