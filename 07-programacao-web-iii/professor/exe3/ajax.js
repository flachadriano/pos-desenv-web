var vUrl = 'books.php';

document.addEventListener('DOMContentLoaded', function(){
	
	getEl('btnSelect').onclick = btnSelectClick;
	getEl('btnSave').onclick = btnSaveClick;
	getEl('btnNew').onclick = btnNewClick;
	getEl('btnDelete').onclick = btnDeleteClick;
	
});



function btnDeleteClick(){
	var r = confirm('Confirma a exclusão do livro "' + getVal('txtTitle') + '"?');
	if (!r)
		return;
	
	var id = getVal('txtId');
	var data = new FormData();
	data.append('id', id);
	ajaxDelete(vUrl, 
			data, 
			function(ajax){
				if (ajax.status == 'OK'){
					msg('O registro foi excluído!');
				}
				else{
					error('Não foi possível excluir:' + ajax.message);
				}
			}
	);
	
	
}

function btnNewClick(){
	hideMsg();
	setVal('txtId', '');
	setVal('txtTitle', '');
	setVal('txtAuthor', '');
	setVal('txtPrice', '');
	setVal('txtSite', '');
	getEl('txtId').disabled = false;
	getEl('txtId').focus();
}

function btnSelectClick(){
	var id = getVal('txtId');
	var data = 'id=' + id;
	
	ajaxGet(
			vUrl, 
			data, 
			function(d){
				if (d.status == 'OK'){
					setVal('txtId', d.id);
					setVal('txtTitle', d.title);
					setVal('txtAuthor', d.author);
					setVal('txtPrice', d.price);
					setVal('txtSite', d.site);
					getEl('txtId').disabled = true;
					hideMsg();
				}
				else{
					error('id:' + id + ' não encontrado!');
				}
			}, 
			true);
}

function btnSaveClick(){
	var func;
	var id = getVal('txtId');
	var data = new FormData();
	//Obter os dados dos campos do formulário
	data.append('id', id);
	data.append('title', getVal('txtTitle'));
	data.append('author', getVal('txtAuthor'));
	data.append('price', getVal('txtPrice'));
	data.append('site', getVal('txtSite'));
	
	if (exists(id)){
		func = ajaxPut;
	}
	else{
		func = ajaxPost;
	}
	
	var callbackDone = function(data){
		if (data.status == 'OK'){
			msg('Operação efetuada com sucesso.');
			setVal('txtId', data.id);
		}
		else{
			error('Ocorreu um erro ao salvar.');
		}
	};
	
	func(vUrl, data, callbackDone);
}

function exists(id){
	var result = false;
	callbackDone = function(data){
		result = data.status == 'OK' && data.id == id;
	};
	
	ajaxGet(vUrl, 'id=' + id, callbackDone, false);
	return result;
}

function showMsg(){
	getEl('msg').style.visibility = 'visible';
	//getEl('msg').style.display = 'block';
}

function hideMsg(){
	getEl('msg').style.visibility = 'hidden';
	//getEl('msg').style.display = 'none';
}

function showLoading(){
	getEl('msg').innerHTML = '<img src="loading.gif" alt="Carregando..." style="display:block">';	
	showMsg();
}


function msg(text){
	var msg = getEl('msg');
	msg.innerHTML = text;
	msg.className = 'msg msg-ok';
	showMsg();
}

function error(text){
	var msg = getEl('msg');
	msg.innerHTML = 'ERRO:' + text;
	msg.className = 'msg msg-error';
	showMsg();
}

function setVal(id, value){
	getEl(id).value = value;
}

function getVal(id){
	return getEl(id).value;
}

function getEl(id){
	return document.getElementById(id);
}

function getAjax(){
	var obj = new XMLHttpRequest();
	if (!obj){
		alert('Erro ao obter objeto Ajax.');
		obj = false;
	}
	return obj;
}

//http://www.w3schools.com/ajax/ajax_xmlhttprequest_send.asp
function ajax(type, url, data, callbackDone, /*callbackFail,*/ mimeType, async){
	var objAjax = getAjax();
	if (!objAjax){
		throw new Exception('Erro na objenção do objeto Ajax.');
	}
	
	showLoading();
	
	objAjax.onreadystatechange = function(){
		if (objAjax.readyState == 4){
			if (objAjax.status == 200 || objAjax.status == 304){
				var objJSON = null;
				try{
					hideMsg();
					objJSON = JSON.parse(objAjax.responseText);
				}
				catch(e){
					error(e.message);
				}
			
				callbackDone(objJSON);
			}
			else{//Ocorreu algum erro
				//callbackFail(objAjax);
				error(objAjax.responseText);
			}
		}//4
	};//statechange
	
	if (mimeType != '')
		objAjax.overrideMimeType(mimeType);
	
	if (type == 'GET'){
		var requestMethod = 'kind=' + type;
		if (data != null && data != '')
			data += '&' + requestMethod;
		else
			data = requestMethod;
	}
	else{
		data.append('kind', type);
		
		type = 'POST';//sobrescreve
	}
	
	if (type == 'GET' && data != null && data != ''){
		url += '?' + data;
		data = null;
	}
	
	objAjax.open(type, url, async);
	
	//http://www.w3.org/TR/html401/interact/forms.html
	//https://developer.mozilla.org/en-US/docs/Web/Guide/Using_FormData_Objects
	//if (type == 'PUT'){
	//	objAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//}
	
	objAjax.send(data);
}

//http://en.wikipedia.org/wiki/Representational_state_transfer
//CRUD RESTFull

//Obter
function ajaxGet(url, data, callbackDone, async){
	ajax('GET', url, data, callbackDone, 'application/json; charset:iso-8859-1', async);
}

//Criar
function ajaxPost(url, data, callbackDone){
	ajax('POST', url, data, callbackDone, 'application/json; charset:iso-8859-1', true);
}

//Excluir
function ajaxDelete(url, data, callbackDone){
	ajax('DELETE', url, data, callbackDone, 'application/json; charset:iso-8859-1', true);
}

//Atualizar
function ajaxPut(url, data, callbackDone){
	ajax('PUT', url, data, callbackDone, 'application/json; charset:iso-8859-1', true);
}

