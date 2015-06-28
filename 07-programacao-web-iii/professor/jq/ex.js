$(document).ready(function(){
	
	getTitle();
	$('#btnEnviar').click(doPost);
	$('#btnAjax').click(doAjax);
	$('#btnUpload').click(upload);
	
});

function getTitle(){
	$.get('get.php', 
			'texto=Turma 11 de pós web da FURB dominando Ajax com jQuery!', 
			function(resposta){
		$('h1').eq(0).html(resposta);
	}, 'html');
}

function doPost(){
	$.post('post.php', 
			$('#frmPost').serialize(), 
			function(resultado){
				alert(resultado);
		
	}, 
			'html');
}

function upload(){
	var data = new FormData();
	var file = $('#file')[0].files[0];
	
	data.append('file', file);
	$.ajax({
		url: 'upload.php',
		method: 'POST',
		processData: false,
		contentType: false,
		data: data	
	})
	.success(function(data){
		$('body').append('<hr />' + data);
	})
	.error(function(obj, status, erro){
		alert('Erro:' + status + ', ' + erro);
	});
}

function doAjax(){
	var el = $.ajax({
			url: 'ajax.php', 
			method: 'GET',
			async: true,
			dataType: 'json',
			timeout: 1000,
			data: {id: 181, name: 'Furb', valor: 150.52},
			beforeSend: function(){
				var x = '<div id="carregando" style="width: 150px; border: 1px solid black; background-color:yellow; text-align:center; padding:5px">Carregando...</div>';
				$('body').prepend(x);
			}
	})
	.error(function(jqXHR, textStatus, error){
		alert('Erro:' + textStatus + ', ' + error);
	});
	
	el.success(function(resultado){
		alert('Sucesso:' + resultado.name);
	})
	.complete(function(data){
		alert('Completou!');
		$('#carregando').remove();
	});
}