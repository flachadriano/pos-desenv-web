function getAjax(){
	var objAjax = false;
	if (window.XMLHttpRequest){
		objAjax = new XMLHttpRequest();
	}
	else if (window.ActiveXObject){
		objAjax = new ActiveXObject("Msxml2.XMLHTTP");
		if (!objAjax){
			objAjax = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	else
		throw new Exception('Seu navegador não suporta Ajax.');
	return objAjax;
}

function log(text){
	document.getElementById('console').innerHTML += '<br>' + text;
}

function testAjax(){
	var ajax = getAjax();
	if (!ajax){
		log('Erro ao obter objeto Ajax.');
		return;
	}
	
	ajax.onreadystatechange = function(){
		log('ajax.readyState:' + ajax.readyState +
				', status:' + ajax.status +
				', responseText:' + ajax.responseText);	
	};
	
	//https://developer.mozilla.org/pt-BR/docs/Web/API/XMLHttpRequest
	//sobrescreve o cabeçalho enviado pelo servidor, chamar antes de neviar
	ajax.overrideMimeType('text/html; charset=iso-8859-1');
	ajax.open('GET', 'msg.txt');
	ajax.send(null);
}