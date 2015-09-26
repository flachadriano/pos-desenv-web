<?php
$q = new Query ();
$q . destroy ( "products", $_GET ["id"] );

header ( "Location: /app/products.php" );

?>