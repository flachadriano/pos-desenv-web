<?php
header ( "Content-Type: text/html, charset: utf-8" );

$name = $_GET ["name"];
$lastName = $_GET ["lastName"];

echo $name . " " . $lastName;