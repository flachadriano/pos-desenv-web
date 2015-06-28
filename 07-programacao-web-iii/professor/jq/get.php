<?php
header('Content-type: text/html; charset=utf-8');

$texto = $_GET['texto'];

echo $texto . '<br>' . utf8_encode('E também o PHP.');