<?php
include "../../framework/framework.php";

$q = new Queries ();
$q->updateEntity ( "products", $_POST );

header ( "Location: /app/products.php" );

?>