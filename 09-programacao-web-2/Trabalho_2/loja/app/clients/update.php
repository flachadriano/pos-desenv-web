<?php
include "../../framework/framework.php";

$q = new Queries ();
$q->updateEntity ( "clients", $_POST );

header ( "Location: /app/clients.php" );

?>