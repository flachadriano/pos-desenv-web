<?php
$q = new Query ();
$q . destroy ( "clients", $_GET ["id"] );

header ( "Location: /app/clients.php" );

?>