$(document).ready(function() {
	onLoad();
	$("#sendGetBtn").click(buildFullNameGet);
	$("#sendPostBtn").click(buildFullNamePost);
});

function onLoad() {
	$.get("welcome.php", "", function(data) {
		alert(data);
	});
}

function buildFullNameGet() {
	var data = $("#frmGet").serialize();
	$.get("get.php", data, function(data) {
		$("#fullName").html(data);
	}, "html");
}

function buildFullNamePost() {
	var name = $("#name").val();
	var lastName = $("#lastName").val();

	if (name == "") {
		alert("Informe o nome");
		$("#name").focus();
		return;
	}

	if (lastName == "") {
		alert("Informe o sobrenome");
		$("#lastName").focus();
		return;
	}

	$.post("post.php", {
		name : name,
		lastName : lastName
	}, function(data) {
		$("#fullName").html(data);
	}, "html");
}
