//http://wiki.locaweb.com/pt-br/Como_resolver_problemas_de_acentua%C3%A7%C3%B5es_em_seu_site
document.addEventListener('DOMContentLoaded', function(){
	
	//Liga o evento onclick ao botão btnLoad
	document.getElementById('btnLoadText').onclick = btnLoadTextClick;
	document.getElementById('btnLoadXML').onclick = btnLoadXMLClick;
	document.getElementById('btnLoadJSON').onclick = btnLoadJSONClick;
	
});

function getAjax(){
	var obj = new XMLHttpRequest();
	if (!obj){
		alert('Seu navegador não suporta AJAX!');
		return false;
	}
	
	return obj;
}

function getFile(fileName, callback, mimeType){
	var ajax = getAjax();
	if (! ajax){
		alert('Erro ao criar objeto Ajax!');
		return;
	}
	
	ajax.onreadystatechange = function (){
		if (ajax.readyState == 4 && ajax.status == 200)
		  callback(ajax);
	};
	
	if (mimeType != '')
		ajax.overrideMimeType(mimeType);
	ajax.open('GET', fileName);
	ajax.send(null);
}

function clearNodes(node){
	while(node.hasChildNodes()){
		node.removeChild(node.lastChild);
	}
}

function clearConsole(){
	clearNodes(document.getElementById('console'));
}

function btnLoadJSONClick(){
	getFile('livros.json', function(ajax){
		try{
			var livros = JSON.parse(ajax.responseText).livros;
			var i;
			var t, r, c;
			t = document.createElement('table');
			t.setAttribute('style', 'border: 1px solid red; margin: 15px;');
			r = t.insertRow(0);
			r.setAttribute('style', 'background-color: yellow');
			
			c = r.insertCell(0);
			c.innerHTML = 'id';
			
			c = r.insertCell(1);
			c.innerHTML = 'Título';
			
			c = r.insertCell(2);
			c.innerHTML = 'Autor';
			
			c = r.insertCell(3);
			c.innerHTML = 'Preço';
			
			c = r.insertCell(4);
			c.innerHTML = 'Site';
			
			for(i = 0; i < livros.length; i++){
				var livro = livros[i];
				r = t.insertRow(i + 1);
				r.setAttribute('style', 'background-color: #0acb4a');
				
				c = r.insertCell(0);
				c.innerHTML = livro.id;
				
				c = r.insertCell(1);
				c.innerHTML = livro.titulo;
				
				c = r.insertCell(2);
				c.innerHTML = livro.autor;
				
				c = r.insertCell(3);
				c.innerHTML = livro.preco;
				
				c = r.insertCell(4);
				c.innerHTML = livro.site;
			}
			
			clearConsole();
			document.getElementById('console').appendChild(t);
		}
		catch(e){
			log('Erro na conversão do JSON:  ' + e.message);
		}
	}, 
	'application/json; charset:iso-8859-1');
}


function btnLoadXMLClick(){
	getFile('livros.xml', function(ajax){
		var xml = ajax.responseXML;
		var livros = xml.getElementsByTagName('livros')[0];
		var i;
		
		clearConsole();
		
		var div = document.createElement('div');
		for(i = 0; i < livros.childElementCount; i++){
			var livro = livros.children[i];
			
			var item = document.createElement('div');
			item.setAttribute('style', 'background-color: #fff');
			
			//id
			var id = document.createElement('p');
			var text = document.createTextNode('id: ' + livro.children[0].innerHTML);
			id.appendChild(text);
			item.appendChild(id);
			
			//Título
			var title = document.createElement('h2');
			text = document.createTextNode('Título: ' + livro.children[1].innerHTML);
			title.appendChild(text);
			item.appendChild(title);
			
			//Autor
			var author = document.createElement('p');
			text = document.createTextNode('Autor: ' + livro.children[2].innerHTML);
			author.appendChild(text);
			item.appendChild(author);
			
			//Preço
			var price = document.createElement('p');
			text = document.createTextNode('Preço: ' + livro.children[3].innerHTML);
			price.appendChild(text);
			item.appendChild(price);
			
			//Site
			var site = document.createElement('a');
			site.setAttribute('href', livro.children[4].innerHTML);
			site.setAttribute('target', '_blank');
			text = document.createTextNode(livro.children[4].innerHTML);
			site.appendChild(text);
			item.appendChild(site);
			
			div.appendChild(item);
			div.appendChild(document.createElement('hr'));
			
		}//for
		log(div.innerHTML);
	}, 
	'text/xml; charset=iso-8859-1');
}

function btnLoadTextClick(){
	getFile('msg.txt', 
	function(ajax){
		clearConsole();
		log(ajax.responseText);
	}, 
	'text/html; charset=iso-8859-1');
}

function log(text){
	document.getElementById('console').innerHTML += '<br>' + text;
}