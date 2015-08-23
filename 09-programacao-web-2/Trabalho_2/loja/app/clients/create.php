<?php
include "../../framework/framework.php";

$q = new Queries ();
$q->createEntity ( "clients", $_POST );

header ( "Location: /app/clients.php" );

?>