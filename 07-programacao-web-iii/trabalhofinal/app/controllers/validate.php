<?php
header ( 'Contente-type: application/json, charset:utf-8' );

$model = file_get_contents ( "../models/" . $_GET ["model"] );
