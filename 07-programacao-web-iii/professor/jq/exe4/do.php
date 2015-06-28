<?php
$json = '[' . "\n";

for($i = 1; $i <= 100; $i++){
	//$json .= "{\"id\": $i, \"nome\": \"Cliente $i\", \"email\":\"cliente_$i@gmail.com\"},";
	$row = Array("id" => $i, "nome" => "Café pilão $i", "email" => "cliente_$i@gmail.com");
	$row['nome'] = utf8_encode($row['nome']);
	$json .= json_encode($row, JSON_PRETTY_PRINT) . ',' . "\n";
}

$json = rtrim($json, ",\n");

$json .= "\n" . ']';

header('Content-type: application/json; charset=UTF-8');
sleep(1);
echo $json;