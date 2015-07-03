<?php
header ( 'Contente-type: application/json, charset:utf-8' );

session_start ();

echo $_SESSION [$_GET ["model"]] [1];