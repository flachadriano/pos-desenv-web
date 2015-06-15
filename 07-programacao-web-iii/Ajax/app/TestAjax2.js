function getAjax() {
	return new XMLHttpRequest();
}

function log(text) {
	document.getElementById("log").innerHTML = text;
}

document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("btnLogText").onclick = btnLoadTextClick;
	document.getElementById("btnLogJson").onclick = btnLoadJsonClick;
	document.getElementById("btnLogXml").onclick = btnLoadXmlClick;
})

function callback(ajax) {
}

function getFile(filename, callback, mimeType) {
	var obj = getAjax();

	if (!obj) {
		alert("Problema ao criar objeto Ajax");
		return;
	}

	obj.onreadystatechange = function() {
		if (obj.readySate == 4 && obj.status == 200) {
			callback(obj);
		}
	}

	if (mimeType != "") {
		obj.overrideMimeType(mimeType);
	}

	obj.open("GET", filename);
	obj.send(null);
}

function btnLoadTextClick() {
	getFile("files/msg.txt", function(ajax) {
		log(ajax.responseText);
	}, "text/html");
}

function btnLoadJsonClick() {
	alert("#TODO load JSON");
}

function btnLoadXmlClick() {
	alert("#TODO load XML");
}
