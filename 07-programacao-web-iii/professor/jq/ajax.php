<?php
$id = $_GET['id'];
$name = $_GET['name'];
$valor = $_GET['valor'];

$s = array('id' => $id, 'name' => $name, 'valor' => $valor);

header('Content-type: application/json');
sleep(2);
echo json_encode($s);