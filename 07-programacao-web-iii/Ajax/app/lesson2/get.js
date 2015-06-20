$(document).ready(function() {
	onLoad();
	$("#sendBtn").click(buildFullName);
});

function onLoad() {
	$.get("welcome.php", "", function(data) {
		alert(data);
	});
}

function buildFullName() {
	var data = $("#frmGet").serialize();
	$.get("get.php", data, function(data) {
		$("#fullName").html(data);
	}, "html");
}