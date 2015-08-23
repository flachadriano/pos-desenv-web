<?php
include "../../framework/framework.php";

$q = new Queries ();
$q->createEntity ( "products", $_POST );

header ( "Location: /app/products.php" );

?>