<?php
header ( 'Contente-type: application/json, charset:utf-8' );

session_start ();

$records = [ ];

foreach ( $_SESSION [$_GET ["model"]] as $record ) {
	$recordJson = json_decode ( $record );
	
	if ($recordJson->id != $_GET ["id"]) {
		array_push ( $records, $record );
	}
}

$_SESSION [$_GET ["model"]] = $records;
