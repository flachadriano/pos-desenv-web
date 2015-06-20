$(document).ready(function() {
	$("#uploadBtn").click(upload);
});

function upload() {
	var data = new FormData();
	var file = $("#file")[0].files[0];

	data.append("file", file);

	$.ajax({
		url : "upload.php",
		method : "POST",
		processData : false,
		contentType : false,
		data : data
	}).success(function(data) {
		$("#body").append("<br/>" + data)
	}).error(function(obj, status, error) {
		alert("Erro: " + status + ", " + error);
	});
}