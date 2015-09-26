<?php
class Queries extends DataBase {
	public function listEntities($table) {
		$sql = "select * from $table";
		return $this->executeSQL ( $sql );
	}
	public function createEntity($table, $data) {
		$first = true;
		$columns = "";
		$params = "";
		$values = [];
		
		foreach ( $data as $field => $value ) {
			if ($first)
				$first = false;
			else {
				$columns .= ", ";
				$params .= ", ";
			}
			$columns .= $field;
			$params .= ":".$field;
			$values[$field] = $value;
		}
		
		$sql = "insert into $table($columns) values($values)";
		$this->executeInsert ( $sql, $values );
		return $sql;
	}
	public function get($table, $id) {
		$this->executeSQL ( "select * from $table where id = $id" );
	}
	public function update($table, $data) {
		$sql = "update $table set ";
		
		$first = true;
		foreach ( $data as $field => $value ) {
			if ($field == "id") {
				$id = $value;
				continue;
			}
			if ($first)
				$first = false;
			else
				$sql .= ", ";
			$sql .= "$field = $value";
		}
		
		$sql .= " where id = $id";
		
		$this->newTransaction ();
		$this->executeSQL ( $sql );
		$this->commit ();
		return $sql;
	}
	public function destroy($table, $id) {
		$this->executeSQL ( "delete from $table where id = $id" );
	}
}

?>