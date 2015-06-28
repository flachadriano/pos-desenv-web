<?php
header ( 'Contente-type: application/json, charset:utf-8' );

$model = json_encode ( "[" . file_get_contents ( "../models/" . $_GET ["model"] . ".json" ) . "]" );

echo $model;
foreach ( $model as $key => $field ) {
	echo $field;
	echo $model->label;
}
