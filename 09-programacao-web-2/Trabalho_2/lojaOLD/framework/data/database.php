<?php
class DataBase {
	private $conexao;
	public function DataBase() {
		try {
			if (! $this->conexao) {
				$this->conexao = new PDO ( "sqlite:database.db" );
			}
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		}
	}
	public function executeSQL($sql) {
		return $this->conexao->query ( $sql );
	}
	public function executeInsert($sql) {
		$this->conexao->exec($sql);
	}
}

?>