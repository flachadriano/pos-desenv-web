var vUrlAPI = 'http://localhost/furb/api/api.php';
var vTemplate = null;

$(document).ready(function(){
	
	$('#console').attr('style', 'border: 1px solid red');
	
	$('#btnSave').click(save);
	
	mountForm();	
	
});

function log(texto){
	var now = new Date;
	var DataHora = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds() + ":" + now.getMilliseconds();
	
	var html = $('#console').html();
	html = DataHora + ' - ' + texto + '<br>' + html;
	
	$('#console').html(html);
}

function fail(jqXHR, textStatus){
	log('Erro: ' + textStatus);
}

function mountForm(){
	$.ajax({
		url: vUrlAPI,
		dataType: 'json',
		type: 'GET'
	})
	.done(function(data){
		var i;
		var obj = null;
		for (i = 0; i < data.length; i++){
			obj = data[i];
			if (obj.object == 'Livro')
				break;
			
		}//for
		
		if(obj == null){
			log('Não encontrou o objeto "Livro".');
			return;
		}
		
		mountForm2(obj);
	})
	.fail(fail);
}

function mountForm2(obj){
	$.ajax({
		url: obj.uri,
		dataType: 'json',
		type: obj.method
	})
	.done(function(data){
		var i;
		var operations = data.operations;
		var op = null;
		for (i = 0; i < operations.length; i++){
			op = operations[i];
			if (op.operation == 'new' && op.type == 'template')
				break;
			
		}//for
		
		if(op == null){
			log('Não encontrou operação "new" no template do objeto "Livro".');
			return;
		}
		
		mountForm3(op);
	})
	.fail(fail);
}

function mountForm3(op){
	$.ajax({
		url: op.uri,
		dataType: 'json',
		type: op.method
	})
	.done(function(data){
		vTemplate = data;
		var fields = data.fields;
		var i;
		var form = $('#frmLivro');
		var html = '';
		for(i = 0; i < fields.length; i++){
			var field = fields[i];
			html += '<p><label for="' + field.name + '">' + field.description + ':</label>' + '<input type="text" id="' + field.name + '" name="' + field.name + '">';
			html += '</p>';
		}
		form.html(html);
	})
	.fail(fail);
}

function save(){
	
	var xData = new FormData();
	var fields = vTemplate.fields;
	var i;
	for(i = 0; i < fields.length; i++){
		var field = fields[i];
		var val = $('#' + field.name).val();
		xData.append(field.name, val);
	}//for
	
	$.ajax({
		url: vTemplate.uri,
		dataType: 'json',
		type: vTemplate.method,
		
		//Para funciotnar POST com FormData
		processData: false,
	    contentType: false,
		data: xData
	})
	.done(function(data){
		log(data.result + ' - ' + data.message);
	})
	.fail(fail);	
}