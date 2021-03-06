<?php
   $_PUT = Array();
   
	class Book{
		public $id = 0;
		public $title = '';
		public $author = '';
		public $price = 0.0;
		public $site = '';
		
		public function assign(Book $book){
			$this->id = $book->id;
			$this->title = $book->title;
			$this->author = $book->author;
			$this->price = $book->price;
			$this->site = $book->site;	
		}
		
		public function toArray(){
			$array = Array('id' => $this->id,
					'title' => $this->title,
					'author' => $this->author,
					'price' => $this->price,
					'site' => $this->site);
				
			return $array;
		}
		
		public function toJSON(){
			return json_encode($this->toArray());
		}
	}
	
	class BookList{
		private $list;
		
		public function __construct(){
			$this->list = Array();
		}
		
		public function exists($id){
			return array_key_exists($id, $this->list);
		}
		
		public function add(Book $book){
			if (! $this->exists($book->id)){
				$this->list[$book->id] = $book;
			}
			else{
				throw new Exception("Livro com id '$book->id' j� existe.");
			} 
		}
		
		public function edit(Book $book){
			if ($this->exists($book->id)){
				$theBook = $this->list[$book->id];
				$theBook->assign($book);
			}
			else{
				throw new Exception("Livro com id '$book->id' n�o pode ser eitado porque n�o existe.");
			} 
		}
		
		public function get($id){
			if (array_key_exists($id, $this->list)){
				return $this->list[$id];
			}
			return null;
		}
		
		public function del($id){
			if (array_key_exists($id, $this->list)){
				unset($this->list[$id]);
			}
			else{
				throw new Exception("Livro '$id' n�o existe para exluir.");
			}
		}
	}
	
	const BOOKS_LIST = 'BOOKS_LIST';

	class BookRest{
		private $method = '';
		
		public function getBookList(){
			if (isset($_SESSION[BOOKS_LIST])){
				$bookList = $_SESSION[BOOKS_LIST];
				return $bookList;
			}
			else{
				$bookList = new BookList();
				$_SESSION[BOOKS_LIST] = $bookList;
				return $bookList;
			}
		}
		
		
		public function createOneBookPlease(){
			$bookList = $this->getBookList();
			
			if (! $bookList->exists(1)){
				$book = new Book();
				$book->id = 1;
				$book->title = 'Livro de exemplo';
				$book->author = 'Marcio Koch';
				$book->price = 10.50;
				$book->site = 'http://www.koiote.com.br';				
				$bookList->add($book);
			}
		}

		public function __construct(){
			/*$this->method = $_SERVER['REQUEST_METHOD'];
			if ($this->method == 'PUT'){
				parse_str(file_get_contents("php://input"), $_PUT);
				print_r($_PUT);
				exit;
			}*/
			
			$this->method = $this->getVal('kind');
			$this->createOneBookPlease();
		}
		
		public function run(){
			switch ($this->method){
				case 'GET':	$this->restGet(); break;
				case 'POST': $this->restPost(); break;
				case 'PUT': $this->restPut(); break;
				case 'DELETE': $this->restDelete(); break;
				default: $this->restError(); break;
			}//switch
		}
		
		
		private function restGet(){
			$id = $this->getVal('id');
			$bookList = $this->getBookList();
			$book = $bookList->get($id);
			$result = Array();
			if ($book != null){
				$result = $book->toArray();
				$result['status'] = 'OK';	
			}
			else{
				$result['status'] = 'NOK';
			}
			
			sleep(1);
			
			$json = json_encode($result);
			$this->sendJson($json);					
		}
		
		private function restPost(){
			$book = $this->getData();
			
			$bookList = $this->getBookList();
			try{
				$bookList->add($book);
				$book = $bookList->get($book->id);
				$result = Array();
				if ($book != null){
					$result = $book->toArray();
					$result['status'] = 'OK';
				}
				else{
					$result['status'] = 'ERROR';
					$result['message'] = 'Livro adicionado mas n�o encontrado.';
				}
				
				$json = json_encode($result);
				$this->sendJson($json);
				
			}
			catch(Exception $e){
				$this->sendError($e);
			}
			
			
		}
		
		private function restPut(){
			$book = $this->getData();
			
			$bookList = $this->getBookList();
			try{
				$bookList->edit($book);
				$book = $bookList->get($book->id);
				
				$result = Array();
				if ($book != null){
					$result = $book->toArray();
					$result['status'] = 'OK';
				}
				else{
					$result['status'] = 'ERROR';
					$result['message'] = 'Livro alterado mas n�o encontrado.';
				}
			
				$json = json_encode($result);
				$this->sendJson($json);
			
			}
			catch(Exception $e){
				$this->sendError($e);
			}	
		}
		
		private function restDelete(){
			$id = $this->getVal('id');
			try{
				$bookList = $this->getBookList();
				$bookList->del($id);
				$result['status'] = 'OK';
					
				$json = json_encode($result);
				$this->sendJson($json);
			}
			catch(Exception $e){
				$this->sendError($e);
			}
		}
		
		private function sendError(Exception $error){
			$result['status'] = 'ERROR';
			$result['message'] = $error->getMessage();
			$json = json_encode($result);
			$this->sendJson($json);
		}
		
		private function restError(){
			try{
				throw new Exception("Opera��o inv�lida '$this->method'.");	
			}	
			catch(Excption $e){
				$this->sendError($e);
			}
		}
		
		private function getData(){
			$book = new Book();
			$book->id = $this->getVal('id');
			$book->title =$this->getVal('title');
			$book->author = $this->getVal('author');
			$book->price = $this->getVal('price');
			$book->site = $this->getVal('site');
			return $book;
		}
		
		private function sendJson($json){
			header('Content-type: application/json; charset=UTF-8');
			echo $json;
		}
		
		private function getVal($key){
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
		
	}
	
	session_start();
	//Instancia um livro e executa
	$bookRest = new BookRest();
	$bookRest->run();
	
?>