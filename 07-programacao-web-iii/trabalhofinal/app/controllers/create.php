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
	if (! $_SESSION [$_GET ["model"]]) {
		$_SESSION [$_GET ["model"]] = [ ];
	}
	
	$record = '{"id": ' . '"' . ($_SESSION [$_GET ["model"]] . length + 1) . '"';
	foreach ( $model as $field ) {
		$record .= ', "' . $field->name . '" : "' . $_POST [$field->name] . '"';
	}
	$record .= "}";
	
	array_push ( $_SESSION [$_GET ["model"]], $record );
}
