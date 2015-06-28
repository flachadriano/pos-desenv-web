<?php
include 'books.php';

define('API_URI', 'http://localhost/furb/api/api.php');

//Objetos
const cObject = 'object';
const cAutor = 'Autor';
const cEditora = 'Editora';
const cLivro = 'Livro';

//M�todos
const cURI = 'uri';
const cMethod = 'method';
const cGET = 'GET';
const cPOST = 'POST';

//Opera��es
const cOperations = 'operations';
const cOperation = 'operation';
const cNew = 'new';
const cUpdate = 'update';
const cDelete = 'delete';
const cSelect = 'select';
const cSelectAll = 'selectAll';  


//Template
const cType = 'type';
const cTemplate = 'template';
const cFields = 'fields';
const cField_Name = 'name';
const cField_Kind = 'kind';
const cField_Description = 'description';
const cField_Required = 'required';
const cField_Value = 'value';
const cTrue = true;
const cFalse = false;

//Tipos de campos
const cString = 'string';
const cInteger = 'integer';
const cDouble = 'double';

//Result
const cResult = 'result';
const cResult_OK = 'OK';
const cResult_Error = 'ERROR';
const cResult_Message = 'message';

// ************** Fun��es gen�ricas ******************
function sendJson($json){
	header('Content-type: application/json; charset=UTF-8');
	echo $json;
}

function getVal($key){
	if (isset($_GET[$key])){
		return trim(strip_tags($_GET[$key]));
	}
	else{
		if (isset($_POST[$key])){
			return trim(strip_tags($_POST[$key]));
		}
		else
			return null;
	}//else
}
//**************************************************

abstract class ApiObject{
	
	abstract public function run();
	abstract public function getEntryPoints();
	
} 

class Livro extends ApiObject{
	
	public function getEntryPoints(){
		//"uri": "http://localhost/furb/api/api.php?object=Livro",
		
		//"uri": "http://localhost/furb/api/api.php?object=Autor&operation=new&type=template",
		//"uri": "http://localhost/furb/api/api.php?object=Autor&operation=edit"
		//"uri": "http://localhost/furb/api/api.php?object=Autor&operation=select"
		//"uri": "http://localhost/furb/api/api.php?object=Autor&operation=selectAll"
		//"uri": "http://localhost/furb/api/api.php?object=Autor&operation=delete"
		
		//"uri": "http://localhost/furb/api/api.php?object=Autor&operation=new",
		$operations = Array(cNew, cUpdate, cDelete, cSelect, cSelectAll);
		$data = Array(cObject => cLivro);
		
		$itens = Array();
		foreach ($operations as $op){
			$item = Array(cURI => API_URI . '?' . cObject . '=' . cLivro . '&' . cOperation . '=' . $op . '&' . cType . '=' . cTemplate, 
				  cOperation => $op, cType => cTemplate, cMethod => cGET);
			$itens[] = $item; //Adiciona
		}//for
		$data[cOperations] = $itens;
		
		sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
	}
	
	private function doNewTemplate(){
		//"uri": "http://localhost/furb/api/api.php?object=Livro&operation=new_template"
		$data = Array(cObject => cLivro, 
		cFields => Array(
			Array(cField_Name => 'id', cField_Description => 'Identificador', cField_Kind => cInteger, cField_Required => cTrue, cField_Value => ''),
			Array(cField_Name => 'title', cField_Description => 'Titulo', cField_Kind => cString, cField_Required => cTrue, cField_Value => ''),		
			Array(cField_Name => 'author', cField_Description => 'Autor', cField_Kind => cString, cField_Required => cTrue, cField_Value => ''),
			Array(cField_Name => 'price', cField_Description => 'Preco', cField_Kind => cDouble, cField_Required => cTrue, cField_Value => ''),
			Array(cField_Name => 'site', cField_Description => 'Site', cField_Kind => cString, cField_Required => cFalse, cField_Value => '')
		),
		cURI => API_URI . '?' . cObject . '=' . cLivro . '&' . cOperation . '=' . cNew,
		cMethod => cPOST
		);
		sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
	}
	
	public function doNew(){
		//"uri": "http://localhost/furb/api/api.php?object=Livro&operation=new"
		$id = getVal('id');
		$title = getVal('title');
		$author = getVal('author');
		$price = getVal('price');
		$site = getVal('site');
		
		$errors = Array();
		
		if ($id == '')
			$errors[] = 'Id deve ser informado.';
		
		if ($title == '')
			$errors[] = 'Titulo deve ser informado.';
		
		if ($author == '')
			$errors[] = 'Autor deve ser informado.';
		
		if ($price == '')
			$errors[] = 'Preco deve ser informado.';
		
		if (count($errors) == 0){
			$boookRest = new BookRest();
			if ($boookRest->restPost())			
				$data = Array(cResult => cResult_OK, cResult_Message => 'Livro ' . $title . ' cadastrado com sucesso!');
			else
				$data = Array(cResult => cResult_Error, cResult_Message => 'Ocorreu um erro ao cadastrar o livro.');
		}
		else{
			$data = Array(cResult => cResult_Error, cResult_Message => $errors);
		}
		
		sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
	}
	
	public function doNewError(){
		//"uri": "http://localhost/furb/api/api.php?object=Livro&operation=new"
		$data = Array(cResult => cResult_Error, cResult_Message => 'O nome do livro deve ser informado.');
		sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
	}
	
	public function run(){
		$operation = getVal(cOperation);
		$type = getVal(cType);
		switch($operation){
			case cNew: 
				if ($type == cTemplate){
					$this->doNewTemplate();
				}
				else{
					$this->doNew();
				}
				break;
			case cNew . '_error':  
				$this->doNewError();
				break;

			default:
				$this->getEntryPoints();
				break;
		}
			
	}
}

class Api extends ApiObject{
	
	
	public function getEntryPoints(){
		$data = Array(
					Array(cObject => cAutor, cURI => API_URI . '?' . cObject . '=' . cAutor, cMethod => cGET),
					Array(cObject => cEditora, cURI => API_URI . '?' . cObject . '=' . cEditora, cMethod => cGET),
					Array(cObject => cLivro, cURI => API_URI . '?' . cObject . '=' . cLivro, cMethod => cGET),
				);
		
		sendJson(stripslashes(json_encode($data, JSON_PRETTY_PRINT)));
	}
	
	
	
	public function run(){
		$object = getVal(cObject);
		if ($object != ''){
			(new $object)->run();	
		}
		else	
  			$this->getEntryPoints();
	}
}



$api = new Api();
$api->run();
