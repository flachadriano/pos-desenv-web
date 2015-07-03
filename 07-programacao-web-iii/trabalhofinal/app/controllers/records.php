<?php
header ( 'Contente-type: application/json, charset:utf-8' );

session_start ();

$first = true;

echo "[";

foreach ( $_SESSION [$_GET ["model"]] as $record ) {
	if ($first) {
		$first = false;
	} else {
		echo ",";
	}
	
	echo $record;
}

echo "]";
