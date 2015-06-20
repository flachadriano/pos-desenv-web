<?php
header ( "Content-Type: text/html, charset: utf-8" );

$name = $_POST ["name"];
$lastName = $_POST ["lastName"];

echo "$name $lastName";