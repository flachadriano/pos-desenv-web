<?php
header ( 'Contente-type: application/json, charset:utf-8' );

$jsonfile = "../actions/" . $_GET ["model"] . ".json";
echo "[" . file_get_contents ( $jsonfile ) . "]";
