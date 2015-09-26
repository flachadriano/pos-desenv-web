<?php
$q = new Query ();
$q . destroy ( "categories", $_GET ["id"] );

header ( "Location: /app/categories.php" );

?>