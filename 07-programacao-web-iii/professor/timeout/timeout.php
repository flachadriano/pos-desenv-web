<?php

header('content-type: application/json; charset: utf-8');

$nome = $_POST['nome'];
$sobreNome = $_POST['sobreNome'];

$array = Array('nome' => $nome, 'sobreNome' => $sobreNome);
$json = json_encode($array);

sleep(2);
echo $json;