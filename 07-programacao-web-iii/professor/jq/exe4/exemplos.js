$(document).ready(function(){
	var url = 'http://www.koiote.com.br/dojsonp.php?koiote_json_callback=?';
	$.getJSON(url,
			{
		      id: 10, 
		      age: 29, 
		      name: "Megan Fox"
		     },
		     function(receiveData){
		    	 //código que processa os dados recebidos...
		     });
});







