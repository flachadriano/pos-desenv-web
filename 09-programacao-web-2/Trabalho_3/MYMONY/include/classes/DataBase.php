<<<<<<< Updated upstream
=======
<<<<<<< HEAD
<?php
class DataBase {
	private $conexao;
	function __construct(){
		try {
			if (!$this->conexao) {
				$this->conexao = new PDO("mysql:host=localhost;port=3306;dbname=mymony", "root");
			}
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		}
	}
	public function executeSQL($sql) {
		$this->conexao->exec($sql);
		return $this->conexao->lastInsertId();
	}
	public function executeQuery($sql) {
		return $this->conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}
	public function executeInsert($sql, $params) {
		$this->conexao->prepare($sql)
		return $this->conexao->execute($params)->fetchAll(PDO::FETCH_ASSOC);
	}
	public function newTransaction() {
		return $this->conexao->beginTransaction ();
	}
	public function commit() {
		return $this->conexao->commit ();
	}
}
?>
=======
>>>>>>> Stashed changes
<?php
class DataBase {
	private $conexao;
	function __construct(){
		try {
			if (!$this->conexao) {
				$this->conexao = new PDO("mysql:host=localhost;port=3306;dbname=mymony", "root");
			}
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		}
	}
	public function executeSQL($sql) {
		$this->conexao->exec($sql);
		return $this->conexao->lastInsertId();
	}
	public function executeQuery($sql) {
		return $this->conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}
	public function newTransaction() {
		return $this->conexao->beginTransaction ();
	}
	public function commit() {
		return $this->conexao->commit ();
	}
}
?>
<<<<<<< Updated upstream
=======
>>>>>>> origin/master
>>>>>>> Stashed changes
