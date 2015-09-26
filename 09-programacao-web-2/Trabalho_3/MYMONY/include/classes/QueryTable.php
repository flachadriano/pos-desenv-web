<<<<<<< Updated upstream
=======
<<<<<<< HEAD
<?php
class QueryTable extends DataBase {
	private $table;

	function __construct($table)

	public function ListAll()
	{
		$sql = "select * from " . $this->table;
		$result = $this->executeQuery($sql);
		return json_encode($result, JSON_UNESCAPED_UNICODE);
	}
	public function ListAllComFiltro($filtro)
	{
		$sql = "select * from $this->table where $filtro" ;
		$result = $this->executeQuery($sql);
		return json_encode($result, JSON_UNESCAPED_UNICODE);
	}
	public function Insert($data)
	{
		$sql = "insert into " . $this->table . "(";
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
	public function Get($data)
	{
		$result = $this->executeSQL( "select * from $this->table where id = $data->id" )[0];
		return json_encode($result, JSON_UNESCAPED_UNICODE);
	}
	public function Update($data)
	{
		$sql = "update $this->table set ";

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

			$sql .= "$field = '$value'";
		}

		$sql .= " where id = $id";

		$this->newTransaction ();
		$result = $this->executeSQL ( $sql );
		$this->commit ();
		return $sql;
	}
	public function Delete($item)
	{
		$result = $this->executeSQL ( "delete from $this->table where id = $item->id" );
	}

	public function createEntity($data) {
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

		$sql = "insert into $this->table($columns) values($values)";
		$this->executeInsert ( $sql, $values );
		return $sql;
	}

}
?>
=======
>>>>>>> Stashed changes
<?php
class QueryTable extends DataBase {
	private $table;

	function __construct($table)
	{
		$this->table = $table;
		parent::__construct();
	}
	public function ListAll()
	{
		$sql = "select * from " . $this->table;
		$result = $this->executeQuery($sql);
		return json_encode($result, JSON_UNESCAPED_UNICODE);
	}
	public function ListAllComFiltro($filtro)
	{
		$sql = "select * from $this->table where $filtro" ;
		$result = $this->executeQuery($sql);
		return json_encode($result, JSON_UNESCAPED_UNICODE);
	}
	public function Insert($data)
	{
		$sql = "insert into " . $this->table . "(";
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
	public function Get($data)
	{
		$result = $this->executeSQL( "select * from $this->table where id = $data->id" )[0];
		return json_encode($result, JSON_UNESCAPED_UNICODE);
	}
	public function Update($data)
	{
		$sql = "update $this->table set ";

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

			$sql .= "$field = '$value'";
		}

		$sql .= " where id = $id";

		$this->newTransaction ();
		$result = $this->executeSQL ( $sql );
		$this->commit ();
		return $sql;
	}
	public function Delete($item)
	{
		$result = $this->executeSQL ( "delete from $this->table where id = $item->id" );
	}
}
?>
<<<<<<< Updated upstream
=======
>>>>>>> origin/master
>>>>>>> Stashed changes
