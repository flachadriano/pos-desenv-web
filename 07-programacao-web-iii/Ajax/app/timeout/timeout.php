<?php
header ( "Content-type: application/json" );

$name = $_POST ["name"];
$lastName = $_POST ["lastName"];

$array = Array (
		"name" => $name,
		"lastName" => $lastName 
);

sleep(3);
$json = json_encode($array);
echo $json;