<?php
header ( 'Contente-type: application/json, charset:utf-8' );

session_start ();

$model = json_decode ( "[" . file_get_contents ( "../models/" . $_GET ["model"] . ".json" ) . "]" );
$first = true;
$error = false;

echo "[";

foreach ( $model as $field ) {
	if ($field->null == "false") {
		if (! $_POST [$field->name] || $_POST [$field->name] == "") {
			$error = true;
			if ($first) {
				$first = false;
			} else {
				echo ",";
			}
			echo '{"field": ' . '"' . $field->label . '"';
			echo ', "msg": "Deve ser preenchido"}';
		}
	}
}

echo "]";

if (! $error) {
	if (! isset ( $_SESSION [$_GET ["model"]] )) {
		$_SESSION [$_GET ["model"]] = [ ];
	}
	
	$new_record = '{"id": ' . '"' . (count ( $_SESSION [$_GET ["model"]] ) + 1) . '"';
	foreach ( $model as $field ) {
		$new_record .= ', "' . $field->name . '" : "' . $_POST [$field->name] . '"';
	}
	$new_record .= "}";
	
	if (isset ( $_GET ["id"] ) && $_GET ["id"] != "null") {
		$records = [ ];
		
		foreach ( $_SESSION [$_GET ["model"]] as $record ) {
			$recordJson = json_decode ( $record );
			
			if ($recordJson->id == $_GET ["id"]) {
				array_push ( $records, $new_record );
			} else {
				array_push ( $records, $record );
			}
		}
		
		$_SESSION [$_GET ["model"]] = $records;
	} else {
		array_push ( $_SESSION [$_GET ["model"]], $new_record );
	}
}
