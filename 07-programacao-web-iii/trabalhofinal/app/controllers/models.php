<?php
header ( 'Contente-type: application/json, charset:utf-8' );

session_start ();

$jsonfile = "../models/" . $_GET ["model"] . ".json";
echo '{"fields": [' . file_get_contents ( $jsonfile ) . ']';

if ($_GET ["id"]) {
	foreach ( $_SESSION [$_GET ["model"]] as $record ) {
		$recordJson = json_decode ( $record );
		
		if ($recordJson->id == $_GET ["id"]) {
			$jsonfile = "../models/" . $_GET ["model"] . ".json";
			echo ', "record": ' . $record;
		}
	}
}

echo '}';
