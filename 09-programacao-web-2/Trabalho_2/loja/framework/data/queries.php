<?php
class Queries extends DataBase {
	public function listEntities($table) {
		$this->executeSQL ( "select count(*) from " . $table );
	}
	public function createEntity($table, $data) {
		$sql = "insert into " . $table . "(";
		
		$first = true;
		foreach ( $data as $field => $value ) {
			if ($first)
				$first = false;
			else
				$sql .= ", ";
			$sql .= $field;
		}
		
		$sql .= ") values(";
		
		$first = true;
		foreach ( $data as $field => $value ) {
			if ($first)
				$first = false;
			else
				$sql .= ", ";
			$sql .= "'" . $value . "'";
		}
		
		$sql .= ")";
		
		$this->newTransaction ();
		$this->executeSQL ( $sql );
		$this->commit ();
		return $sql;
	}
}

?>