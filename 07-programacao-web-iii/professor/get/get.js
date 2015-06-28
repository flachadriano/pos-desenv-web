$(document).ready(function(){

	//aoCarregar();
	$('#btnEnviar').click(montaNome2);
	
});

function montaNome2(){
	//var data = $('#frmGet').serialize();
	var xNome = $('#nome').val();
	var xSobreNome = $('#sobreNome').val();
	
	if(xNome == ''){
		alert('Informe o nome.');
		$('#nome').focus();
		return;
	}
	
	if(xSobreNome == ''){
		alert('Informe o sobre nome.');
		$('#sobreNome').focus();
		return;
	}
	
	var func = function(data){
		$('#nomeCompleto').html(data);
	};
	
	$.post('get.php', 
			{nome: xNome, sobreNome: xSobreNome}, 
			func, 
			'html');
}

function montaNome(){
	var data = $('#frmGet').serialize();
	var func = function(data){
		$('#nomeCompleto').html(data);
	};
	
	$.get('get.php', data, func, 'html');
}









function aoCarregar(){
	$.get(
			'get.php', 
			'', 
			function(data){
				alert(data);
			}
	);
}
