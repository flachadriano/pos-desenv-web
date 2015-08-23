<?php
include "../../framework/framework.php";

$q = new Queries ();
$q->updateEntity ( "categories", $_POST );

header ( "Location: /app/categories.php" );

?>