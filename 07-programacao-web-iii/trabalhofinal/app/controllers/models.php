<?php
header ( 'Contente-type: application/json, charset:utf-8' );

session_start ();

$model = $_GET ["model"];
$id = isset ( $_GET ["id"] ) ? $_GET ["id"] : null;

$jsonfile = "../models/" . $model . ".json";
echo '{"fields": [' . file_get_contents ( $jsonfile ) . ']';

if ($id) {
	foreach ( $_SESSION [$model] as $record ) {
		$recordJson = json_decode ( $record );
		
		if ($recordJson->id == $id) {
			echo ', "record": ' . $record;
		}
	}
}

echo '}';
