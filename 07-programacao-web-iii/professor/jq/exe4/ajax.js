$(document).ready(function(){
	
	$('#btnLoad').click(loadData);
	
});

function loadData(){
	
	$.ajax({
		method: 'GET',
		url: 'do.php',
		dataType: 'json',
		timeout: 2000,
		beforeSend: function(xhr){
			$('#dados').empty();
			$('#dados').html('<span style="border: 1px solid red; background-color: yellow; padding:5px 5px; text-align: center; width:80px;">Aguarde, carregando...</span>');
		}
	})
	.done(function(data){
		processData(data);
	})
	.fail(function(obj, textStatus){
		$('#dados').empty();
		var text = $('span').css('color', 'red').text('Erro: ' + textStatus);
		$('#dados').append(text);
	});
}

function processData(data){
	$('#dados').empty();
	var html = 
		'<table><thead><tr>' +
		'<th>id#</th>' +
		'<th>Nome</th>' +
		'<th>E-mail</th>' +
		'</tr></thead>' +
		'<tbody>';
	$('input[value=""]').attr('value', data.length);//Atualiza a quantidade de registros do item Todos.
	$('label:eq(3) > span').text('Todos [' + data.length + ']');
	
	var numReg = $(':checked').attr('value');//Pega a quantidade de registros selecionados.
	$.each(data, function(i, obj){
		if(i < numReg){
			html += '<tr>' +
				'<td>' + obj.id + '</td>' +
				'<td>' + obj.nome + '</td>' +
				'<td>' + obj.email + '</td>' +
				'</tr>';
		}
	});//each
	
	html += '</tbody></table>';
	$('#dados').append(html);
	
	$('#dados table thead tr').css('backgroundColor', '#e3f1ff');
	$('#dados table tbody tr:odd').css('backgroundColor', '#f6faff');
	$('#dados tbody td:first-child').css('backgroundColor', '#e3f1ff');
}


