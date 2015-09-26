<?php
class Queries extends DataBase {
	public function ListAll($table)
	{
		$sql = "select * from " . $table;
		$result = $this->executeQuery($sql);
		return json_encode($result, JSON_UNESCAPED_UNICODE);
	}
	public function ListAllComFiltro($table, $filtro)
	{
		$sql = "select * from $table where $filtro" ;
		$result = $this->executeQuery($sql);
		return json_encode($result, JSON_UNESCAPED_UNICODE);
	}
	public function Insert($table, $data)
	{
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
		$result = $this->executeSQL ( $sql );
		$this->commit ();

		return $result;
	}
	public function Get($table, $id)
	{
		$result = $this->executeSQL( "select * from $table where id = $id" )[0];
		return json_encode($result, JSON_UNESCAPED_UNICODE);
	}
	public function Update($table, $data)
	{
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
		$result = $this->executeSQL ( $sql );
		$this->commit ();
		return $result;
	}
	public function Delete($table, $id)
	{
		$result = $this->executeSQL ( "delete from $table where id = $id" );
		return $result;
	}
}
?>
