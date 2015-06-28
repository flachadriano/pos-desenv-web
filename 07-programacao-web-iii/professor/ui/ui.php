<?php
header('content-type: application/json');
$term = $_GET['term'];

$data = array('Delphi', 'PHP', 'Ajax', 'Pyton', 'HTML', 'JavaScript');
echo json_encode($data);