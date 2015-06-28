$(document).ready(function(){
	$('#carregando').hide();
	$('#btnCarregar').click(montaNome);
});

function montaNome(){
	$.ajax({
		url: 'timeout.php',
		timeout: 3000,
		method: 'POST',
		data: {nome: 'Márcio', sobreNome: 'Koch'},
		dataType: 'json',
		contentType: 'charset=UTF-8',
		beforeSend: function(){
			$('#carregando').show();
		}
	})
	.success(function(data){
		$('#dados').prepend('<br />' + data.nome + ' ' + data.sobreNome);
	})
	.error(function(obj, status, msg){
		$('#dados').prepend('<br />' + msg);
	})
	.complete(function(){
		$('#carregando').hide();
	});
}