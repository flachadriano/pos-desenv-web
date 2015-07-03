<?php
header ( 'Contente-type: application/json, charset:utf-8' );

$model = json_decode ( "[" . file_get_contents ( "../models/" . $_GET ["model"] . ".json" ) . "]" );
$first = true;

echo "[";

foreach ( $model as $field ) {
	if ($field->null == "false") {
		if (! $_POST [$field->name] || $_POST [$field->name] == "") {
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