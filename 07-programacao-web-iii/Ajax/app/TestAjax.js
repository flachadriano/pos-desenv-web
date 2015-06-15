function getAjax() {
	return new XMLHttpRequest();
}

function log(text) {
	document.getElementById("log").innerHTML = text;
}

function testAjax() {
	var obj = getAjax();

	obj.onreadystatechange = function() {
		log("readState: " + obj.readstate + ", status: " + obj.status
				+ ", responseText: " + obj.responseText);
	}

	obj.open("GET", "msg.txt");
	obj.send(null);
}