$(document).ready(function(){
	$('#consulta').autocomplete({
		source: 'ui.php',
		minLength: 2,
		select: function(event, ui){
			alert('Você selecionou: ' + ui.item.value);
		}
	});
});
