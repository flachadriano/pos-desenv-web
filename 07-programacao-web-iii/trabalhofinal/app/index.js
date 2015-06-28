$(document).ready(function(){
	buildResourcesTable();	
});

function buildResourcesTable() {
	$.get('resources.php', null, new function(data) {
		
	});
	
	$("#home_resources").html("<button>Botao</button>");
}