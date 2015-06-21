$(document).ready(function() {
	$("#loading").hide;
	$("#loadBtn").click(buildName);
});

function buildName() {
	$.ajax({
		url : "timeout.php",
		timeout : 5000,
		method : "POST",
		data : {
			name : "Adriano",
			lastName : "Flach"
		},
		dataType : "json",
		beforeSend : function() {
			$("#loading").show();
		}
	}).success(function(data) {
		$("#data").prepend(data.name + " " + data.lastName);
	}).error(function(request, status, msg) {
		$("#data").prepend(msg);
	}).complete(function() {
		$("#loading").hide;
	});
}