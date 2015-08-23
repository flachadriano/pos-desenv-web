<?php
include "../../framework/framework.php";

$q = new Queries ();
$q->createEntity ( "categories", $_POST );

header ( "Location: /app/categories.php" );

?>